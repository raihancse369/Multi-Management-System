<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class HolidayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('holidays')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('type',function($row){
                    if ($row->type=="Offday") {
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Offday</button>';
                    }else{
                        return '<button type="button" class="btn btn-warning btn-sm waves-effect waves-light btn-sm">Holiday</button>';
                    }
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('holiday.delete', $row->id).'" class="btn btn-danger btn-sm delete_holiday"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','type'])
                ->make(true);
        }
        return view('admin.holiday.index');
    }

    // Store method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'type' => 'required|max:255',
           'name' => 'required|max:255',
        ]);

        $data=array();
        $data['type']=$request->type;
        $data['name']=$request->name;
        $data['from']=$request->from;
        $data['to']=$request->to;
        $data['num_of_days']=$request->num_of_days;
        $data['month']=date("F");
        $data['year']=date("Y");

        $holiday = DB::table('holidays')->insert($data);
        return response()->json(['message' => 'Holiday Inserted Successfully']);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('holidays')->where('id',$id)->first();
        return view('admin.holiday.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {
        $data=array();
        $data['type']=$request->type;
        $data['name']=$request->name;
        $data['from']=$request->from;
        $data['to']=$request->to;
        $data['num_of_days']=$request->num_of_days;

        DB::table('holidays')->where('id',$request->id)->update($data);
        return response()->json(['message' => 'Data Updated Successfully']);
    }

    // Delete method
    public function destroy($id)
    {
        DB::table('holidays')->where('id',$id)->delete();
        return response()->json(['message' => 'Data Deleted Successfully']);
    }

    
}