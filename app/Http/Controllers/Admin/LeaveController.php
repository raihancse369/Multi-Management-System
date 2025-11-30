<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class LeaveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('leaves')
                ->leftJoin('employees','leaves.employee_id','employees.id')
                ->leftJoin('leavetypes','leaves.type_id','leavetypes.id')
                ->select('leaves.*','leavetypes.type_name','employees.name','employees.employee_id')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('employee', function($row) {
                    return $row->name . ' - ' . $row->employee_id; // ✅ Combine name & ID
                })

                ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Approved</button>';
                    }elseif($row->status==2){
                        return '<button type="button" class="btn btn-warning btn-sm waves-effect waves-light btn-sm">Declined</button>';
                    }else{
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Pending</button>';
                    }

                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('leave.delete', $row->id).'" class="btn btn-danger btn-sm delete_leave"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        $employee=DB::table('employees')->get();
        $leavetype=DB::table('leavetypes')->get();
      
        return view('admin.leave.index',compact('employee','leavetype'));
    }

    // Store method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'employee_id' => 'required',
           'type_id' => 'required',
           'start_date' => 'required',
           'end_date' => 'required',
        ]);

        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['type_id']=$request->type_id;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['leave_day']=$request->leave_day;
        $data['status']=$request->status;
        $data['date']=date('d-m-Y');
        $data['month']=date('F');
        $data['year']=date('Y');

        $leave = DB::table('leaves')->insert($data);
        return response()->json(['message' => 'Data Inserted Successfully']);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('leaves')->where('id',$id)->first();
        $employee=DB::table('employees')->get();
        $leavetype=DB::table('leavetypes')->get();
        return view('admin.leave.edit',compact('data','employee','leavetype'));
    }

    // Update method
    public function update(Request $request)
    {
        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['type_id']=$request->type_id;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['leave_day']=$request->leave_day;
        $data['status']=$request->status;

        DB::table('leaves')->where('id',$request->id)->update($data);
        return response()->json('Data Updated Successfully');
    }

    // Delete method
    public function destroy($id)
    {
        DB::table('leaves')->where('id',$id)->delete();
        return response()->json(['message' => 'Data Deleted Successfully']);
    }

    
}

