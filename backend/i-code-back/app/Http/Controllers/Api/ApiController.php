<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CmsPage;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\Section;
use App\Models\ShippingCharge;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;
use Validator;
use Auth;
use DB;

class APIController extends Controller
{
    public function registerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            // validation
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ];
            $customMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.unique' => 'Email already exists',
                'password.required' => 'Password is required'
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = new User;
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();
            return response()->json(['status' => true, 'message' => 'User registered successfully!']);
        }
    }
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            // echo "<pre>";
            // print_r($data);
            // die;
            $rules = [
                'email' => 'required|email|exists:users',
                'password' => 'required'
            ];
            $customMessage = [
                'email.required' => 'Email is required',
                'email.exists' => 'Email does not exists',
                'password.required' => 'Password is required'
            ];
            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                $userDetails = User::where('email', $data['email'])->first();
                if (password_verify($data['password'], $userDetails->password)) {
                    return response()->json([
                        'userDetails' => $userDetails,
                        'status' => true,
                        'message' => 'User login successfully!'
                    ], 201);
                } else {
                    $message = 'Password is incorrect';
                    return response()->json([
                        'status' => false,
                        'message' => $message,
                    ], 422);
                }
            } else {
                $message = 'Email is incorrect';
                return response()->json([
                    'status' => false,
                    'message' => $message,
                ], 422);
            }
        }
    }

    public function updateUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            // echo "<pre>";
            // print_r($data);
            // die;
            $rules = ["name" => 'required'];
            $customMessage = [
                'name.required' => 'Name is required',
            ];
            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $userCount = User::where('id', $data['id'])->count();
            if ($userCount > 0) {
                if (empty($data['city'])) {
                    $data['city'] = "";
                }
                if (empty($data['state'])) {
                    $data['state'] = "";
                }
                if (empty($data['country'])) {
                    $data['country'] = "";
                }
                if (empty($data['pincode'])) {
                    $data['pincode'] = "";
                }
                if (empty($data['address'])) {
                    $data['address'] = "";
                }
                User::where('id', $data['id'])->update(['name' => $data['name'], 'address' => $data['address'], 'city' => $data['city'], 'state' => $data['state'], 'country' => $data['country'], 'pincode' => $data['pincode']]);
                $userDetails = User::where('id', $data['id'])->first();

                return response()->json([
                    'userDetails' => $userDetails,
                    'status' => true,
                    'message' => 'User Updated successfully!'
                ], 201);
            } else {
                $message = 'User does not exists';
                return response()->json([
                    'status' => false,
                    'message' => $message,
                ], 422);
            }
        }
    }

    public function cmsPage()
    {
        $currentRoute = url()->current();
        $currentRoute = str_replace("http://127.0.0.1:8000/api/", "", $currentRoute);
        $cmsRoutes = CmsPage::select('url')->where('status', 1)->get()->pluck('url')->toArray();
        if (in_array($currentRoute, $cmsRoutes)) {
            $cmsPageDetails = CmsPage::where('url', $currentRoute)->get();
            return response()->json([
                'cmsPageDetails' => $cmsPageDetails,
                'status' =>  true,
                'message' => 'Page details fetched successfully!'
            ], 200);
        } else {
            $message = "Page does not exists";
            return response()->json([
                'status' => false,
                'message' => $message
            ], 422);
        }
    }

    public function menu()
    {
        $categories = Section::with('categories')->get();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function listing($url)
    {
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::categoryDetails($url);
            $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

            // Checking for dynamic filters
            $productFilters = ProductsFilter::productFilters();
            foreach ($productFilters as $key => $filter) {
                if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                    $categoryProducts->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                }
            }
            // Checking the sort
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                if ($_GET['sort'] == 'product_latest') {
                    $categoryProducts->orderby('products.id', 'Desc');
                } else if ($_GET['sort'] == 'price_lowest') {
                    $categoryProducts->orderby('products.product_price', 'Asc');
                } else if ($_GET['sort'] == 'price_highest') {
                    $categoryProducts->orderby('products.product_price', 'Desc');
                } else if ($_GET['sort'] == 'name_z_a') {
                    $categoryProducts->orderby('products.product_name', 'Desc');
                } else if ($_GET['sort'] == 'name_a_z') {
                    $categoryProducts->orderby('products.product_name', 'Asc');
                }
            }

            // Checking the size
            if (isset($data['size']) && !empty($data['size'])) {
                $productIds = ProductsAttribute::select('product_id')->whereIn('size', $data['size'])->pluck('product_id')->toArray();
                $categoryProducts->whereIn('products.id', $productIds);
            }

            // Checking the color
            if (isset($data['color']) && !empty($data['color'])) {
                $productIds = Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray();
                $categoryProducts->whereIn('products.id', $productIds);
            }

            // Checking for Price
            $productIds = array();
            if (isset($data['price']) && !empty($data['price'])) {
                foreach ($data['price'] as $key => $price) {
                    $priceArr = explode('-', $price);
                    if (isset($priceArr[0]) && isset($priceArr[1])) {
                        $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                    }
                }
                $productIds = array_unique(array_flatten($productIds));
                // echo "<pre>";print_r($productIds);die;
                $categoryProducts->whereIn('products.id', $productIds);
            }

            // Checking the brand
            if (isset($data['brand']) && !empty($data['brand'])) {
                $productIds = Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray();
                $categoryProducts->whereIn('products.id', $productIds);
            }

            $categoryProducts = $categoryProducts->get();
            foreach ($categoryProducts as $key => $value) {
                $getDiscountPrice = Product::discountPrice($categoryProducts[$key]['id']);
                if ($getDiscountPrice > 0) {
                    $categoryProducts[$key]['final_price'] = $getDiscountPrice . " Tk";
                } else {
                    $categoryProducts[$key]['final_price'] = $categoryProducts[$key]['product_price'] . " Tk";
                }
                $categoryProducts[$key]['product_image'] = url("admin/photos/product_images/small/" . $categoryProducts[$key]['product_image']);
            }
            return response()->json(['products' => $categoryProducts], 200);
        } else {
            $message = "Category URL is Incorrect!";
            return response()->json(['status' => false, 'message' => $message], 422);
        }
    }

    public function productDetail($id)
    {
        $productCount = Product::where(['id' => $id, 'status' => 1])->count();
        if ($productCount > 0) {
            $productDetails = Product::with(['section', 'category', 'brand', 'attributes' => function ($query) {
                $query->where('stock', '>', 0)->where('status', 1);
            }, 'images', 'vendor'])->where('id', $id)->get();
            foreach ($productDetails as $key => $value) {
                $getDiscountPrice = Product::discountPrice($productDetails[$key]['id']);
                if ($getDiscountPrice > 0) {
                    $productDetails[$key]['final_price'] = $getDiscountPrice . " Tk";
                } else {
                    $productDetails[$key]['final_price'] = $productDetails[$key]['product_price'] . " Tk";
                }
                $productDetails[$key]['product_image'] = url("admin/photos/product_images/small/" . $productDetails[$key]['product_image']);
            }
            return response()->json(['products' => $productDetails], 200);
        } else {
            $message = "Product is not available";
            return response()->json(['status' => false, 'message' => $message], 422);
        }
    }

    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            // Check product already exists or not
            $countProducts = Cart::where(['product_id' => $data['productid'], 'size' => $data['size'], 'user_id' => $data['userid']])->count();
            if ($countProducts > 0) {
                $message = "Product already exists in cart";
                return response()->json(['status' => false, "message" => $message], 422);
            }
            $item = new Cart;
            $item->session_id = 0;
            $item->user_id = $data['userid'];
            $item->product_id = $data['productid'];
            $item->size = $data['size'];
            $item->quantity = 1;
            $item->source = "App";
            $item->save();
            return response()->json(['status' => true, 'message' => 'Product Added in Cart!'], 200);
        }
    }
    public function cart($userid)
    {
        $getCartItems = Cart::with(['product' => function ($query) {
            $query->select('id', 'category_id', 'product_name', 'product_code', 'product_color', 'product_image', 'product_weight', 'product_price');
        }])->orderBy('id', 'Desc')->where('user_id', $userid)->get();
        foreach ($getCartItems as $key => $item) {
            $getDiscountPrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
            if ($getDiscountPrice > 0) {
                $getCartItems[$key]['product']['final_price'] = $getDiscountPrice['final_price'] . " Tk";
            } else {
                $getCartItems[$key]['product']['final_price'] = $item['product']['product_price'];
            }
            $getCartItems[$key]['product']['product_image'] = url("admin/photos/product_images/small/" . $item['product']['product_image']);
        }
        // dd($getCartItems);
        return response()->json(['products' => $getCartItems]);
    }

    public function deleteCartItem($cartid)
    {
        Cart::where('id', $cartid)->delete();
        return response()->json(['status' => true, 'message' => "Product deleted from cart"], 200);
    }

    public function checkout($userid)
    {
        $getCartItems = Cart::with(['product' => function ($query) {
            $query->select('id', 'category_id', 'product_name', 'product_code', 'product_color', 'product_image', 'product_weight', 'product_price');
        }])->orderBy('id', 'Desc')->where('user_id', $userid)->get();
        $total_price = 0;
        foreach ($getCartItems as $key => $item) {
            $getDiscountPrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
            if ($getDiscountPrice > 0) {
                $getCartItems[$key]['product']['final_price'] = $getDiscountPrice['final_price'] . " Tk";
                $total_price = $total_price + $getDiscountPrice['final_price'];
            } else {
                $getCartItems[$key]['product']['final_price'] = $item['product']['product_price'];
                $total_price = $total_price + $item['product']['product_price'];
            }
            $getCartItems[$key]['product']['product_image'] = url("admin/photos/product_images/small/" . $item['product']['product_image']);
        }
        // dd($total_price);
        foreach ($getCartItems as $key => $item) {
            $getCartItems[$key]['product']['total_price'] = $total_price;
            $getCartItems[$key]['product']['key'] = $key;
        }
        return response()->json(['products' => $getCartItems]);
    }

    public function placeOrder($userid, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;

            $getCartItems = Cart::with(['product' => function ($query) {
                $query->select('id', 'category_id', 'product_name', 'product_code', 'product_color', 'product_image', 'product_weight', 'product_price');
            }])->orderBy('id', 'Desc')->where('user_id', $userid)->get();
            $total_price = 0;
            $total_weight = 0;
            foreach ($getCartItems as $key => $item) {
                $getDiscountPrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                if ($getDiscountPrice > 0) {
                    $getCartItems[$key]['product']['final_price'] = $getDiscountPrice['final_price'] . " Tk";
                    $total_price = $total_price + $getDiscountPrice['final_price'];
                } else {
                    $getCartItems[$key]['product']['final_price'] = $item['product']['product_price'];
                    $total_price = $total_price + $item['product']['product_price'];
                }
                $getCartItems[$key]['product']['product_image'] = url("admin/photos/product_images/small/" . $item['product']['product_image']);

                $getProductWeight = Product::select('product_weight')->where('id', $item['product_id'])->first();
                $total_weight = $total_weight + $getProductWeight->product_weight;
            }
            $payment_method = "COD";
            $order_status = "New";

            DB::beginTransaction();
            // Fetch total price
            $total_price = 0;
            foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']);
            }

            // dd($total_price);
            // Calculate shipping charges
            $shipping_charges = 0;
            // Get Shipping Charges
            $shipping_charges = ShippingCharge::getShippingCharges($total_weight, $data['country']);

            // Grand Total
            $grand_total = $total_price + $shipping_charges;

            // Insert order details
            $order = new Order;
            $order->user_id = $userid;
            $order->name = $data['name'];
            $order->address = $data['address'];
            $order->city = $data['city'];
            $order->state = $data['state'];
            $order->country = $data['country'];
            $order->pincode = $data['pincode'];
            $order->mobile = $data['mobile'];
            // Get user email
            $getUserEmail = User::select('email')->where('id', $userid)->first();

            $order->email = $getUserEmail->email;

            $order->shipping_charges = $shipping_charges;
            $order->order_status = $order_status;
            $order->payment_method = $payment_method;
            $order->payment_gateway = "COD";
            $order->grand_total = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();
            foreach ($getCartItems as $item) {
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'vendor_id')->where('id', $item['product_id'])->first()->toArray();
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);

                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = $userid;

                $cartItem->admin_id = $getProductDetails['admin_id'];
                $cartItem->vendor_id = $getProductDetails['vendor_id'];
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $cartItem->product_size = $item['size'];
                $cartItem->product_price = $getDiscountAttributePrice['final_price'];

                $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['size']);

                if ($item['quantity'] > $getProductStock) {
                    $message = $getProductDetails['product_name'] . " with " . $item['size'] . " Quantity is not available.Please reduce its quantity and try again.";

                    return redirect('/cart')->with('error_message', $message);
                }

                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();

                // Reduce stock starts here
                $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['size']);
                $newStock = $getProductStock - $item['quantity'];

                ProductsAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']])->update(['stock' => $newStock]);
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Order confirmed successfully!'], 200);
        }
    }
    public function userOrders($userid)
    {
        $orders = Order::where('user_id', $userid)->orderBy('id', 'Desc')->get();
        foreach ($orders as $key => $order) {
            $orders[$key]['created_on'] = date("d-m-Y H:i:s", strtotime($order->created_at));
        }
        return response()->json(['orders' => $orders], 200);
    }
}
