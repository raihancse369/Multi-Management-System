<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('coupons')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('status',function($row){
                    if ($row->status=="Active") {
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Active</button>';
                    }else{
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Deactive</button>';
                    }
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('coupon.delete', $row->id).'" class="btn btn-danger btn-sm delete_coupon"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.coupon.index');
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'coupon_code' => 'required|unique:coupons|max:255',
        ]);

        $data=array();
        $data['coupon_code']=$request->coupon_code;
        $data['type']=$request->type;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['status']=$request->status;

        $category = DB::table('coupons')->insert($data);
        return response()->json(['message' => 'Data Inserted Successfully']);
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit',compact('data'));
    }

    // Update Method
    public function update(Request $request)
    {
        $data=array();
        $data['coupon_code']=$request->coupon_code;
        $data['type']=$request->type;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['status']=$request->status;

        DB::table('coupons')->where('id',$request->id)->update($data);
        return response()->json(['message' => 'Data Updated Successfully']);
    }

    // Delete Method
    public function destroy($id)
    {
        DB::table('coupons')->where('id',$id)->delete();
        return response()->json(['message' => 'Data Deleted Successfully']);
    }

    
}
