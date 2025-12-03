<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class ExpenseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $expense = "";

            $query = DB::table('expenses')
            ->leftJoin('expensetypes','expenses.type_id','expensetypes.id');

            // Data Filtering for Inner Join
            if ($request->date) {
                $query->whereDate('expenses.date', $request->date);
            }

            if ($request->month) {
                $query->where('expenses.month', $request->month);
            }

            $expense = $query->select('expenses.*','expensetypes.type_name')->get();

            return DataTables::of($expense)
                ->addIndexColumn()

                ->editColumn('details', function ($row) {
                    return str()->limit($row->details, 100); // keep HTML
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>
                        <a href="'.route('expense.delete', $row->id).'" class="btn btn-danger btn-sm delete_expense"><i class="fa fa-trash"></i></a>'
                        ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','details'])
                ->make(true);

        }
        $expensetype=DB::table('expensetypes')->get();
        return view('admin.expense.index',compact('expensetype'));
    }

    // Store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|max:255',
        ]);

        $data=array();
        $data['type_id']=$request->type_id;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['month']=$request->month;
        $data['details'] = $request->details;
        $expense = DB::table('expenses')->insert($data);
        return response()->json(['status' => 'success','message' => 'Expense inserted successfully',]);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('expenses')->where('id', $id)->first();

        if (!$data) {
            // Return JSON error if post not found (since this is an AJAX call)
            return response()->json(['error' => 'Post not found.'], 404);
        }
        $expensetype = DB::table('expensetypes')->get();
        return view('admin.expense.edit', compact('data', 'expensetype'));
    }

    // Update method
    public function update(Request $request)
    {
        $data=array();
        $data['type_id']=$request->type_id;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['month']=$request->month;
        $data['details']=$request->details;
        DB::table('expenses')->where('id', $request->id)->update($data);
        if ($request->ajax()) {
            return response()->json(['status' => 'success','message' => 'Expense updated successfully',]);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('expenses')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['status' => 'success','message' => 'Expense deleted successfully',]);
        }
        return response()->json(['message' => 'Error deleting data.'], 500);
    }
    
}
