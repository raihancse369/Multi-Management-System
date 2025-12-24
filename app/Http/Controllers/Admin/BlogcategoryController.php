<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;

class BlogcategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('blogcategories')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>

                       <a href="'.route('blog-category.delete', $row->id).'" class="btn btn-danger btn-sm delete_blog-category"><i class="fa fa-trash"></i></a>'

                    ;
                        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.blog-category.index');
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'category_name' => 'required|max:255',
        ]);

        $slug=Str::slug($request->category_name, '-');
        $data=array();
        $data['category_name']=$request->category_name;
        $data['slug']=Str::slug($request->category_name, '-');

        $category = DB::table('blogcategories')->insert($data);
        return response()->json(['status' => 'success','message' => 'Blog category inserted successfully',]);
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('blogcategories')->where('id',$id)->first();
        return view('admin.blog-category.edit',compact('data'));
    }

    // Update Method
    public function update(Request $request)
    {
        $slug=Str::slug($request->category_name, '-');
        $data=array();
        $data['category_name']=$request->category_name;
        $data['slug']=Str::slug($request->category_name, '-');

        DB::table('blogcategories')->where('id',$request->id)->update($data);
        return response()->json(['status' => 'success','message' => 'Blog category updated successfully',]);
    }

    // Delete Method
    public function destroy($id)
    {
        DB::table('blogcategories')->where('id',$id)->delete();
        return response()->json(['status' => 'success','message' => 'Blog category deleted successfully',]);
    }

    
}

