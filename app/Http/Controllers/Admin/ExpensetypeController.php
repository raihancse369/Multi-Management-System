<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class ExpensetypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('expensetypes')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('expense-type.delete', $row->id).'" class="btn btn-danger btn-sm delete_expensetype"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.expense-type.index');
    }

    // Store method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'type_name' => 'required|max:255',
        ]);

        $data=array();
        $data['type_name']=$request->type_name;

        $category = DB::table('expensetypes')->insert($data);
        return response()->json(['message' => 'Data inserted successfully']);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('expensetypes')->where('id',$id)->first();
        return view('admin.expense-type.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|unique:expensetypes,type_name',
        ]);

        $data=array();
        $data['type_name']=$request->type_name;
        DB::table('expensetypes')->where('id',$request->id)->update($data);
        return response()->json(['message' => 'Data updated successfully']);
    }

    // Delete method
    public function destroy($id)
    {
        $expensetype = DB::table('expensetypes')->where('id', $id)->first();
        if (!$expensetype) {
            return response()->json(['error' => 'Data not found.'], 404);
        }
        DB::table('expensetypes')->where('id', $id)->delete();
        return response()->json(['status' => 'success','message' => 'Data deleted successfully.',]);
    }

    
}
