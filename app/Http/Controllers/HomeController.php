<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $orders = collect();
        $total_order = $complete_order = $cancel_order = $return_order = 0;

        if (Auth::user()->is_admin != 1) {
            $orders = DB::table('orders')->where('user_id', Auth::id())->orderBy('id', 'DESC')->take(10)->get();
            $total_order = DB::table('orders')->where('user_id', Auth::id())->count();
            $complete_order = DB::table('orders')->where('user_id', Auth::id())->where('status', 3)->count();
            $cancel_order = DB::table('orders')->where('user_id', Auth::id())->where('status', 5)->count();
            $return_order = DB::table('orders')->where('user_id', Auth::id())->where('status', 4)->count();
        }

        $notification = ['message' => 'Login Success !', 'alert-type' => 'success'];
        return view('home', compact('orders', 'total_order', 'complete_order', 'cancel_order', 'return_order'))
            ->with($notification);
    }

    //customer logout

    public function logout()
    {
        Auth::logout();
        $notification=array('message' => 'You are logged out !', 'alert-type' => 'success');
        return redirect('/')->with($notification); 
        //return redirect()->back();
    }

    public function updatePhoto(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the uploaded file
        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // If there’s a new file, handle upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && file_exists(public_path('uploads/user/'.$user->photo))) {
                unlink(public_path('uploads/user/'.$user->photo));
            }

            // Store new photo
            $filename = time().'_'.$request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/user/'), $filename);

            // Save filename to database
            $user->photo = $filename;
            $user->save();
        }

        $notification=array('message' => 'Photo updated successfully !', 'alert-type' => 'success');
        return redirect()->back()->with($notification); 
    }

    public function UpdateShipping(Request $request)
    {
        $data = $request->only([
            'shipping_name',
            'shipping_phone',
            'shipping_email',
            'shipping_address',
            'shipping_country',
            'shipping_city',
            'shipping_zipcode'
        ]);
        $data['updated_at'] = now();

        $exists = DB::table('shippings')->where('user_id', Auth::id())->first();

        if ($exists) {
            DB::table('shippings')->where('user_id', Auth::id())->update($data);
        } else {
            $data['user_id'] = Auth::id();
            $data['created_at'] = now();
            DB::table('shippings')->insert($data);
        }

        $notification = ['message' => 'Shipping information updated successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function setting()
    {
        $shipping = DB::table('shippings')->where('user_id', Auth::id())->first();
        return view('user.setting', compact('shipping'));
    }

}
