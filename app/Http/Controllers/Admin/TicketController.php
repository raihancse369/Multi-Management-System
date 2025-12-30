<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Image;
use DB;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $ticket = "";

            $query=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id');

                if ($request->date) {
                    $query->where('tickets.date',$request->date);
                }
                if ($request->type=='Technical') {
                    $query->where('tickets.service',$request->type);
                }
                if ($request->type=='Payment') {
                    $query->where('tickets.service',$request->type);
                }
                if ($request->type=='Affiliate') {
                    $query->where('tickets.service',$request->type);
                }
                if ($request->type=='Return') {
                    $query->where('tickets.service',$request->type);
                }
                if ($request->type=='Refund') {
                    $query->where('tickets.service',$request->type);
                }

                if ($request->status==1) {
                     $query->where('tickets.status',1);
                }

                if ($request->status==0) {
                    $query->where('tickets.status',0);
                }

                if ($request->status==2) {
                    $query->where('tickets.status',2);
                }

                $ticket=$query->select('tickets.*','users.name')->get();
            
                return DataTables::of($ticket)
                    ->addIndexColumn()

                    ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<button type="button" class="btn btn-info btn-sm waves-effect waves-light btn-sm">Running</button>';
                        }elseif($row->status==2){
                            return '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light btn-sm">Close</button>';
                        }else{
                            return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Pending</button>';
                        }
                    })

                    ->editColumn('date',function($row){
                       return date('d F Y', strtotime($row->date));
                    })

                ->addColumn('action', function($row){
                    $actionBtn='
                    
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                        <a href="'. route('admin.ticket.delete',[$row->id]).'" class="btn btn-danger btn-sm waves-effect waves-light tooltips" id="delete_ticket"><i class="fa fa-trash"></i>
                        </a>'
                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','date','status'])
                ->make(true);
        }
        return view('admin.ticket.index');
    }

        //edit method
    public function edit($id)
    {
        $ticket = DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.name')->where('tickets.id',$id)->first();
        return view('admin.ticket.edit',compact('ticket'));
    }

    //__show method
    public function show($id)
    {
        $ticket=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.name')->where('tickets.id',$id)->first();
        return view('admin.ticket.view_ticket',compact('ticket'));
    }

    // Update method
    public function ReplyTicket(Request $request)
    {
        $validated = $request->validate([
           'message' => 'required',
        ]);

        $data=array();
        $data['message']=$request->message;
        $data['ticket_id']=$request->ticket_id;
        $data['user_id']=0;
        $data['reply_date']=date('Y-m-d');

         if ($request->image) {
              //working with image
                  $photo=$request->image;
                  $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
                  Image::make($photo)->resize(600,350)->save('uploads/ticket/'.$photoname);  //image intervention
                  $data['image']='uploads/ticket/'.$photoname;   // public/files/brand/plus-point.jpg
         }
        
        DB::table('replies')->insert($data);
        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>1]);
        $notification=array('message' => 'Replied Done!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function CloseTicket($id)
    {
        DB::table('tickets')->where('id',$id)->update(['status'=>2]);
        $notification=array('message' => 'Ticket Closed!', 'alert-type' => 'success');
        return redirect()->route('ticket.index')->with($notification);
    }

    // Delete method
    public function destroy($id)
    {
        $delete = DB::table('tickets')->where('id',$id)->first();
        $photo = $delete->image;

        unlink(''.$photo);
        $dlt = DB::table('tickets')->where('id',$id)->delete();

        if ($dlt) {
            return response()->json('Data Deleted Successfully');
        }else{
            $notification=array('message' => 'Error !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    
}
