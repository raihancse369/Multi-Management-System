<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class LeavetypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('leavetypes')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('leave-type.delete', $row->id).'" class="btn btn-danger btn-sm delete_leave-type"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.leave-type.index');
    }

    // Store method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'type_name' => 'required|max:255',
        ]);

        $data=array();
        $data['type_name']=$request->type_name;
        $data['leave_day']=$request->leave_day;

        $leavetype = DB::table('leavetypes')->insert($data);
        return response()->json(['message' => 'Data Inserted Successfully']);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('leavetypes')->where('id',$id)->first();
        return view('admin.leave-type.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {
        $data=array();
        $data['type_name']=$request->type_name;
        $data['leave_day']=$request->leave_day;

        DB::table('leavetypes')->where('id',$request->id)->update($data);
        return response()->json(['message' => 'Data Updated Successfully']);
    }

    // Delete method
    public function destroy($id)
    {
        DB::table('leavetypes')->where('id',$id)->delete();
        return response()->json(['message' => 'Data Deleted Successfully']);
    }

    
}
