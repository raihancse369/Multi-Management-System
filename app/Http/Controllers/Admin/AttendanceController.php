<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class AttendanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('attendances')
                ->select('att_date', 'att_month', 'att_year')
                ->groupBy('att_date', 'att_month', 'att_year')
                ->orderByDesc('att_date');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '
                        <a href="javascript:void(0)" data-date="'.$row->att_date.'" 
                            class="btn btn-info btn-sm editAttendance" data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="'.route('attendance.delete', $row->att_date).'" 
                            class="btn btn-danger btn-sm delete_attendance"><i class="fa fa-trash"></i></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $employee = DB::table('employees')->get();
        return view('admin.attendance.index', compact('employee'));
    }

    // Store attendance
    public function store(Request $request)
    {
        $date = $request->att_date;

        $att_date = DB::table('attendances')->where('att_date', $date)->first();
        if ($att_date) {
            return response()->json(['status' => 'error', 'message' => 'Today Attendance Already Taken!'], 409);
        }

        foreach ($request->user_id as $id) {
            $data[] = [
                "user_id"    => $id,
                "status" => $request->status[$id] ?? 'Absence',
                "att_date"   => $request->att_date,
                "att_month"  => $request->att_month,
                "att_year"   => $request->att_year,
            ];
        }

        DB::table('attendances')->insert($data);

        return response()->json(['status' => 'success', 'message' => 'Successfully Attendance Taken!']);
    }

    // Edit attendance for a specific date
    public function edit($edit_date)
    {
        $data = DB::table('attendances')
            ->join('employees', 'attendances.user_id', 'employees.id')
            ->select('employees.name', 'employees.image', 'attendances.*')
            ->where('attendances.att_date', $edit_date)
            ->get();

        return view('admin.attendance.edit', compact('data', 'edit_date'));
    }

    public function update(Request $request)
    {
        $att_date = $request->att_date;
        $att_year = $request->att_year ?? now()->year;
        $att_month = $request->att_month ?? now()->format('F');

        foreach ($request->id as $id) {
            $data = [
                'status' => $request->status[$id] ?? 'Absence',
                'att_date' => $att_date,
                'att_year' => $att_year,
                'att_month' => $att_month,
                'updated_at' => now(),
            ];

            DB::table('attendances')
                ->where(['att_date' => $att_date, 'id' => $id])
                ->update($data);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance updated successfully!',
            'redirect' => route('attendance.index'),
        ]);
    }

    public function destroy($att_date)
    {
        // Delete all records for this attendance date
        $deleted = DB::table('attendances')->where('att_date', $att_date)->delete();

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Attendance deleted successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete attendance record.'
            ], 400);
        }
    }




}
