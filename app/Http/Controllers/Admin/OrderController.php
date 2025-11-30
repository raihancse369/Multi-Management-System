<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

        $imgurl='/uploads/product/';
        
        $product="";
            $query = DB::table('orders')->orderBy('id','DESC');
            
            if ($request->payment_type) {
                $query->where('orders.payment_type',$request->payment_type);
            }

            if ($request->date) {
                $query->where('orders.date',$request->date);
            }

            if ($request->status==0) {
                $query->where('orders.status',0);
            }
            
            if ($request->status==1) {
                $query->where('orders.status',1);
            }
            
            if ($request->status==2) {
                $query->where('orders.status',2);
            }

            if ($request->status==3) {
                $query->where('orders.status',3);
            }

            if ($request->status==4) {
                $query->where('orders.status',4);
            }

            if ($request->status==5) {
                $query->where('orders.status',5);
            }

            $product=$query->get();

            return DataTables::of($product)
                ->addIndexColumn()

                ->editColumn('status',function($row){
                    if ($row->status==0) {
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Pending</button>';
                    }elseif($row->status==1){
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Completed</button>';
                    }elseif($row->status==2){
                        return '<button type="button" class="btn btn-info btn-sm waves-effect waves-light btn-sm">Shipped</button>';
                    }elseif($row->status==3){
                        return '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light btn-sm">Recieved</button>';
                    }elseif($row->status==4){
                        return '<button type="button" class="btn btn-warning btn-sm waves-effect waves-light btn-sm">Return</button>';
                    }elseif($row->status==5){
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Cancel</button>';
                    }


                })



                ->editColumn('date',function($row){
                    return date('d F Y', strtotime($row->date));
                })

                ->addColumn('action', function($row){
                    $actionBtn='
                    
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                        <a href="'. route('order.delete',[$row->id]).'" class="btn btn-danger btn-sm waves-effect waves-light tooltips" id="delete_order"><i class="fa fa-trash"></i>
                        </a>'
                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','date','status'])
                ->make(true);
        }

        return view('admin.order.index');
    }

    // edit method
    public function edit($id)
    {
        $order = DB::table('orders')->where('id',$id)->first();
        return view('admin.order.edit',compact('order'));
    }

    // Update method
    public function update(Request $request)
    {
        $data = [];
        $data['c_name'] = $request->c_name;
        $data['c_email'] = $request->c_email;
        $data['c_address'] = $request->c_address;
        $newStatus = $request->status;
        $data['status'] = $newStatus;

        // Fetch the current order to check previous status
        $order = DB::table('orders')->where('id', $request->id)->first();

        if ($order) {
            $oldStatus = $order->status;

            // Get order details
            $orderDetails = DB::table('order_details')->where('order_id', $request->id)->get();

            // CASE 1: Going from "Pending (0)" to "Received (1)" → decrease product stock
            if ($oldStatus != 1 && $newStatus == 1) {
                foreach ($orderDetails as $item) {
                    $product = DB::table('products')->where('id', $item->product_id)->first();

                    if ($product) {
                        $newQty = $product->stock_quantity - $item->quantity;
                        DB::table('products')->where('id', $item->product_id)->update([
                            'stock_quantity' => $newQty >= 0 ? $newQty : 0
                        ]);
                    }
                }
            }

            // CASE 2: Going from "Received (1)" to "Pending (0)" → increase product stock back
            if ($oldStatus == 1 && $newStatus == 0) {
                foreach ($orderDetails as $item) {
                    DB::table('products')->where('id', $item->product_id)->increment('stock_quantity', $item->quantity);
                }
            }
        }

        // Update the order status and info
        DB::table('orders')->where('id', $request->id)->update($data);

        return response()->json('Order Updated Successfully');
    }


    // Delete method
    public function destroy($id)
    {
        $order=DB::table('orders')->where('id',$id)->delete();
        $order_details=DB::table('order_details')->where('order_id',$id)->delete();
        return response()->json('Data Deleted Successfully');
    }


}
