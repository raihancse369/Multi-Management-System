<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;

class SiteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $imgurl='/uploads/logo/';

            $data = DB::table('sites')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('image', function ($row) use ($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="35">';
                })

                ->addColumn('action', function($row){
                    $actionBtn='
                    
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                        '
                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('admin.site.index');
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('sites')->where('id',$id)->first();
        return view('admin.site.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {

        $slug=Str::slug($request->email, '-');
        $data=array();
        $data['email']=$request->email;
        $data['slug']=Str::slug($request->email, '-');
        $data['phone']=$request->phone;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['youtube']=$request->youtube;
        $data['linkedin']=$request->linkedin;


        $old_data =  DB::table('sites')->where('id',$request->id)->first();

        if ($request->image) {
            // dd($request->all());
            if ($request->image) {
                     //Storage::delete($request->old_photo);
                    unlink('uploads/logo/'.$request->old_photo);
                }
            $photo=$request->image;
            $photoname=$slug. rand().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,600)->save('uploads/logo/'.$photoname);
            $data['image']=$photoname;
            DB::table('sites')->where('id',$request->id)->update($data);
            $notification=array('message' => 'Data Updated Successfully !', 'alert-type' => 'success');
            return redirect()->route('site')->with($notification);
        }else{
            $data['image']= $request->old_photo;
            DB::table('sites')->where('id',$request->id)->update($data);
            return response()->json('Data Updated Successfully');
        }
    }
    
}
