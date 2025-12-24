<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;
use Image;
use File;


class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    // Index: list + AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $imgurl='/uploads/campaign/';

            $data = DB::table('campaigns')->orderBy('id','DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('image', function ($row) use ($imgurl){
                    return '<img src="'.$imgurl.'/'.$row->image.'" height="50">';
                })

                ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return '<button type="button" class="btn btn-success btn-sm waves-effect waves-light btn-sm">Active</button>';
                    }else{
                        return '<button type="button" class="btn btn-danger btn-sm waves-effect waves-light btn-sm">Deactive</button>';
                    }
                })
                
                ->addColumn('action', function($row){
                    $actionBtn='
                        
                        <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-success btn-sm waves-effect waves-light tooltips m-1 edit" data-placement="top" data-toggle="modal" data-target="#editModal" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-pencil"></i>
                        </a>
                        <a href="'.route('campaign.delete', $row->id).'" class="btn btn-danger btn-sm delete_campaign"><i class="fa fa-trash"></i></a>
                        <a href="'.route('campaign.product', $row->id).'" class="btn btn-info btn-sm "><i class="fa fa-plus"></i></a>';
                        
                    return $actionBtn;
                })
                ->rawColumns(['action','status','image'])
                ->make(true);

        }
      
        return view('admin.campaign.index');
    }

    // Store Method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['slug']=Str::slug($request->title, '-');
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['discount']=$request->discount;
        $data['status']=$request->status;
        $data['month']=date('F');
        $data['year']=date('Y');
        
        // Single photo
        if ($request->image) {
            $photo=$request->image;
            $photoname=$slug.'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(1920,1080)->save('uploads/campaign/'.$photoname);
            $data['image']=$photoname;
        }

        $story = DB::table('campaigns')->insert($data);
        $notification=array('message' => 'Data Inserted Successfully !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Edit Method
    public function edit($id)
    {
        $data = DB::table('campaigns')->where('id', $id)->first();

        if (!$data) {
            // Return JSON error if post not found (since this is an AJAX call)
            return response()->json(['error' => 'Data not found.'], 404);
        }

        return view('admin.campaign.edit', compact('data'));
    }


    // Update Method
    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['slug']=Str::slug($request->title, '-');
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['discount']=$request->discount;
        $data['status']=$request->status;
        $data['month']=date('F');
        $data['year']=date('Y');


        $old_data =  DB::table('campaigns')->where('id',$request->id)->first();

        if ($request->hasFile('image')) {
            $oldFile = public_path('uploads/campaign/' . $request->old_photo);
            if (File::exists($oldFile)) {
                unlink($oldFile);
            }

            $photo = $request->file('image');
            $photoname = $slug . '_' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(1920, 1080)->save(public_path('uploads/campaign/' . $photoname));
            $data['image'] = $photoname;
        } else {
            $data['image'] = $request->old_photo;
        }

        DB::table('campaigns')->where('id', $request->id)->update($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Data Updated Successfully']);
        }

        $notification = ['messege' => 'Data Updated Successfully!', 'alert-type' => 'success'];
        return redirect()->route('campaign.index')->with($notification);

    }


    public function destroy($id)
    {
        $campaign = DB::table('campaigns')->where('id', $id)->first();
        if (!$campaign) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        $file_path = public_path('uploads/campaign/' . $campaign->image);
        if (File::exists($file_path)) {
            unlink($file_path);
        }

        $deleted = DB::table('campaigns')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'Data Deleted Successfully']);
        }

        return response()->json(['message' => 'Error deleting data.'], 500);
    }

    //__campaign products all method__//
    public function campaignProduct($campaign_id)
    {
        $product = DB::table('products')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->leftJoin('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.status', 'Active')
            ->get();

        // Get all existing campaign product IDs
        $existingProducts = DB::table('campaign_product')
            ->where('campaign_id', $campaign_id)
            ->pluck('product_id')
            ->toArray();

        return view('admin.campaign-product.index', compact('product', 'campaign_id', 'existingProducts'));
    }


    //__add product to campaign__//
    public function ProductAddToCampaign($id,$campaign_id)
    {
       $campaign=DB::table('campaigns')->where('id',$campaign_id)->first();
       $product=DB::table('products')->where('id',$id)->first();

       $discount_amount=$product->discount_price/100*$campaign->discount;
       $discount_price=$product->discount_price-$discount_amount;

       $data=array();
       $data['product_id']=$id;
       $data['campaign_id']=$campaign_id;
       $data['price']=$discount_price;
       DB::table('campaign_product')->insert($data);
       $notification=array('message' => 'Product added to campaign!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }

    //__product list__//
    public function ProductListCampaign($campaign_id)
    {
        $products = DB::table('campaign_product')
            ->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.name', 'products.code', 'products.thumbnail', 'campaign_product.id', 'campaign_product.price')
            ->where('campaign_product.campaign_id', $campaign_id)
            ->get();

        $campaign = DB::table('campaigns')->where('id', $campaign_id)->first();

        return view('admin.campaign-product.campaign_product_list', compact('products', 'campaign'));
    }


    //__product rmove from campaign__//
    public function RemoveProduct($id)
    {
        DB::table('campaign_product')->where('id',$id)->delete();
        $notification=array('message' => 'Product remove from campaign!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    
}
