<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('payrolls')
                ->join('employees', 'payrolls.employee_id', '=', 'employees.id')
                ->select('payrolls.*', 'employees.name')
                ->orderByDesc('payrolls.id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn='
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>
                       <a href="'.route('payroll.delete', $row->id).'" class="btn btn-danger btn-sm delete_payroll"><i class="fa fa-trash"></i></a>';
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $employees = DB::table('employees')->get();
        return view('admin.payroll.index', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required',
            'year' => 'required|digits:4',
            'basic_salary' => 'required|numeric',
        ]);

        $net_salary = $request->basic_salary + ($request->bonus ?? 0) - ($request->deductions ?? 0);

        DB::table('payrolls')->insert([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'basic_salary' => $request->basic_salary,
            'bonus' => $request->bonus ?? 0,
            'deductions' => $request->deductions ?? 0,
            'net_salary' => $net_salary,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Payroll Added Successfully']);
    }

    public function edit($id)
    {
        $data = DB::table('payrolls')->where('id', $id)->first();
        $employees = DB::table('employees')->get();
        return view('admin.payroll.edit', compact('data', 'employees'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required',
            'year' => 'required|digits:4',
            'basic_salary' => 'required|numeric',
        ]);

        $net_salary = $request->basic_salary + ($request->bonus ?? 0) - ($request->deductions ?? 0);

        DB::table('payrolls')->where('id', $request->id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'basic_salary' => $request->basic_salary,
            'bonus' => $request->bonus ?? 0,
            'deductions' => $request->deductions ?? 0,
            'net_salary' => $net_salary,
            'updated_at' => now(),
        ]);

        //$notification = ['messege' => 'Payroll Updated Successfully', 'alert-type' => 'success'];
        //return redirect()->route('payroll')->with($notification);
        return response()->json(['message' => 'Payroll Updated Successfully']);
    }

    public function destroy($id)
    {
        DB::table('payrolls')->where('id', $id)->delete();
        return response()->json(['message' => 'Payroll Deleted Successfully']);
    }
}