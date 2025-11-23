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

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 🧱 Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('products')
                ->leftJoin('categories', 'products.category_id', 'categories.id')
                ->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->leftJoin('brands', 'products.brand_id', 'brands.id')
                ->select('products.*','categories.category_name','subcategories.subcategory_name', 'brands.brand_name');

            // 🔍 Filters
            if ($request->category_id) {
                $query->where('products.category_id', $request->category_id);
            }
            if ($request->subcategory_id) {
                $query->where('products.subcategory_id', $request->subcategory_id);
            }
            if ($request->brand_id) {
                $query->where('products.brand_id', $request->brand_id);
            }

            $data = $query->orderByDesc('products.id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                
                ->editColumn('thumbnail', function ($row) {
                    $url = $row->thumbnail ? asset('uploads/product/' . $row->thumbnail) : asset('uploads/product/default.png');
                    return '<img src="' . $url . '" width="50" height="50">';
                })

                ->editColumn('status',function($row){
                    if ($row->status=="Active") {
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Active</button>';
                    }else{
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Deactive</button>';
                    }
                })

                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-success edit" data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="' . route('product.delete', $row->id) . '" class="btn btn-sm btn-danger delete_product">
                            <i class="fa fa-trash"></i>
                        </a>';
                })
                ->rawColumns(['thumbnail', 'status', 'action'])
                ->make(true);
        }

        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $brand = DB::table('brands')->get();

        return view('admin.product.index', compact('category', 'subcategory', 'brand'));
    }

    // 🧾 Store new product
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:products,code',
            'selling_price' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $slug = Str::slug($request->name);

        $data = [
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'code' => $request->code,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'tags' => $request->tags ?? null,
            'color' => $request->color ?? null,
            'size' => $request->size ?? null,
            'unit' => $request->unit ?? null,
            'purchase_price' => $request->purchase_price ?? 0,
            'discount_price' => $request->discount_price ?? null,
            'selling_price' => $request->selling_price,
            'description' => $request->description ?? null,
            'showpage' => $request->showpage ?? 'Yes',
            'status' => $request->status ?? 'Inactive',
            'admin_id' => Auth::id(),
            'slug' => $slug,
        ];

        // 🖼️ Handle Thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumb = $request->file('thumbnail');
            $thumbName = $slug . '_thumb.' . $thumb->getClientOriginalExtension();
            Image::make($thumb)->resize(600, 600)->save(public_path('uploads/product/' . $thumbName));
            $data['thumbnail'] = $thumbName;
        }

        // 🖼️ Handle Multiple Images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $img) {
                $name = $slug . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800)->save(public_path('uploads/product/' . $name));
                $images[] = $name;
            }
            $data['images'] = json_encode($images);
        }

        DB::table('products')->insert($data);

        return $request->ajax()
            ? response()->json(['message' => 'Product added successfully'])
            : redirect()->back()->with(['message' => 'Product added successfully', 'alert-type' => 'success']);
    }

    // ✏️ Edit Modal
    public function edit($id)
    {
        $data = DB::table('products')->where('id', $id)->first();
        if (!$data) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $brand = DB::table('brands')->get();

        return view('admin.product.edit', compact('data', 'category', 'subcategory', 'brand'));
    }

    // 🔁 Update product
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'selling_price' => 'required|numeric',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $slug = Str::slug($request->name);

        $product = DB::table('products')->where('id', $request->id)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $data = [
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'code' => $request->code,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'tags' => $request->tags ?? null,
            'color' => $request->color ?? null,
            'size' => $request->size ?? null,
            'unit' => $request->unit ?? null,
            'purchase_price' => $request->purchase_price ?? 0,
            'discount_price' => $request->discount_price ?? null,
            'selling_price' => $request->selling_price,
            'description' => $request->description ?? null,
            'showpage' => $request->showpage ?? 'Yes',
            'status' => $request->status ?? 'Inactive',
            'slug' => $slug,
        ];

        // Handle Thumbnail Update
        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail && File::exists(public_path('uploads/product/' . $product->thumbnail))) {
                File::delete(public_path('uploads/product/' . $product->thumbnail));
            }
            $thumb = $request->file('thumbnail');
            $thumbName = $slug . '_thumb.' . $thumb->getClientOriginalExtension();
            Image::make($thumb)->resize(600, 600)->save(public_path('uploads/product/' . $thumbName));
            $data['thumbnail'] = $thumbName;
        }

        // Handle Multiple Images Update
        $oldImages = $request->old_images ?? [];
        $existingImages = json_decode($product->images, true) ?? [];

        // Delete removed old images
        foreach ($existingImages as $img) {
            if (!in_array($img, $oldImages) && File::exists(public_path('uploads/product/' . $img))) {
                File::delete(public_path('uploads/product/' . $img));
            }
        }

        // Add new uploaded images
        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $name = $slug . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800)->save(public_path('uploads/product/' . $name));
                $newImages[] = $name;
            }
        }

        $data['images'] = json_encode(array_merge($oldImages, $newImages));

        DB::table('products')->where('id', $request->id)->update($data);

        return response()->json(['message' => 'Product updated successfully']);
    }

    // ❌ Delete product
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete thumbnail
        if ($product->thumbnail && File::exists(public_path('uploads/product/' . $product->thumbnail))) {
            File::delete(public_path('uploads/product/' . $product->thumbnail));
        }

        // Delete multiple images
        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $img) {
                if (File::exists(public_path('uploads/product/' . $img))) {
                    File::delete(public_path('uploads/product/' . $img));
                }
            }
        }

        DB::table('products')->where('id', $id)->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
