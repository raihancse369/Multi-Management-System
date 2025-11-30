<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class AwardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('awards')
                ->leftJoin('employees','awards.employee_id','employees.id')
                ->select('awards.*','employees.name','employees.employee_id')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('employee', function($row) {
                    return $row->name . ' - ' . $row->employee_id; // ✅ Combine name & ID
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('award.delete', $row->id).'" class="btn btn-danger btn-sm delete_award"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $employee=DB::table('employees')->get();
        return view('admin.award.index',compact('employee'));
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'employee_id' => 'required',
           'award_name' => 'required',
        ]);

        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['award_name']=$request->award_name;
        $data['award_prize']=$request->award_prize;
        $data['details']=$request->details;

        $data['date']=date('d-m-Y');
        $data['month']=date('F');
        $data['year']=date('Y');

        $award = DB::table('awards')->insert($data);
        return response()->json(['message' => 'Data Inserted Successfully']);
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('awards')->where('id',$id)->first();
        $employee=DB::table('employees')->get();
        return view('admin.award.edit',compact('data','employee'));
    }

    // Update Method
    public function update(Request $request)
    {
        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['award_name'] = $request->award_name;
        $data['award_prize'] = $request->award_prize;
        $data['details'] = $request->details;
        $data['date'] = $request->date;
        $data['month'] = $request->month;

        // Parse year from date input (assuming date format is d-m-Y)
        $dateObj = \DateTime::createFromFormat('d-m-Y', $request->date);
        if ($dateObj) {
            $data['year'] = $dateObj->format('Y');
        } else {
            // fallback: current year if parsing fails
            $data['year'] = date('Y');
        }

        DB::table('awards')->where('id',$request->id)->update($data);
        return response()->json(['message' => 'Data Updated Successfully']);
    }

    // Delete Method
    public function destroy($id)
    {
        DB::table('awards')->where('id',$id)->delete();
        return response()->json(['message' => 'Data Deleted Successfully']);
    }

    
}
