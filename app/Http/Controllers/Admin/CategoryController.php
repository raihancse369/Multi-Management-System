<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index + DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Fast DB query (no ->get())
            $query = DB::table('categories')->select('id', 'category_name', 'slug')->orderBy('id', 'DESC');

            return DataTables::of($query)
                ->addIndexColumn()

                // Action buttons
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm edit m-1"><i class="fa fa-pencil"></i></a>
                        <a href="#" data-url="'.route('category.delete', $row->id).'" class="btn btn-danger btn-sm delete_category"><i class="fa fa-trash"></i>
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.category.index');
    }

    // Store Method
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255|unique:categories,category_name',
        ]);

        try {
            $slug = Str::slug($request->category_name);

            // Ensure slug is unique
            $originalSlug = $slug;
            $i = 1;
            while (DB::table('categories')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            
            $data = array();
            $data['category_name'] = $request->category_name;
            $data['slug'] = $slug; // Use the unique slug
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table('categories')->insert($data);

            return response()->json(['message' => 'Category Created Successfully']);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
        
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('categories')->where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return view('admin.category.edit', compact('data'));
    }

    // Update Method
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id,
        ]);

        try {
            // Generate slug
            $slug = Str::slug($request->category_name);

            // Ensure slug is unique except for this category
            $originalSlug = $slug;
            $i = 1;
            while (DB::table('categories')->where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }

            $data = array();
            $data['category_name'] = $request->category_name;
            $data['slug'] = $slug;
            $data['updated_at'] = now();

            $update = DB::table('categories')->where('id', $id)->update($data);

            if ($update === 0) {
                return response()->json(['message' => 'No changes were made'], 200);
            }

            return response()->json(['message' => 'Category Updated Successfully'], 200);

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    // Delete Method
    public function destroy($id)
    {
        $exists = DB::table('categories')->where('id', $id)->exists();

        if (!$exists) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        DB::table('categories')->where('id', $id)->delete();
        return response()->json(['message' => 'Category Deleted Successfully']);
    }
}
