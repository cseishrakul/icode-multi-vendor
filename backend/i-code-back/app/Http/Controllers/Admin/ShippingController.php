<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function shippingCharges()
    {
        $shippingCharges = ShippingCharge::get()->toArray();
        // dd($shippingCharges);
        return view('admin.shipping.shipping_charges', compact('shippingCharges'));
    }

    public function updateShippingStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ShippingCharge::where('id', $data['shipping_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'shipping_id' => $data['shipping_id']]);
        }
    }
}
