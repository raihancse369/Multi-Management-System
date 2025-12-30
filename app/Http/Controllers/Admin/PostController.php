<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ---------------------------------------------
    // INDEX - List all posts (AJAX DataTable)
    // ---------------------------------------------
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = DB::table('posts')
                ->leftJoin('blogcategories', 'posts.category_id', '=', 'blogcategories.id')
                ->select('posts.*', 'blogcategories.category_name');

            // Filters
            if ($request->category_id) {
                $query->where('posts.category_id', $request->category_id);
            }

            if ($request->date) {
                $query->whereDate('posts.date', $request->date);
            }

            // Let DataTables handle pagination
            return DataTables::of($query)
                ->addIndexColumn()

                // Image column
                ->editColumn('image', function ($row) {
                    $url = asset('uploads/post/' . $row->image);
                    return '<img src="' . $url . '" height="50" alt="Image">';
                })

                // Action buttons
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" 
                                class="btn btn-success btn-sm edit" 
                                title="Edit"><i class="fa fa-pencil"></i></a>';

                    $deleteBtn = '<a href="' . route('blog.delete', $row->id) . '" 
                                  class="btn btn-danger btn-sm delete_blog" 
                                  title="Delete"><i class="fa fa-trash"></i></a>';

                    return $editBtn . ' ' . $deleteBtn;
                })

                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        $category = DB::table('blogcategories')->get();
        return view('admin.blog.index', compact('category'));
    }

    // ---------------------------------------------
    // STORE - Create new post
    // ---------------------------------------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:blogcategories,id',
            'title' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'details' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $slug = Str::slug($request->title, '-');
        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'details' => $request->details,
            'user_id' => Auth::id(),
            'tags' => $request->tags,
            'date' => now()->toDateString(),
            'slug' => $slug,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(1920, 1280)->save(public_path('uploads/post/' . $filename));
            $data['image'] = $filename;
        }

        DB::table('posts')->insert($data);
        if ($request->ajax()) {
            return response()->json(['message' => 'Post inserted successfully.']);
        }
        return redirect()->back()->with(['message' => 'Post inserted successfully!','alert-type' => 'success',]);

    }

    // ---------------------------------------------
    // EDIT - Return form partial for modal
    // ---------------------------------------------
    public function edit($id)
    {
        $data = DB::table('posts')->where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Post not found.'], 404);
        }

        $category = DB::table('blogcategories')->get();

        return view('admin.blog.edit', compact('data', 'category'));
    }

    // ---------------------------------------------
    // UPDATE - AJAX update handler
    // ---------------------------------------------
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:blogcategories,id',
            'title' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'details' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $slug = Str::slug($request->title, '-');

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'details' => $request->details,
            'user_id' => Auth::id(),
            'tags' => $request->tags,
            'slug' => $slug,
        ];

        // Handle image replacement
        if ($request->hasFile('image')) {
            $oldPath = public_path('uploads/post/' . $request->old_photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $photo = $request->file('image');
            $filename = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(1920, 1280)->save(public_path('uploads/post/' . $filename));
            $data['image'] = $filename;
        } else {
            $data['image'] = $request->old_photo;
        }

        DB::table('posts')->where('id', $id)->update($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'new_image' => asset('uploads/post/' . $data['image']),
            ]);
        }

        return redirect()->route('blog')->with([
            'message' => 'Data updated successfully!',
            'alert-type' => 'success',
        ]);
    }

    // ---------------------------------------------
    // DESTROY - Delete post
    // ---------------------------------------------
    public function destroy($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found.'], 404);
        }

        $filePath = public_path('uploads/post/' . $post->image);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        DB::table('posts')->where('id', $id)->delete();

        return response()->json(['message' => 'Data deleted successfully.']);
    }
}
