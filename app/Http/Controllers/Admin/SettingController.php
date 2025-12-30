<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('seos')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function($row){
                    $actionBtn='
                    
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>'
                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.setting.seo.index');
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('seos')->where('id',$id)->first();
        return view('admin.setting.seo.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;

        DB::table('seos')->where('id',$request->id)->update($data);
        return response()->json('Data Updated Successfully');
    }

    //SMTP Index Method
    public function smtp(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('smtps')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function($row){
                    $actionBtn='
                    
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>'
                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.setting.smtp.index');
    }

    //edit method
    public function smtpedit($id)
    {
        $data = DB::table('smtps')->where('id',$id)->first();
        return view('admin.setting.smtp.edit',compact('data'));
    }

    // Update method
    public function smtpupdate(Request $request)
    {
        $data=array();
        $data['mailer']=$request->mailer;
        $data['host']=$request->host;
        $data['port']=$request->port;
        $data['user_name']=$request->user_name;
        $data['password']=$request->password;
        DB::table('smtps')->where('id',$request->id)->update($data);
        return response()->json('Data Updated Successfully');
    }



    
}
