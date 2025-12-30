<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index + DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = DB::table('subcategories')
                    ->leftJoin('categories','subcategories.category_id','categories.id')
                    ->select('subcategories.*','categories.category_name');

            // Let DataTables Handle Pagination
            return DataTables::of($query)
                ->addIndexColumn()

                // Action buttons
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm edit m-1"><i class="fa fa-pencil"></i></a>
                        <a href="#" data-url="'.route('subcategory.delete', $row->id).'" class="btn btn-danger btn-sm delete_subcategory"><i class="fa fa-trash"></i>
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $category=DB::table('categories')->get();
        return view('admin.subcategory.index',compact('category'));
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'category_id' => 'required|exists:categories,id',
           'subcategory_name' => 'required|max:255',
        ]);

        try {
            $slug = Str::slug($request->subcategory_name);

            // Ensure slug is unique
            $originalSlug = $slug;
            $i = 1;
            while (DB::table('subcategories')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            
            $data = array();
            $data['category_id']=$request->category_id;
            $data['subcategory_name'] = $request->subcategory_name;
            $data['slug'] = $slug; // Use the unique slug
            DB::table('subcategories')->insert($data);

            return response()->json(['message' => 'Subcategory Created Successfully']);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
        
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('subcategories')->where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Subcategory not found'], 404);
        }
        $category = DB::table('categories')->get();
        return view('admin.subcategory.edit', compact('data', 'category'));
    }

    // Update Method
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_name' => 'required|max:255|unique:subcategories,subcategory_name,' . $id,
        ]);

        try {
            // Generate slug
            $slug = Str::slug($request->subcategory_name);

            // Ensure slug is unique except for this category
            $originalSlug = $slug;
            $i = 1;
            while (DB::table('subcategories')->where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }

            $data = array();
            $data['category_id']=$request->category_id;
            $data['subcategory_name'] = $request->subcategory_name;
            $data['slug'] = $slug;

            $update = DB::table('subcategories')->where('id', $id)->update($data);

            if ($update === 0) {
                return response()->json(['message' => 'No changes were made'], 200);
            }


            return response()->json(['message' => 'Subcategory Updated Successfully'], 200);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // Delete Method
    public function destroy($id)
    {
        $exists = DB::table('subcategories')->where('id', $id)->exists();

        if (!$exists) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        DB::table('subcategories')->where('id', $id)->delete();
        return response()->json(['message' => 'Subcategory Deleted Successfully']);
    }
}
