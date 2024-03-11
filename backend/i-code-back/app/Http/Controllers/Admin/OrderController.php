<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItemStatus;
use App\Models\OrdersLog;
use App\Models\OrdersProduct;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Dompdf\Dompdf;

class OrderController extends Controller
{
    public function orders()
    {
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        if ($adminType == 'vendor') {
            $vendorStatus = Auth::guard('admin')->user()->status;
            if ($vendorStatus == 0) {
                return redirect('admin/update-vendor-details/personal')->with('error_message', 'Your Vendor Account is not approved yet. Please make sure to fill your valid personal, business and bank details');
            }
        }
        if ($adminType == 'vendor') {
            $orders = Order::with(['orders_products' => function ($query) use ($vendor_id) {
                $query->where('vendor_id', $vendor_id);
            }])->orderBy('id', 'desc')->get()->toArray();
        } else {
            $orders = Order::with('orders_products')->orderBy('id', 'desc')->get()->toArray();
        }
        // dd($orders);
        return view('admin.orders.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        if ($adminType == 'vendor') {
            $vendorStatus = Auth::guard('admin')->user()->status;
            if ($vendorStatus == 0) {
                return redirect('admin/update-vendor-details/personal')->with('error_message', 'Your Vendor Account is not approved yet. Please make sure to fill your valid personal, business and bank details');
            }
        }
        if ($adminType == 'vendor') {
            $orderDetails = Order::with(['orders_products' => function ($query) use ($vendor_id) {
                $query->where('vendor_id', $vendor_id);
            }])->where('id', $id)->first()->toArray();
        } else {
            $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();
        }



        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $orderStatus = OrderStatus::where('status', 1)->get()->toArray();
        $orderItemStatus = OrderItemStatus::where('status', 1)->get()->toArray();
        $orderLog = OrdersLog::with('orders_products')->where('order_id', $id)->orderBy('id', 'desc')->get()->toArray();

        // dd($orderLog);

        return view('admin.orders.order_details', compact('orderDetails', 'userDetails', 'orderStatus', 'orderItemStatus', 'orderLog'));
    }

    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);

            // Update courier name and tracking number
            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                Order::where('id', $data['order_id'])->update(['courier_name' => $data['courier_name'], 'tracking_number' => $data['tracking_number']]);
            }

            // Update Orders Log
            $log = new OrdersLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();

            // Get delivery details
            $deliveryDetails = Order::select('mobile', 'email', 'name')->where('id', $data['order_id'])->first()->toArray();

            // Get Order details
            $orderDetails = Order::with('orders_products')->where('id', $data['order_id'])->first()->toArray();

            // Send Order Status Update Email
            $email = $deliveryDetails['email'];
            $messageData = [
                'email' => $email,
                'name' => $deliveryDetails['name'],
                'order_id' => $data['order_id'],
                'orderDetails' => $orderDetails,
                'order_status' => $data['order_status'],
            ];
            Mail::send('emails.order_status', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Order Status Update - iCode.com');
            });


            $message = "Order status has been updated successfully!";
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function updateOrderItemStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            OrdersProduct::where('id', $data['order_item_id'])->update(['item_status' => $data['order_item_status']]);

            // Update courier name and tracking number
            if (!empty($data['item_courier_name']) && !empty($data['item_tracking_number'])) {
                OrdersProduct::where('id', $data['order_item_id'])->update(['courier_name' => $data['item_courier_name'], 'tracking_number' => $data['item_tracking_number']]);
            }

            $getOrderId = OrdersProduct::select('order_id')->where('id', $data['order_item_id'])->first()->toArray();

            $log = new OrdersLog;
            $log->order_id = $getOrderId['order_id'];
            $log->order_item_id = $data['order_item_id'];
            $log->order_status = $data['order_item_status'];
            $log->save();

            // Get delivery details
            $deliveryDetails = Order::select('mobile', 'email', 'name')->where('id', $getOrderId['order_id'])->first()->toArray();

            // Get Order details
            $orderDetails = Order::with('orders_products')->where('id', $getOrderId['order_id'])->first()->toArray();

            // Send Order Status Update Email
            $email = $deliveryDetails['email'];
            $messageData = [
                'email' => $email,
                'name' => $deliveryDetails['name'],
                'order_id' => $getOrderId['order_id'],
                'orderDetails' => $orderDetails,
                'order_status' => $data['order_item_status'],
            ];
            Mail::send('emails.order_status', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Order Item Status Update - iCode.com');
            });


            $message = "Item status has been updated successfully!";
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function orderInvoice($order_id)
    {
        $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
        // $user_id = $orderDetails['user_id'];
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        // dd($userDetails);
        return view('admin.orders.order_invoice', compact('orderDetails', 'userDetails'));
    }

    public function viewPdfInvoice($order_id)
    {
        $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
        // $user_id = $orderDetails['user_id'];
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        // dd($userDetails);
        // instantiate and use the dompdf class
        $invoiceHTML = view('pdf.invoice',compact('orderDetails','userDetails'));
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($invoiceHTML);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
