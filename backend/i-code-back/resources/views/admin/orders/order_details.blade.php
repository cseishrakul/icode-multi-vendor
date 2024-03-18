<?php
use App\Models\Product;
use App\Models\OrdersLog;
use App\Models\Vendor;
use App\Models\Coupon;
// if (Auth::guard('admin')->user()->type == 'vendor') {
//     $getVendorCommission = Vendor::getVendorCommission(Auth::guard('admin')->user()->vendor_id);
// }
?>
@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0 mx-auto">
                            <div class="row">
                                <div class="col-md-7">
                                    <h3 class="font-weight-bold text-right">Order Details</h3>
                                </div>
                                <div class="col-md-5">
                                    <a href="{{ url('admin/orders') }}" class="text-center">(Back to Orders)</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="font-weight: bold">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Order Details</h4>
                            <hr>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Order ID:</b></label></div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> #{{ $orderDetails['id'] }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="exampleInputUsername1"><b>Order Date:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for="">
                                            {{ date('Y-m-d h:i:s', strtotime($orderDetails['created_at'])) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Order Status:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['order_status'] }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Order Total:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['grand_total'] }} Tk.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-6"><label for="exampleInputUsername1"><b>Shipping
                                                Charges:</b></label></div>
                                    <div class="col-md-6 text-right">
                                        <label for=""> {{ $orderDetails['shipping_charges'] }} Tk.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($orderDetails['coupon_code']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-6"> <label for="exampleInputUsername1"><b>Coupon
                                                    Code:</b></label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <label for=""> {{ $orderDetails['coupon_code'] }} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-6"><label for="exampleInputUsername1"><b>Coupon
                                                    Amount:</b></label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <label for=""> {{ $orderDetails['coupon_amount'] }} Tk.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-6"><label for="exampleInputUsername1"><b>Payment Method:</b></label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <label for=""> {{ $orderDetails['payment_method'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputUsername1"><b>Payment Gateway:</b></label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <label for=""> {{ $orderDetails['payment_gateway'] }} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Customer Details</h4>
                            <hr>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Name:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $userDetails['name'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Mobile:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $userDetails['mobile'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Email:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $userDetails['email'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($userDetails['address']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Address:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['address'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['city']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>City:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['city'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['state']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>State:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['state'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['country']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Country:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['country'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['pincode']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Pincode:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['pincode'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Delivery Address</h4>
                            <hr>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Name:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['name'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Mobile:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['mobile'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($orderDetails['address']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Address:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['address'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['city']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>City:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['city'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['state']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>State:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['state'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['country']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Country:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['country'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['pincode']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Pincode:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['pincode'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Update Order Status</h4>
                            <hr>
                            @if (Auth::guard('admin')->user()->type != 'vendor')
                                <form action="{{ url('admin/update-order-status') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                                    <select name="order_status" id="order_status" class="form-control my-2">
                                        <option value="">Select</option>
                                        @foreach ($orderStatus as $status)
                                            <option value="{{ $status['name'] }}"
                                                @if (!empty($orderDetails['order_status']) && $orderDetails['order_status'] == $status['name']) selected="" @endif>{{ $status['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="courier_name" id="courier_name"
                                        class="form-control my-2" placeholder="Courier Name">
                                    <input type="text" name="tracking_number" id="tracking_number"
                                        class="form-control my-2" placeholder="Tracking Number">
                                    <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
                                </form>
                                <br>
                                @foreach ($orderLog as $key => $log)
                                    <strong> {{ $log['order_status'] }} </strong><br>
                                    @if ($log['order_status'] == 'Shipped')
                                        @if (isset($log['order_item_id']) && $log['order_item_id'] > 0)
                                            @php
                                                $getItemDetails = OrdersLog::getItemDetails($log['order_item_id']);
                                            @endphp
                                            -- For item {{ $getItemDetails['product_code'] }}
                                            <br>
                                            @if (!empty($getItemDetails['courier_name']))
                                                <br> <span>Courier Name:
                                                    {{ $getItemDetails['courier_name'] }} </span>
                                            @endif
                                            @if (!empty($getItemDetails['tracking_number']))
                                                <br> <span>Tracking Number:
                                                    {{ $getItemDetails['tracking_number'] }} </span>
                                                <br>
                                            @endif
                                        @endif
                                    @endif

                                    {{ date('Y-m-d h:i:s', strtotime($log['created_at'])) }}
                                    <hr>
                                @endforeach
                            @else
                                <div class="text-center pt-5 mt-5">
                                    <alert class="alert alert-danger">This Feature Is Restricted!</alert>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-borderless text-center" id="order_info">
                        <tr class="bg-dark text-light">
                            <th>Image</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Unit Price</th>
                            <th>P.Qty</th>
                            <th>P.Price</th>
                            @if (Auth::guard('admin')->user()->type != 'vendor')
                                <th>Product By</th>
                            @endif
                            <th>Commission</th>
                            <th>Final Amount</th>
                            <th>Item Status</th>
                        </tr>
                        @foreach ($orderDetails['orders_products'] as $product)
                            <tr>
                                <td>
                                    @php
                                        $getProductImage = Product::getProductImage($product['product_id']);
                                    @endphp
                                    <a href="{{ url('product/' . $product['product_id']) }}" target="_blank"
                                        class="">
                                        <img style="width: 50px;height:50px"
                                            src="{{ asset('admin/photos/product_images/small/' . $getProductImage) }}"
                                            alt="">
                                    </a>
                                </td>
                                <td> {{ $product['product_code'] }} </td>
                                <td> {{ $product['product_name'] }} </td>
                                <td> {{ $product['product_size'] }} </td>
                                <td> {{ $product['product_color'] }} </td>
                                <td> {{ $product['product_price'] }} </td>
                                <td> {{ $product['product_qty'] }} </td>
                                <td>
                                    @if ($product['vendor_id'] > 0)
                                        @if ($orderDetails['coupon_amount'] > 0)
                                            @php
                                                $couponDetails = Coupon::couponDetails($orderDetails['coupon_code']);
                                            @endphp
                                            @if ($couponDetails['vendor_id'] > 0)
                                                {{ $total_price = $product['product_price'] * $product['product_qty'] - $item_discount }}
                                            @else
                                                {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                            @endif
                                        @else
                                            {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                        @endif
                                    @else
                                        {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                    @endif
                                </td>

                                @if (Auth::guard('admin')->user()->type != 'vendor')
                                    @if ($product['vendor_id'] > 0)
                                        <td>
                                            <a href="/admin/view-vendor-details/{{ $product['admin_id'] }}"
                                                target="_blank">Vendor</a>
                                        </td>
                                    @else
                                        <td>
                                            Admin
                                        </td>
                                    @endif
                                @endif

                                @if ($product['vendor_id'] > 0)
                                    @php
                                        $getVendorCommission = Vendor::getVendorCommission($product['vendor_id']);
                                    @endphp
                                    <td>
                                        {{ $commission = round(($total_price * $getVendorCommission) / 100, 2) }} Tk
                                    </td>
                                    <td>
                                        {{ $total_price - $commission }} Tk.
                                    </td>
                                @endif

                                <td>
                                    <form action="{{ url('admin/update-order-item-status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_item_id" value="{{ $product['id'] }}">
                                        <select name="order_item_status" id="order_item_status" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($orderItemStatus as $status)
                                                <option value="{{ $status['name'] }}"
                                                    @if (!empty($product['item_status']) && $product['item_status'] == $status['name']) selected="" @endif>
                                                    {{ $status['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="item_courier_name" id="item_courier_name"
                                            class="form-control my-2" placeholder="Courier Name"
                                            @if (!empty($product['courier_name'])) value={{ $product['courier_name'] }} @endif>
                                        <input type="text" name="item_tracking_number" id="item_tracking_number"
                                            class="form-control my-2" placeholder="Tracking Number"
                                            @if (!empty($product['tracking_number'])) value={{ $product['tracking_number'] }} @endif>
                                        <button type="submit" class="btn btn-outline-primary mt-3">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- partial -->

        @include('admin.layout.footer')
    </div>
@endsection
