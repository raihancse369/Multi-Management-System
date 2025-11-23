<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Hash;
use Image;
use File;
use DB;
use DataTables;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        $totalExpense = DB::table('expenses')->sum('amount');
        $totalEmployeesalary = DB::table('employees')->sum('salary');
        $totalProduct = DB::table('products')->where('status', 'Active')->count();
        $totalEmployee = DB::table('employees')->count();
        $totalPost = DB::table('posts')->count();

        $totalsale = DB::table('orders')->where('status', 1)
            ->sum(DB::raw('CASE WHEN after_discount IS NOT NULL AND after_discount != "" THEN CAST(after_discount AS DECIMAL(10,2)) ELSE CAST(subtotal AS DECIMAL(10,2)) END'));

        $contact = DB::table('contacts')
            ->leftJoin('users', 'contacts.user_id', '=', 'users.id')
            ->select('contacts.*', 'users.photo', 'users.name as user_name')
            ->orderBy('contacts.id', 'DESC')
            ->take(10)
            ->get();

        $user = DB::table('users')->where('is_admin',NULL)->get();

        return view('admin.home', compact('totalExpense','totalEmployeesalary','totalEmployee','totalProduct','totalPost','totalsale','contact','user'
        ));
    }

    //admin custome logout
    public function logout()
    {
        Auth::logout();
        $notification=array('message' => 'You are logged out !', 'alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }

    //password change page
    public function PasswordChange()
    {
        return view('admin.profile.changepassword');
    }

    // Password Update
    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|max:14|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Current Password does not match!'
            ]);
        }

        // ✅ Update password using Eloquent
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with([
            'alert-type' => 'success',
            'message' => 'Password changed successfully! Please login again.'
        ]);
    }

        // 🔸 Show Profile Edit Page
    public function EditProfile()
    {
        $admin = Auth::user(); // get logged-in admin data
        return view('admin.profile.editprofile', compact('admin'));
    }

    // 🔸 Update Profile (Name + Email)
    public function UpdateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users,email,' . Auth::id(),
        ]);

        DB::table('users')->where('id', Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $notification = [
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

public function index(Request $request)
{
    if ($request->ajax()) {
        $contact = DB::table('contacts')
            ->leftJoin('users', 'contacts.user_id', '=', 'users.id')
            ->select('contacts.*', 'users.photo', 'users.name as user_name')
            ->get();

        return DataTables::of($contact)
            ->addIndexColumn()
            
            ->editColumn('photo', function ($row) {
                $photo = $row->photo ? $row->photo : 'default.png'; // fallback
                $url = asset('uploads/user/' . $photo); // adjust if using storage
                return '<img src="' . $url . '" height="50" alt="User Photo" class="rounded-circle">';
            })

            ->addColumn('action', function($row){
                $actionBtn = '
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i></a>
                    <a href="'.route('contact.delete', $row->id).'" class="btn btn-danger btn-sm delete_contact"><i class="fa fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action','photo'])
            ->make(true);
    }

    return view('admin.message.index');
}


    //edit method
    public function edit($id)
    {
        $data = DB::table('contacts')->where('id',$id)->first();
        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return view('admin.message.edit',compact('data'));
    }

    // Delete method
    public function destroy($id)
    {
        DB::table('contacts')->where('id',$id)->delete();
        return response()->json(['message' => 'Message deleted successfully.']);
    }

    // ✅ Index Method For Showing Product Reviews
    public function rindex(Request $request)
    {
        if ($request->ajax()) {

            $imgurl = asset('uploads/product'); // use asset() for full URL

            $data = DB::table('reviews')
                ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
                ->leftJoin('products', 'reviews.product_id', '=', 'products.id')
                ->select(
                    'reviews.id',
                    'reviews.review',
                    'reviews.rating',
                    'reviews.review_date',
                    'users.name as user_name',
                    'products.name as product_name',
                    'products.thumbnail as product_image'
                )
                ->orderBy('reviews.id', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()

                // ✅ Limit review text for better readability
                ->editColumn('review', function ($row) {
                    return Str::limit(strip_tags($row->review), 80, '...');
                })

                // ✅ Product thumbnail with fallback
                ->editColumn('product_image', function ($row) use ($imgurl) {
                    $image = $row->product_image ?? 'no-image.png';
                    return '<img src="'.$imgurl.'/'.$image.'" height="50" width="50" class="rounded">';
                })

                // ✅ Display product name with bold style
                ->editColumn('product_name', function ($row) {
                    return '<strong>'.$row->product_name.'</strong>';
                })

                // ✅ Optionally show rating as stars ⭐
                ->editColumn('rating', function ($row) {
                    $stars = str_repeat('⭐', $row->rating ?? 0);
                    return $stars ?: 'No rating';
                })

                // ✅ Action buttons (Edit / Delete)
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" data-id="'.$row->id.'" 
                           class="btn btn-success btn-sm edit" 
                           data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="'.route('review.delete', $row->id).'" 
                           class="btn btn-danger btn-sm delete_review">
                            <i class="fa fa-trash"></i>
                        </a>
                    ';
                })

                ->rawColumns(['product_image', 'product_name', 'rating', 'review', 'action'])
                ->make(true);
        }

        return view('admin.review.index');
    }




    //edit method
    public function redit($id)
    {
        $data = DB::table('reviews')
            ->leftJoin('users', 'reviews.user_id', 'users.id')
            ->leftJoin('products', 'reviews.product_id', 'products.id')
            ->select('reviews.*','users.name as user_name','products.name as product_name','products.thumbnail as product_image')->where('reviews.id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return view('admin.review.edit', compact('data'));
    }

    // Delete method
    public function rdestroy($id)
    {
        DB::table('reviews')->where('id',$id)->delete();
        return response()->json(['message' => 'Data Deleted Successfully']);
    }

    //Index Method For Show Category
    public function wbindex(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('wbreviews')
                ->leftJoin('users', 'wbreviews.user_id', 'users.id')
                ->select('wbreviews.*','users.name as user_name')
                ->orderBy('wbreviews.id', 'DESC')
                ->get();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn='
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>
                       <a href="'.route('website-review.delete', $row->id).'" class="btn btn-danger btn-sm delete_wbreview"><i class="fa fa-trash"></i></a>';
                        
                    return $actionBtn;
                })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.wbreview.index');
    }

    //edit method
    public function wbedit($id)
    {
        $data = DB::table('wbreviews')
            ->leftJoin('users', 'wbreviews.user_id', 'users.id')
            ->select('wbreviews.*','users.name as user_name')->where('wbreviews.id', $id)->first();
        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return view('admin.wbreview.edit',compact('data'));
    }

    // Delete method
    public function wbdestroy($id)
    {
        DB::table('wbreviews')->where('id',$id)->delete();
        return response()->json(['message' => 'Data Deleted Successfully']);
    }

}
