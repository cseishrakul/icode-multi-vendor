<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\ShippingCharge;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Session;
use DB;
use Auth;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $url = $data['url'];
            $_GET['sort'] = $data['sort'];
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

                // Checking the price
                // if (isset($data['price']) && !empty($data['price'])) {
                //     foreach ($data['price'] as $key => $price) {
                //         $priceArr = explode('-', $price);
                //         $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                //     }
                //     $productIds = call_user_func_array('array_merge', $productIds);
                //     // echo "<pre>";print_r($productIds);die;
                //     $categoryProducts->whereIn('products.id', $productIds);
                // }

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

                $categoryProducts = $categoryProducts->paginate(30);
                // dd($categoryDetails);
                // echo "<pre>";print_r($categoryDetails);die;
                $meta_title = $categoryDetails['categoryDetails']['meta_title'];
                $meta_keywords = $categoryDetails['categoryDetails']['meta_keywords'];
                $meta_description = $categoryDetails['categoryDetails']['meta_description'];

                return view('front.products.ajax_products_listing', compact('categoryDetails', 'categoryProducts', 'url', 'meta_title', 'meta_keywords', 'meta_description'));
            } else {
                abort(404);
            }
        } else {
            if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
                if ($_REQUEST['search'] == 'new-arrivals') {
                    $search_product = $_REQUEST['search'];
                    $categoryDetails['breadcrumbs'] = 'New Arrivals';
                    $categoryDetails['categoryDetails']['category_name'] = 'New Arrivals';
                    $categoryDetails['categoryDetails']['description'] = "New Arrival Products";
                    $categoryProducts = Product::select('product_id', 'products.section_id', 'products.product_name', 'products.product_code', 'products.product_color', 'products.product_price', 'products.product_description', 'products.product_discount', 'products.product_image')->with('brand')->join('categories', 'categories.id', '=', 'category_id')->where('products.status', 1)->orderBy('id','Desc');
                } else {
                    $search_product = $_REQUEST['seach'];
                    $categoryDetails['breadcrumbs'] = $search_product;
                    $categoryDetails['categoryDetails']['category_name'] = $search_product;
                    $categoryDetails['categoryDetails']['description'] = "Search Product for" . $search_product;
                    $categoryProducts = Product::select('product_id', 'products.section_id', 'products.product_name', 'products.product_code', 'products.product_color', 'products.product_price', 'products.product_description', 'products.product_discount', 'products.product_image')->with('brand')->join('categories', 'categories.id', '=', 'category_id')->where(function ($query) use ($search_product) {
                        $query->where("products.porduct_name", 'like', '%' . $search_product . '%')
                            ->orWhere("products.product_code", 'like', '%' . $search_product . '%')
                            ->orWhere("products.product_color", 'like', '%' . $search_product . '%')
                            ->orWhere("products.description", 'like', '%' . $search_product . '%')
                            ->orWhere("categories.category_name", 'like', '%' . $search_product . '%');
                    })->where('products.status', 1);
                }
                if (isset($_REQUEST['section_id']) && !empty($_REQUEST['section_id'])) {
                    $categoryProducts = $categoryProducts->where('products.section_id', $_REQUEST['section_id']);
                }
                $categoryProducts = $categoryProducts->get();
                return view("front.products.listing", compact('categoryDetails', 'categoryProducts'));
            } else {
                $url = Route::getFacadeRoot()->current()->uri();
                $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
                if ($categoryCount > 0) {

                    $categoryDetails = Category::categoryDetails($url);
                    $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

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

                    $categoryProducts = $categoryProducts->paginate(30);
                    // dd($categoryDetails);
                    $meta_title = $categoryDetails['categoryDetails']['meta_title'];
                    $meta_keywords = $categoryDetails['categoryDetails']['meta_keywords'];
                    $meta_description = $categoryDetails['categoryDetails']['meta_description'];
                    return view('front.products.listing', compact('categoryDetails', 'categoryProducts', 'url', 'meta_title', 'meta_keywords', 'meta_description'));
                } else {
                    abort(404);
                }
            }
        }
    }

    public function details($id)
    {
        $productDetails = Product::with(['section', 'category', 'brand', 'vendor', 'attributes' => function ($query) {
            $query->where("stock", ">", 0)->where("status", 1);
        }, 'images'])->find($id)->toArray();
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);

        // dd($productDetails);
        // Get Similar Products
        $similarProduct = Product::with('brand')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(4)->inRandomOrder()->get()->toArray();

        // Set Session for Recently Viewed Products
        if (empty(Session::get('session_id'))) {
            $session_id = md5(uniqid(rand(), true));
        } else {
            $session_id = Session::get('session_id');
        }

        Session::put('session_id', $session_id);

        // Insert product in table if not already exists
        $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where(['product_id' => $id, 'session_id' => $session_id])->count();

        if ($countRecentlyViewedProducts == 0) {
            DB::table('recently_viewed_products')->insert(['product_id' => $id, 'session_id' => $session_id]);
        }

        // Get Recently Viewed Products Ids
        $recentlyProductsIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->get()->take(4)->pluck('product_id');

        // Get Recently Viewed Products
        $recentlyProducts = Product::with('brand')->whereIn('id', $recentlyProductsIds)->get()->toArray();

        // Get Group Products (Product color)
        $groupProducts = array();
        if (!empty($productDetails['group_code'])) {
            $groupProducts = Product::select('id', 'product_image')->where('id', '!=', $id)->where(['group_code' => $productDetails['group_code'], 'status' => 1])->get()->toArray();
        }

        // dd($groupProducts);

        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');
        // dd($recentlyProducts);
        $meta_title = $productDetails['meta_title'];
        $meta_description = $productDetails['meta_description'];
        $meta_keywords = $productDetails['meta_keywords'];
        return view('front.products.detail', compact('productDetails', 'categoryDetails', 'totalStock', 'similarProduct', 'recentlyProducts', 'groupProducts', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'], $data['size']);

            return $getDiscountAttributePrice;
        }
    }


    public function vendorListing($vendorid)
    {
        // Get Vendor Shop Name
        $getVendorShop = Vendor::getVendorShop($vendorid);
        // Get Vendor Products
        // $vendorProducts = Product::with('brand')->where('vendor_id',$vendorid)->where('status',1);
        // $vendorProducts->paginate(30);
        $vendorProducts = Product::with('brand')->where('vendor_id', $vendorid)->where('status', 1)->paginate(30);
        // dd($vendorProducts);
        return view('front.products.vendor_listing', compact('getVendorShop', 'vendorProducts'));
    }

    public function cartAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Forget the coupon sessions
            Session::forget('couponAmount');
            Session::forget('couponCode');
            if ($data['quantity'] <= 0) {
                $data['quantity'] = 1;
            }
            // echo "<pre>"; print_r($data);die; 
            $getProductStock = ProductsAttribute::getProductStock($data['product_id'], $data['size']);

            if ($getProductStock < $data['quantity']) {
                return redirect()->back()->with('error_message', 'Required Quantity is not available');
            }

            // Generate Session id if not exists
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            // Check Product if already exists in the user cart
            if (Auth::check()) {
                // User is logged in
                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => $user_id])->count();
            } else {
                $user_id = 0;
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => $session_id])->count();
            }

            if ($countProducts > 0) {
                return redirect()->back()->with('error_message', 'Product already exists in the cart');
            }

            // Save products in cart table
            $item = new Cart;
            $item->session_id = $session_id;
            $item->user_id = $user_id;
            $item->product_id = $data['product_id'];
            $item->size = $data['size'];
            $item->quantity = $data['quantity'];
            $item->save();
            return redirect()->back()->with('success_message', 'Product Added To The Cart.<a href="/cart" class="text-decoration:underline !important">View Cart</a>');
        }
    }

    public function cart()
    {
        $getCartItems = Cart::getCartItems();
        // dd($getCartItems);
        $meta_title = "Shopping-cart Multi Commerce";
        $meta_keywords = 'shopping cart, Multi Commerce';
        return view('front.products.cart', compact('getCartItems', 'meta_title', 'meta_keywords'));
    }

    public function cartUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Forget the coupon sessions
            Session::forget('couponAmount');
            Session::forget('couponCode');
            // Get Cart Details
            $cartDetails = Cart::find($data['cartid']);
            // Get Available Product stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first()->toArray();

            // echo "<pre>";print_r($availableStock);die;

            // Check if desired stock from user is available
            if ($data['qty'] > $availableStock['stock']) {
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product stock is not available',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')), 'headerview' => (string)View::make('front.layouts.header_cart_item')->with(compact('getCartItems'))
                ]);
            }

            // Check if product size is available
            $availableSize = ProductsAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size'], 'status' => 1])->count();
            if ($availableSize == 0) {
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product size is not available',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')), 'headerview' => (string)View::make('front.layouts.header_cart_item')->with(compact('getCartItems'))
                ]);
            }

            // Cart qty field update
            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            Session::forget('couponAmount');
            Session::forget('couponCode');
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status' => true, 'totalCartItems' => $totalCartItems, 'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')), 'headerview' => (string)View::make('front.layouts.header_cart_item')->with(compact('getCartItems'))
            ]);
        }
    }

    public function cartDelete(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Forget the coupon sessions
            Session::forget('couponAmount');
            Session::forget('couponCode');
            // echo "<pre>";print_r($data);die;
            Cart::where('id', $data['cartid'])->delete();
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'headerview' => (string)View::make('front.layouts.header_cart_item')->with(compact('getCartItems'))
            ]);
        }
    }

    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Session::forget('couponAmount');
            Session::forget('couponCode');
            $getCartItems = Cart::getCartItems();
            // echo "<pre>";print_r($getCartItems);die;
            $totalCartItems = totalCartItems();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                return response()->json([
                    'status' => false,
                    'totalCartItems' => $totalCartItems,
                    'message' => 'The Coupon Is Not Valid',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'headerview' => (string)View::make('front.layouts.header_cart_item')->with(compact('getCartItems'))
                ]);
            } else {
                // Others Coupon Condition
                // Get Coupon Details
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                // If Coupon is active
                if ($couponDetails->status == 0) {
                    $message = "Coupon is not active";
                }

                // Check Coupon Date is Expired or not
                $expiry_data = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');

                if ($expiry_data < $current_date) {
                    $message = "This coupon is expired";
                }

                // Check if coupon is for single time
                if ($couponDetails->coupon_type == 'Single Time') {
                    // Check in order table if coupon already availed by user
                    $couponCount = Order::where(['coupon_code' => $data['code'], 'user_id' => Auth::user()->id])->count();

                    if ($couponCount >= 1) {
                        $message = "This coupon is already availed by the user";
                    }
                }

                // Check if coupon is from selected categories

                // Get all selected categories from coupon
                $catArr = explode(',', $couponDetails->categories);

                // Check if any cart item not belongs to coupon category
                $total_amount = 0;
                foreach ($getCartItems as $key => $item) {
                    if (!in_array($item['product']['category_id'], $catArr)) {
                        $message = "This coupon code is not for selected products!";
                    }
                    $attrPrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                    // echo "<pre>";print_r($attrPrice);die;
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }

                // Check if coupon is from selected users

                // Get all selected users from coupon and convert to array
                if (isset($couponDetails->users) && !empty($couponDetails->users)) {
                    $usersArr = explode(',', $couponDetails->users);

                    // Get user ids of all selected users
                    if (count($usersArr)) {
                        foreach ($usersArr as $key => $user) {
                            $getUserId = User::select('id')->where('email', $user)->first()->toArray();
                            $usersId[] = $getUserId['id'];
                        }

                        // Check if any cart item not belongs to coupon user
                        foreach ($getCartItems as $item) {

                            if (!in_array($item['user_id'], $usersId)) {
                                $message = "This coupon is not for you!";
                            }
                        }
                    }
                }

                if ($couponDetails->vendor_id > 0) {
                    $productIds = Product::select('id')->where('vendor_id', $couponDetails->vendor_id)->pluck('id')->toArray();
                    // echo "<pre>";print_r($productIds);die;
                    // Check if coupon belongs to vendor product
                    foreach ($getCartItems as $item) {
                        if (!in_array($item['product']['id'], $productIds)) {
                            $message = "This product code is not for you.Try again with valid coupon code(vendor validation)!";
                        }
                    }
                }


                // If error message is there
                if (isset($message)) {
                    return response()->json([
                        'status' => false,
                        'totalCartItems' => $totalCartItems,
                        'message' => $message,
                        'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                        'headerview' => (string)View::make('front.layouts.header_cart_item')->with(compact('getCartItems'))
                    ]);
                } else {
                    // Coupon code is corrent
                    // Check if coupon amount is fixed or percentage
                    if ($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }

                    $grand_total = $total_amount - $couponAmount;

                    // Add coupon code & amount in session variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Coupon code successfully applied. You are availing discount!";
                    return response()->json([
                        'status' => false,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount' => $couponAmount,
                        'grand_total' => $grand_total,
                        'message' => $message,
                        'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                        'headerview' => (string)View::make('front.layouts.header_cart_item')->with(compact('getCartItems'))
                    ]);
                }
            }
        }
    }

    public function checkout(Request $request)
    {
        $countries = Country::where('status', 1)->get()->toArray();
        $getCartItems = Cart::getCartItems();
        // dd($getCartItems);
        if (count($getCartItems) == 0) {
            $message = "Shopping Cart is empty! Please add products to checkout!";
            return redirect('cart')->with('error_message', $message);
        }
        $total_price = 0;
        $total_weight = 0;
        foreach ($getCartItems as $item) {
            // echo "<pre>";print_r($item);die;
            $attrPrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
            $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);
            $product_weight = $item['product']['product_weight'];
            $total_weight = $total_weight + $product_weight;
        }
        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        foreach ($deliveryAddresses as $key => $value) {
            $shippingCharges = ShippingCharge::getShippingCharges($total_weight, $value['country']);
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;
            // COD pincode is available or not
            $deliveryAddresses[$key]['codpincodeCount'] = DB::table('cod_pincodes')->where('pincode', $value['pincode'])->count();
            // Prepaid pincode is available or not
            $deliveryAddresses[$key]['prepaidpincodeCount'] = DB::table('prepaid_pincodes')->where('pincode', $value['pincode'])->count();
        }
        // dd($deliveryAddresses);

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            // Website security
            foreach ($getCartItems as $item) {
                // Prevent disabled products to order
                $product_status = Product::getProductStatus($item['product_id']);
                if ($product_status == 0) {
                    // Product::deleteCartProduct($item['product_id']);
                    // $message = "One of the product is disabled! Please try again";
                    $message = $item['product']['product_name'] . " with " . $item['size'] . " Size is not available.Please remove from cart and choose some other product.";
                    return redirect('/cart')->with('error_message', $message);
                }

                // Prevent sold out products to order
                $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['size']);
                if ($getProductStock == 0) {
                    // Product::deleteCartProduct($item['product_id']);
                    // $message = "One of the product is sold out! Please try again";
                    $message = $item['product']['product_name'] . " with " . $item['size'] . " Size is not available.Please remove from cart and choose some other product.";
                    return redirect('/cart')->with('error_message', $message);
                }
                // Prevent disabled product attribute to order
                $getAttributeStatus = ProductsAttribute::getAttibuteStatus($item['product_id'], $item['size']);
                if ($getAttributeStatus == 0) {
                    // Product::deleteCartProduct($item['product_id']);
                    // $message = "One of the product attribute is disabled! Please try again";
                    $message = $item['product']['product_name'] . " with " . $item['size'] . " Size is not available.Please remove from cart and choose some other product.";
                    return redirect('/cart')->with('error_message', $message);
                }

                // Prevent disabled categorys products to order
                $getCategoryStatus = Category::getCategoryStatus($item['product']['category_id']);
                if ($getCategoryStatus == 0) {
                    // Product::deleteCartProduct($item['product_id']);
                    // $message = "One of the product is disabled!Please try another one.";
                    $message = $item['product']['product_name'] . " with " . $item['size'] . " Size is not available.Please remove from cart and choose some other product.";
                    return redirect('/cart')->with('error_message', $message);
                }
            }

            // Select Delivery Address
            if (empty($data['address_id'])) {
                $message = 'Please Select Delivery Address!';
                return redirect()->back()->with('error_message', $message);
            }

            // Select Payment Method
            if (empty($data['payment_gateway'])) {
                $message = 'Please Select Payment GateWay!';
                return redirect()->back()->with('error_message', $message);
            }

            // Terms & Conditions
            if (empty($data['accept'])) {
                $message = 'Please Agree With Terms & Conditions';
                return redirect()->back()->with('error_message', $message);
            }
            // dd($data);
            // Get Delivery Address from address_id
            $deliveryAddress = DeliveryAddress::where('id', $data['address_id'])->first()->toArray();
            // dd($deliveryAddress);

            // Set payment method as COD if COD is selected from user otherwise set as prepaid

            if ($data['payment_gateway'] == 'COD') {
                $payment_method = 'COD';
                $order_status = "New";
            } else {
                $payment_method = 'Prepaid';
                $order_status = "Pending";
            }

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
            $shipping_charges = ShippingCharge::getShippingCharges($total_weight, $deliveryAddress['country']);

            // Grand Total
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');

            // Insert grand total in session variable
            Session::put('grand_total', $grand_total);

            // Insert order details
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city = $deliveryAddress['city'];
            $order->state = $deliveryAddress['state'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = $shipping_charges;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = $order_status;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();
            foreach ($getCartItems as $item) {
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'vendor_id')->where('id', $item['product_id'])->first()->toArray();
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);

                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;
                $cartItem->admin_id = $getProductDetails['admin_id'];
                $cartItem->vendor_id = $getProductDetails['vendor_id'];
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $cartItem->product_size = $item['size'];
                $cartItem->product_price = $getDiscountAttributePrice['final_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();

                // Reduce stock starts here
                $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['size']);
                $newStock = $getProductStock - $item['quantity'];

                ProductsAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']])->update(['stock' => $newStock]);
            }
            // Insert Order Id in session variable
            Session::put('order_id', $order_id);
            DB::commit();

            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();

            if ($data['payment_gateway'] == "COD") {
                // Send Order Email
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails,
                ];
                Mail::send('emails.order', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Placed - icode.in');
                });

                // Send Order SMS
            } else if ($data['payment_gateway'] == 'Paypal') {
                // paypal redirect user to paypal page after saving order
                return redirect('/paypal');
            } else {
                echo "Prepaid payment method coming soon!";
            }
            return redirect('thanks');
        }

        // echo $total_price; die;
        return view('front.products.checkout', compact('deliveryAddresses', 'countries', 'getCartItems', 'total_price'));
    }

    public function thanks()
    {
        if (Session::has('order_id')) {
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('front.products.thanks');
        } else {
            return redirect('cart');
        }
    }

    public function checkPincode(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // cod pincode is available or not
            $codPincodeCount = DB::table('cod_pincodes')->where('pincode', $data['pincode'])->count();
            // prepaid pincode is available or not
            $prepaidPincodeCount = DB::table('prepaid_pincodes')->where('pincode', $data['pincode'])->count();

            if ($codPincodeCount == 0 && $prepaidPincodeCount == 0) {
                echo "This pincode is not available for delivery";
            } else {
                echo "This pincode is available for delivery";
            }
        }
    }
}
