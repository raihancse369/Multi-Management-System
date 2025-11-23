<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $employee = "";

            $query = DB::table('employees')
                ->leftJoin('departments','employees.department_id','departments.id')
                ->leftJoin('designations','employees.designation_id','designations.id');

            // Filters
            if ($request->department_id) {
                $query->where('employees.department_id', $request->department_id);
            }

            if ($request->designation_id) {
                $query->where('employees.designation_id', $request->designation_id);
            }

            $employee = $query->select('employees.*','departments.department_name','designations.designation_name')->get();

            // Let DataTables handle pagination
            return DataTables::of($employee)
                ->addIndexColumn()

                // Image column
                ->editColumn('image', function ($row) {
                    $url = asset('uploads/employee/' . $row->image);
                    return '<img src="' . $url . '" height="50" alt="Image">';
                })

                // Action buttons
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" 
                                class="btn btn-success btn-sm edit" 
                                title="Edit"><i class="fa fa-pencil"></i></a>';

                    $deleteBtn = '<a href="' . route('employee.delete', $row->id) . '" 
                                  class="btn btn-danger btn-sm delete_employee" 
                                  title="Delete"><i class="fa fa-trash"></i></a>';

                    return $editBtn . ' ' . $deleteBtn;
                })

                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        $department=DB::table('departments')->get();
        $designation=DB::table('designations')->get();
        return view('admin.employee.index', compact('department','designation'));
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'employee_id' => 'required|unique:employees|max:55',
           'phone' => 'nullable|unique:employees|max:11',
           'email' => 'nullable|unique:employees|max:55',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['slug']=Str::slug($request->name, '-');
        $data['employee_id']=$request->employee_id;
        $data['department_id']=$request->department_id;
        $data['designation_id']=$request->designation_id;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['nid']=$request->nid;
        $data['joining_date']=$request->joining_date;
        $data['salary']=$request->salary;

        // Handle image upload
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $slug = Str::slug($request->name, '-');
            $filename = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(560, 700)->save(public_path('uploads/employee/' . $filename));
            $data['image'] = $filename;
        }

        DB::table('employees')->insert($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Employee inserted successfully.']);
        }

        return redirect()->back()->with([
            'message' => 'Employee inserted successfully.',
            'alert-type' => 'success',
        ]);
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('employees')->where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }

        $department=DB::table('departments')->get();
        $designation=DB::table('designations')->get();

        return view('admin.employee.edit', compact('data', 'department','designation'));
    }

    // Update Method
    public function update(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|max:55|unique:employees,employee_id,' . $request->id,
            'email' => 'nullable|max:55|unique:employees,email,' . $request->id,
            'phone' => 'nullable|max:11|unique:employees,phone,' . $request->id,
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['slug']=Str::slug($request->name, '-');
        $data['employee_id']=$request->employee_id;
        $data['department_id']=$request->department_id;
        $data['designation_id']=$request->designation_id;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['nid']=$request->nid;
        $data['joining_date']=$request->joining_date;
        $data['salary']=$request->salary;

        // Handle image replacement
        if ($request->hasFile('image')) {
            $oldPath = public_path('uploads/employee/' . $request->old_photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $photo = $request->file('image');
            $slug = Str::slug($request->name, '-');
            $filename = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(560, 700)->save(public_path('uploads/employee/' . $filename));
            $data['image'] = $filename;
        } else {
            $data['image'] = $request->old_photo;
        }

        DB::table('employees')->where('id', $request->id)->update($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Employee updated successfully.',
                'new_image' => asset('uploads/employee/' . $data['image']),
            ]);
        }

        return redirect()->route('employee')->with([
            'message' => 'Employee updated successfully.',
            'alert-type' => 'success',
        ]);
    }

    // Delete Method
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();

        if (!$employee) {
            return response()->json(['message' => 'Employee not found.'], 404);
        }

        $filePath = public_path('uploads/employee/' . $employee->image);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        DB::table('employees')->where('id', $id)->delete();

        return response()->json(['message' => 'Employee deleted successfully.']);
    }
}
