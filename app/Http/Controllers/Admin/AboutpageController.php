<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;

class AboutpageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $imgurl='/uploads/about-page/';

            $data = DB::table('abouts')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 100, '...');
                })

                ->editColumn('image', function ($row) use ($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="50">';
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>';
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','image'])
                ->make(true);

        }
      
        return view('admin.about-page.index');
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('abouts')->where('id', $id)->first();

        if (!$data) {
            // Return JSON error if post not found (since this is an AJAX call)
            return response()->json(['error' => 'Post not found.'], 404);
        }

        return view('admin.about-page.edit', compact('data'));
    }


    // Update Method
    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['slug']=Str::slug($request->title, '-');
        $data['description']=$request->description;

        if ($request->hasFile('image')) {
            $oldFile = public_path('uploads/about-page/' . $request->old_photo);
            if (File::exists($oldFile)) {
                unlink($oldFile);
            }

            $photo = $request->file('image');
            $photoname = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(1469,980)->save(public_path('uploads/about-page/' . $photoname));
            $data['image'] = $photoname;
        } else {
            $data['image'] = $request->old_photo;
        }

        DB::table('abouts')->where('id', $request->id)->update($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Data Updated Successfully']);
        }

        $notification = ['message' => 'Data Updated Successfully!', 'alert-type' => 'success'];
        return redirect()->route('about-page')->with($notification);
    }




    
}
