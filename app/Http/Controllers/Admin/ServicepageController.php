<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;

class ServicepageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $imgurl='/uploads/service-page/';

            $data = DB::table('services')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('description', function ($row) {
                    return Str::limit(strip_tags($row->description), 100, '...');
                })

                ->editColumn('status',function($row){
                    if ($row->status=="Yes") {
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Yes</button>';
                    }else{
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">No</button>';
                    }
                })

                ->editColumn('image', function ($row) use ($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="36">';
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>
                        <a href="'.route('service.delete', $row->id).'" class="btn btn-danger btn-sm delete_service"><i class="fa fa-trash"></i></a>'
                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);

        }
        return view('admin.service-page.index');
    }

    // Store method
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $slug=Str::slug($request->service_name, '-');
        $data=array();
        $data['service_name']=$request->service_name;
        $data['description']=$request->description;
        $data['status']=$request->status;
        $data['slug']=Str::slug($request->service_name, '-');
        
        // Single photo
        if ($request->image) {
            $photo=$request->image;
            $photoname=$slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(900,900)->save('uploads/service-page/'.$photoname);
            $data['image']=$photoname;
        }

        $brand = DB::table('services')->insert($data);
        $notification=array('message' => 'Service Page Inserted Successfully !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('services')->where('id',$id)->first();
        return view('admin.service-page.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($request->service_name, '-');
        $data = [
            'service_name' => $request->service_name,
            'status' => $request->status,
            'description' => $request->description,
            'slug' => $slug,
        ];

        if ($request->hasFile('image')) {
            $oldFile = public_path('uploads/service-page/' . $request->old_photo);
            if (File::exists($oldFile)) {
                unlink($oldFile);
            }

            $photo = $request->file('image');
            $photoname = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(900,900)->save(public_path('uploads/service-page/' . $photoname));
            $data['image'] = $photoname;
        } else {
            $data['image'] = $request->old_photo;
        }

        DB::table('services')->where('id', $request->id)->update($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Data Updated Successfully']);
        }

        $notification = ['messege' => 'Data Updated Successfully!', 'alert-type' => 'success'];
        return redirect()->route('service')->with($notification);
    }


    public function destroy($id)
    {
        $brand = DB::table('services')->where('id', $id)->first();
        if (!$brand) {
            return response()->json(['message' => 'Post not found.'], 404);
        }

        $file_path = public_path('uploads/service-page/' . $brand->image);
        if (File::exists($file_path)) {
            unlink($file_path);
        }

        $deleted = DB::table('services')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'Data Deleted Successfully']);
        }

        return response()->json(['message' => 'Error deleting data.'], 500);
    }


    
}
