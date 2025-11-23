<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Auth;
use DB;

class CartController extends Controller
{
    //add to cart method
public function AddToCartQV(Request $request)
{
    // 1️⃣ Check if user is logged in
    if (!Auth::check()) {
        return response()->json([
            "error" => "Please login to add items to your cart.",
            "redirect" => route('login'),
        ], 401);
    }

    // 2️⃣ Validate input data
    $request->validate([
        'id' => 'required|integer|exists:products,id',
        'qty' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'size' => 'nullable|string|max:50',
        'color' => 'nullable|string|max:50',
    ]);

    // 3️⃣ Retrieve product from database
    $product = DB::table("products")->where("id", $request->id)->first();

    // 4️⃣ If product not found (extra safety)
    if (!$product) {
        return response()->json([
            "error" => "Product not found!",
        ], 404);
    }

    // 5️⃣ Add product to cart
    Cart::add([
        "id" => $product->id,
        "name" => $product->name,
        "qty" => $request->qty,
        "price" => $request->price,
        "weight" => 1,
        "options" => [
            "size" => $request->size,
            "color" => $request->color,
            "thumbnail" => $product->thumbnail,
        ],
    ]);

    // 6️⃣ Return success message
    return response()->json([
        "success" => "Product added to cart successfully!",
    ]);
}


    //all cart
    public function AllCart()
    {
        $data = [];
        $data["cart_qty"] = Cart::count();
        $data["cart_total"] = Cart::total();
        return response()->json($data);
    }

    public function MyCart()
    {
        if (!Auth::check()) {
            $notification = ["message" => "Login Your Account!","alert-type" => "error",];
            return redirect()->back()->with($notification);
        }
        $content = Cart::content();
        return view("frontend.cart.cart", compact("content"));
    }

public function RemoveProduct($rowId)
{
    $item = Cart::get($rowId);
    if (!$item) {
        return response()->json(['error' => 'Item not found in cart.'], 404);
    }

    Cart::remove($rowId);
    return response()->json(['success' => 'Product removed successfully !']);
}


    public function UpdateQty($rowId, $qty)
    {
        // Update the cart item
        Cart::update($rowId, $qty);

        // Re-fetch the updated item
        $updatedItem = Cart::get($rowId);

        return response()->json([
            "message" => "Quantity updated successfully.",
            "item_price" => $updatedItem->price,
            "item_qty" => $updatedItem->qty,
            "item_total" => $updatedItem->price * $updatedItem->qty,
            "cart_subtotal" => Cart::subtotal(2, ".", ""), // returns numeric string without commas
        ]);
    }

    public function CartUpdate(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        // Update cart quantity
        Cart::update($rowId, ["qty" => $qty]);

        // Get updated cart row
        $row = Cart::get($rowId);

        // Prepare response data
        return response()->json([
            "price" => $row->price,
            "qty" => $row->qty,
            "total" => $row->qty * $row->price,
            "subtotal" => Cart::subtotal(),
        ]);
    }

    public function updateOption(Request $request)
    {
        $rowId = $request->rowId;
        $option = $request->option;
        $value = $request->value;

        $item = Cart::get($rowId);
        if (!$item) {
            return response()->json(['error' => 'Item not found.'], 404);
        }

        $options = $item->options->toArray();
        $options[$option] = $value;

        $newItem = Cart::add([
            'id' => $item->id,
            'name' => $item->name,
            'qty' => $item->qty,
            'price' => $item->price,
            'options' => $options,
        ]);

        Cart::remove($rowId);

        return response()->json([
            'success' => ucfirst($option) . ' updated successfully',
            'newRowId' => $newItem->rowId,
            'qty' => $newItem->qty,
            'price' => $newItem->price,
            'total' => $newItem->qty * $newItem->price,
            'subtotal' => Cart::subtotal(2, '.', ''),
        ]);
    }



    public function EmptyCart()
    {
        Cart::destroy();
        $notification = [ "message" => "Cart item clear","alert-type" => "success",];
        return redirect()->to("/")->with($notification);
    }

    // wishlist
    public function wishlist()
    {
        if (Auth::check()) {
            $wishlist = DB::table("wishlists")
                ->leftJoin("products", "wishlists.product_id", "products.id")
                ->select("products.name","products.thumbnail","products.slug","wishlists.*",)
                ->where("wishlists.user_id", Auth::id())->get();
            return view("user.wishlist", compact("wishlist"));
        }
        $notification = ["message" => "At first login your account","alert-type" => "error",];
        return redirect()->back()->with($notification);
    }

    public function Clearwishlist()
    {
        DB::table("wishlists")->where("user_id", Auth::id())->delete();
        $notification = ["message" => "Wishlist Clear","alert-type" => "success",];
        return redirect()->back()->with($notification);
    }

    public function AddWishlist($id)
    {
        if (Auth::check()) {
            $check = DB::table("wishlists")
                ->where("product_id", $id)
                ->where("user_id", Auth::id())
                ->first();
            if ($check) {
                $notification = ["message" => "Already have it on your wishlist !","alert-type" => "error",];
                return redirect()->back()->with($notification);
            } else {
                $data = [];
                $data["product_id"] = $id;
                $data["user_id"] = Auth::id();
                $data["date"] = date("d , F Y");
                DB::table("wishlists")->insert($data);
                $notification = ["message" => "Product added on wishlist!","alert-type" => "success",];
                return redirect()->back()->with($notification);
            }
        }

        $notification = ["message" => "Login Your Account!","alert-type" => "error",];
        return redirect()->back()->with($notification);
    }

    public function WishlistProductdelete($id)
    {
        DB::table("wishlists")->where("id", $id)->delete();
        $notification = ["message" => "Successfully Deleted!","alert-type" => "success",];
        return redirect()->back()->with($notification);
    }
}
