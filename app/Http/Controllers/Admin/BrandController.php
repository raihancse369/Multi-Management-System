<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('brands')->latest()->get();

            // Let DataTables Handle Pagination
            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('status',function($row){
                    if ($row->status=="Yes") {
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Yes</button>';
                    }else{
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">No</button>';
                    }
                })

                // Image Column
                ->editColumn('image', function ($row) {
                    $url = asset('uploads/brand/' . $row->image);
                    return '<img src="' . $url . '" height="50" alt="Image">';
                })
                
                // Action Buttons
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-success btn-sm edit" title="Edit"><i class="fa fa-pencil"></i></a>';

                    $deleteBtn = '<a href="' . route('brand.delete', $row->id) . '" class="btn btn-danger btn-sm delete_brand" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $editBtn . ' ' . $deleteBtn;
                })

                ->rawColumns(['action','image','status'])
                ->make(true);

        }
        return view('admin.brand.index');
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required',
        ]);

        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['slug']=Str::slug($request->brand_name, '-');
        $data['status']=$request->status;
        
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $slug = Str::slug($request->brand_name, '-');
            $filename = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(165, 40)->save(public_path('uploads/brand/' . $filename));
            $data['image'] = $filename;
        }

        $brand = DB::table('brands')->insert($data);
        return response()->json(['success' => 'Brand Inserted Successfully.']);
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('brands')->where('id',$id)->first();
        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return view('admin.brand.edit',compact('data'));
    }

    // Update Method
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data=array();
        $data['brand_name']=$request->brand_name;
        $data['slug']=Str::slug($request->brand_name, '-');
        $data['status']=$request->status;

        // Handle Image Replacement
        if ($request->hasFile('image')) {
            $oldPath = public_path('uploads/brand/' . $request->old_photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $photo = $request->file('image');
            $slug = Str::slug($request->brand_name, '-');
            $filename = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(165, 40)->save(public_path('uploads/brand/' . $filename));
            $data['image'] = $filename;
        } else {
            $data['image'] = $request->old_photo;
        }


        DB::table('brands')->where('id', $id)->update($data);

        if ($request->ajax()) {
            return response()->json(['success' => 'Brand Updated Successfully.']);
        }
    }

    // Delete Method
    public function destroy($id)
    {
        $brand = DB::table('brands')->where('id', $id)->first();

        if (!$brand) {
            return response()->json(['error' => 'Data not found.'], 404);
        }

        $filePath = public_path('uploads/brand/' . $brand->image);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        DB::table('brands')->where('id', $id)->delete();

        return response()->json(['success' => 'Brand Deleted Successfully.']);
    }


    
}