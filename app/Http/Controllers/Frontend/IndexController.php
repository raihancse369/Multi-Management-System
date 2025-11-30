<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;


class IndexController extends Controller
{

    //root page
    public function index()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $featured = DB::table('products')
            ->leftJoin('campaign_product', 'products.id', '=', 'campaign_product.product_id')
            ->leftJoin('campaigns', 'campaign_product.campaign_id', '=', 'campaigns.id')
            ->select('products.*','campaign_product.price as campaign_price','campaigns.status as campaign_status','campaigns.start_date','campaigns.end_date')
            ->where('products.status', 'Active')
        ->where('showpage', 'Featured')
        ->orderBy('id', 'DESC')->limit(4)->get();
        //$featured = DB::table('products')->where('status', 'Active')->where('showpage', 'Featured')->orderBy('id', 'DESC')->limit(16)->get();
        $todaydeal = DB::table('products')
            ->leftJoin('campaign_product', 'products.id', '=', 'campaign_product.product_id')
            ->leftJoin('campaigns', 'campaign_product.campaign_id', '=', 'campaigns.id')
            ->select('products.*','campaign_product.price as campaign_price','campaigns.status as campaign_status','campaigns.start_date','campaigns.end_date')->where('products.status', 'Active')->where('showpage', 'Today Deal')->orderBy('id', 'DESC')->limit(6)->get();

        //$todaydeal = DB::table('products')->where('status', 'Active')->where('showpage', 'Today Deal')->orderBy('id', 'DESC')->limit(6)->get();
        $trendy = DB::table('products')
            ->leftJoin('campaign_product', 'products.id', '=', 'campaign_product.product_id')
            ->leftJoin('campaigns', 'campaign_product.campaign_id', '=', 'campaigns.id')
            ->select('products.*','campaign_product.price as campaign_price','campaigns.status as campaign_status','campaigns.start_date','campaigns.end_date')->where('products.status', 'Active')->where('showpage', 'Trendy')->orderBy('id', 'DESC')->limit(8)->get();

        //$trendy = DB::table('products')->where('status', 'Active')->where('showpage', 'Trendy')->orderBy('id', 'DESC')->limit(8)->get();
        return view('welcome',compact('category','featured','todaydeal','trendy'));
    }

    //single product page calling method
    public function ProductDetails($slug)
    {
        $product=DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('campaign_product', 'products.id', '=', 'campaign_product.product_id')
            ->leftJoin('campaigns', 'campaign_product.campaign_id', '=', 'campaigns.id')
            ->where('products.slug', $slug)
            ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name','campaign_product.price as campaign_price','campaigns.status as campaign_status','campaigns.start_date','campaigns.end_date')->first();

        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $review=DB::table('reviews')->join('users', 'reviews.user_id', '=', 'users.id')->where('reviews.product_id', $product->id)->orderBy('reviews.id', 'DESC')->limit(6)->select('reviews.*', 'users.name as user_name')->get();
        return view('frontend.product.product-details',compact('product','related_product','review'));
    }

    //product quick view
    public function ProductQuickView($id)
    {
        $product=DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('products.id',$id)
            ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')->first();
        return view('frontend.product.quick-view',compact('product'));
    }

    //Custom page view method
    public function ViewPage($page_slug)
    {
        $page=DB::table('pages')->where('page_slug',$page_slug)->first();
        return view('frontend.page',compact('page'));
    }

    //Post details page view method
    public function BlogPage($slug)
    {
        $post = DB::table('posts')
            ->join('blogcategories', 'posts.category_id', '=', 'blogcategories.id')
            ->where('posts.slug', $slug)
            ->select('posts.*', 'blogcategories.category_name')
            ->first();
        return view('frontend.blog-details', compact('post'));
    }

        //__campaign products__//
    public function CampaignProduct($id)
    {
        $products=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                    ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                    ->where('campaign_product.campaign_id',$id)
                    ->paginate(32);          
        return view('frontend.campaign.product-list',compact('products'));
    }

        //__campaign product details__//
public function CampaignProductDetails($slug)
{
    // Get full product info with category, subcategory, brand, and campaign info
    $product = DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
        ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
        ->leftJoin('campaign_product', 'products.id', '=', 'campaign_product.product_id')
        ->leftJoin('campaigns', 'campaign_product.campaign_id', '=', 'campaigns.id')
        ->where('products.slug', $slug)
        ->select(
            'products.*',
            'categories.category_name',
            'subcategories.subcategory_name',
            'brands.brand_name',
            'campaign_product.price as campaign_price',
            'campaigns.status as campaign_status',
            'campaigns.start_date',
            'campaigns.end_date'
        )
        ->first();

    if (!$product) {
        abort(404, 'Product not found');
    }

    // Get related campaign products
    $related_product = DB::table('campaign_product')
        ->leftJoin('products', 'campaign_product.product_id', '=', 'products.id')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
        ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
        ->select(
            'products.name',
            'products.code',
            'products.thumbnail',
            'products.slug',
            'products.selling_price',
            'campaign_product.price as discount_price',
            'categories.category_name',
            'subcategories.subcategory_name',
            'brands.brand_name'
        )
        ->inRandomOrder()
        ->limit(12)
        ->get();

    // Get product reviews
    $review = DB::table('reviews')
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->where('reviews.product_id', $product->id)
        ->orderBy('reviews.id', 'DESC')
        ->limit(6)
        ->select('reviews.*', 'users.name as user_name')
        ->get();

    return view('frontend.campaign.product-details', compact('product', 'related_product', 'review'));
}




    // About page
    public function About()
    {
        return view('frontend.about');
    }

    // Blog page
    public function Blog()
    {
        return view('frontend.blog');
    }

    // Service page

    public function Service()
    {
        return view('frontend.service');
    }

    // Project page
    public function Project()
    {
        return view('frontend.project');
    }

    //Contact page
    public function Contact()
    {
        return view('frontend.contact');
    }

public function ContactMessage(Request $request)
{
    // Only allow logged-in users
    if (!Auth::check()) {
        return response()->json([
            'message' => 'You must be logged in to send a message.'
        ], 403); // 403 Forbidden
    }

    // Validate request
    $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required',
    ]);

    $data = [
        'user_id' => Auth::id(), 
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ];

    DB::table('contacts')->insert($data);

    return response()->json(['message' => 'Message Sent Successfully']);
}



}
