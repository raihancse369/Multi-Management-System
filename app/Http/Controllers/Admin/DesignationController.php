<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class DesignationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('designations')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('designation.delete', $row->id).'" class="btn btn-danger btn-sm delete_designation"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.designation.index');
    }

    // Store method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'designation_name' => 'required|max:255|unique:designations,designation_name',
        ]);
        $data=array();
        $data['designation_name']=$request->designation_name;
        $designation = DB::table('designations')->insert($data);
        return response()->json(['message' => 'Data Inserted Successfully']);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('designations')->where('id',$id)->first();
        return view('admin.designation.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {
        $validated = $request->validate([
           'designation_name' => 'required|max:255|unique:designations,designation_name,' . $request->id,
        ]);

        $data=array();
        $data['designation_name']=$request->designation_name;
        DB::table('designations')->where('id',$request->id)->update($data);
        return response()->json(['message' => 'Data Updated Successfully']);
    }

    // Delete Method
    public function destroy($id)
    {
        $designation = DB::table('designations')->where('id', $id)->first();
        if (!$designation) {
            return response()->json(['error' => 'Data not found.'], 404);
        }
        DB::table('designations')->where('id', $id)->delete();
        return response()->json(['status' => 'success','message' => 'Data deleted successfully.',]);
    }

    
}
