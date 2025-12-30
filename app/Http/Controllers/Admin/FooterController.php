<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;

class FooterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $imgurl='/uploads/footer/';

            $data = DB::table('footers')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('footer_title', function ($row) {
                    return Str::limit(strip_tags($row->footer_title), 30, '...');
                })

                ->editColumn('address', function ($row) {
                    return Str::limit(strip_tags($row->address), 60, '...');
                })

                ->editColumn('image', function ($row) use ($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="50">';
                })

                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>'
                        ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','image'])
                ->make(true);

        }
      
        return view('admin.footer-page.index');
    }


    //edit method
    public function edit($id)
    {
        $data = DB::table('footers')->where('id', $id)->first();

        if (!$data) {
            // Return JSON error if post not found (since this is an AJAX call)
            return response()->json(['error' => 'Post not found.'], 404);
        }

        return view('admin.footer-page.edit', compact('data'));
    }


    // Update method
public function update(Request $request)
{
    $request->validate([
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:30',
        'footer_title' => 'required|string',
        'address' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->only([
        'footer_title',
        'address',
        'address_two',
        'email',
        'phone',
        'copyright_text',
        'disclaimer'
    ]);

    // Handle image
    if ($request->hasFile('image')) {
        $oldFile = public_path('uploads/footer/' . $request->old_photo);
        if (File::exists($oldFile)) {
            unlink($oldFile);
        }

        $photo = $request->file('image');
        $photoname = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(600, 600)->save(public_path('uploads/footer/' . $photoname));
        $data['image'] = $photoname;
    } else {
        $data['image'] = $request->old_photo;
    }

    DB::table('footers')->where('id', $request->id)->update($data);

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Data Updated Successfully']);
    }

    $notification = [
        'messege' => 'Footer Data Updated Successfully!',
        'alert-type' => 'success'
    ];

    return redirect()->route('footer-page')->with($notification);
}




    
}
