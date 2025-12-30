<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Hash;
use File;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index Method for Showing User Roles
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Show all users (or use ->whereNull('is_admin') if you want to exclude main admin)
            $data = DB::table('users')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('photo', function ($row) {
                    $url = $row->photo
                        ? asset('uploads/user/' . $row->photo)
                        : asset('uploads/default.png');

                    return '<img src="' . $url . '" height="50" width="50" alt="User Photo" class="rounded-circle">';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" data-id="' . $row->id . '" 
                            class="btn btn-success btn-sm edit" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="' . route('role.delete', $row->id) . '" 
                            class="btn btn-danger btn-sm delete_role">
                            <i class="fa fa-trash"></i>
                        </a>';
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }

        return view('admin.role.index');
    }


    // Store Method
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'type'       => 0,
            'is_admin'   => 1,
        ];

        // Add permissions
        $permissions = [
            'setting', 'page', 'category', 'product', 'offer',
            'orders', 'message', 'blog', 'hrm', 'attendance',
            'payroll', 'expense', 'role'
        ];
        foreach ($permissions as $perm) {
            $data[$perm] = $request->$perm;
        }

        DB::table('users')->insert($data);

        return response()->json(['status' => 'success', 'message' => 'User inserted successfully']);
    }

    // Edit Method
    public function edit($id)
    {
        $user = DB::table('users')->find($id);

        if (!$user) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return view('admin.role.edit', compact('user'));
    }

    // Update Method
    public function update(Request $request)
    {
        $user = DB::table('users')->find($request->id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $permissions = [
            'setting', 'page', 'category', 'product', 'offer',
            'orders', 'message', 'blog', 'hrm', 'attendance',
            'payroll', 'expense', 'role'
        ];
        foreach ($permissions as $perm) {
            $data[$perm] = $request->$perm;
        }

        DB::table('users')->where('id', $request->id)->update($data);

        return response()->json(['status' => 'success', 'message' => 'User role updated successfully']);
    }

    // Destroy Method
    public function destroy($id)
    {
        $user = DB::table('users')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->photo) {
            $filePath = public_path('uploads/user/' . $user->photo);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        DB::table('users')->where('id', $id)->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
