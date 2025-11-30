<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index + DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Fast DB query (no ->get())
            $query = DB::table('departments')->select('id', 'department_name')->orderBy('id', 'DESC');

            return DataTables::of($query)
                ->addIndexColumn()

                // Action buttons
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm edit m-1"><i class="fa fa-pencil"></i></a>
                        <a href="#" data-url="'.route('department.delete', $row->id).'" class="btn btn-danger btn-sm delete_department"><i class="fa fa-trash"></i>
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.department.index');
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'department_name' => 'required|max:255|unique:departments,department_name',
        ]);

        try {

            $data = array();
            $data['department_name'] = $request->department_name;
            DB::table('departments')->insert($data);

            return response()->json(['message' => 'Department Created Successfully']);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
        
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('departments')->where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Department not found'], 404);
        }
        return view('admin.department.edit', compact('data'));
    }

    // Update Method
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
           'department_name' => 'required|max:255|unique:departments,department_name,' . $request->id,
        ]);

        try {

            $data = array();
            $data['department_name'] = $request->department_name;

            $update = DB::table('departments')->where('id', $id)->update($data);

            if ($update === 0) {
                return response()->json(['message' => 'No changes were made'], 200);
            }

            return response()->json(['message' => 'Department Updated Successfully'], 200);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // Delete Method
    public function destroy($id)
    {
        $exists = DB::table('departments')->where('id', $id)->exists();

        if (!$exists) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        DB::table('departments')->where('id', $id)->delete();
        return response()->json(['message' => 'Department Deleted Successfully']);
    }
}
