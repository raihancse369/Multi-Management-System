<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

          

            $data = DB::table('sliders')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 100, '...');
                })

                ->editColumn('image', function ($row) {
                    $imagePath = $row->image ? asset('uploads/slider/'.$row->image) : asset('uploads/slider/default.jpg');
                    return '<img src="'.$imagePath.'" height="50" width="80" class="rounded">';
                })

                ->editColumn('status',function($row){
                    if ($row->status=="Active") {
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Active</button>';
                    }else{
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Deactive</button>';
                    }
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>
                        <a href="'.route('slider.delete', $row->id).'" class="btn btn-danger btn-sm delete_slider"><i class="fa fa-trash"></i></a>'
                        ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);

        }
      
        return view('admin.slider.index');
    }

    // Store method
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Deactive',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['status']=$request->status;
        $data['description']=$request->description;
        $data['slug']=Str::slug($request->title, '-');
        
        // Single photo
        if ($request->image) {
            $photo=$request->image;
            $photoname = uniqid($slug.'_').'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(1920,1280)->save('uploads/slider/'.$photoname);
            $data['image']=$photoname;
        }

        $slider = DB::table('sliders')->insert($data);
        return response()->json(['message' => 'Data Inserted Successfully']);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('sliders')->where('id', $id)->first();

        if (!$data) {
            // Return JSON error if post not found (since this is an AJAX call)
            return response()->json(['error' => 'Post not found.'], 404);
        }

        return view('admin.slider.edit', compact('data'));
    }


    // Update method
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['slug']=Str::slug($request->title, '-');
        $data['description']=$request->description;
        $data['status']=$request->status;

        if ($request->hasFile('image')) {
            $oldFile = public_path('uploads/slider/' . $request->old_photo);
            if (File::exists($oldFile)) {
                unlink($oldFile);
            }

            $photo = $request->file('image');
            $photoname = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(1920, 1280)->save(public_path('uploads/slider/' . $photoname));
            $data['image'] = $photoname;
        } else {
            $data['image'] = $request->old_photo;
        }

        DB::table('sliders')->where('id', $request->id)->update($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Data Updated Successfully']);
        }

        $notification = ['messege' => 'Data Updated Successfully!', 'alert-type' => 'success'];
        return redirect()->route('slider')->with($notification);
    }


    public function destroy($id)
    {
        $slider = DB::table('sliders')->where('id', $id)->first();
        if (!$slider) {
            return response()->json(['message' => 'Post not found.'], 404);
        }

        $file_path = public_path('uploads/slider/' . $slider->image);
        if (File::exists($file_path)) {
            unlink($file_path);
        }

        $deleted = DB::table('sliders')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'Data Deleted Successfully']);
        }

        return response()->json(['message' => 'Error deleting data.'], 500);
    }


    
}
