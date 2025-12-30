<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    //Index Method For Show Category
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('pages')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('page_description', function ($row) {
                return Str::limit(strip_tags($row->page_description), 100, '...');
                })

                ->editColumn('page_position',function($row){
                    if ($row->page_position==1) {
                        return '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light btn-sm">Line One</button>';
                    }else{
                        return '<button type="button" class="btn btn-info btn-sm waves-effect waves-light btn-sm">Line Two</button>';
                    }
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                        <a href="'. route('page.delete',[$row->id]).'" class="btn btn-danger btn-sm waves-effect waves-light tooltips" id="delete_page"><i class="fa fa-trash"></i>
                        </a>'
                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','page_position'])
                ->make(true);
        }
        return view('admin.setting.page.index');
    }

    // Store method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'page_name' => 'required|max:255',
        ]);

        $slug=Str::slug($request->page_name, '-');
        $data=array();
        $data['page_position']=$request->page_position;
        $data['page_name']=$request->page_name;
        $data['page_slug']=Str::slug($request->page_name, '-');
        $data['page_title']=$request->page_title;
        $data['page_description']=$request->page_description;
        //$data['page_description'] = strip_tags($request->page_description, '<b><i><u><strong>');

        $page = DB::table('pages')->insert($data);

        $notification=array('message' => 'Page Created Successfully ', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //edit method
    public function edit($id)
    {
        $data = DB::table('pages')->where('id',$id)->first();
        return view('admin.setting.page.edit',compact('data'));
    }

    // Update method
    public function update(Request $request)
    {
        $slug=Str::slug($request->page_name, '-');
        $data=array();
        $data['page_position']=$request->page_position;
        $data['page_name']=$request->page_name;
        $data['page_slug']=Str::slug($request->page_name, '-');
        $data['page_title']=$request->page_title;

        $data['page_description'] = strip_tags($request->page_description, '<b><i><u><strong>');

        DB::table('pages')->where('id',$request->id)->update($data);
        return response()->json('Page Updated Successfully');
    }

    // Delete method
    public function destroy($id)
    {
        DB::table('pages')->where('id',$id)->delete();
        return response()->json('Data Deleted Successfully');
    }

    
}
