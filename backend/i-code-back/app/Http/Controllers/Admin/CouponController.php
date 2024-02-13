<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class CouponController extends Controller
{
    public function coupons()
    {
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        if($adminType == "vendor"){
            $vendorStatus = Auth::guard('admin')->user()->status;
            if($vendorStatus == 0){
                return redirect("admin/update-vendor-details/personal")->with('error_message','You vendor account is not approved yet.Please make sure to fill your valid personal,business and bank details');
            }
            $coupons = Coupon::where('vendor_id',$vendor_id)->get()->toArray();
        }else{
            $coupons = Coupon::get()->toArray();
        }
        
        // dd($coupons);
        return view('admin.coupons.coupons', compact('coupons'));
    }

    public function updateCouponStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'coupon_id' => $data['coupon_id']]);
        }
    }


    public function deleteCoupon($id)
    {
        Coupon::where('id', $id)->delete();
        $message = "Coupon has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditCoupon(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Coupon";
            $coupon = new Coupon;
            $selCats = array();
            $selBrands = array();
            $selUsers = array();
            $message = "Coupon Added Successfully!";
        } else {
            $title = "Edit Coupon";
            $coupon = Coupon::find($id);
            $selCats = explode(',',$coupon['categories']);
            $selBrands = explode(',',$coupon['brands']);
            $selUsers = explode(',',$coupon['users']);
            $message = "Coupon Updated Successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'categories' => 'required',
                'brands' => 'required',
                'coupon_option' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required|numeric',
                'expiry_date' => 'required',
            ];

            $customMessages = [
                'categories.required' => 'Select Category',
                'brands.required' => 'Select Brand',
                'coupon_option.required' => 'Select Coupon Option',
                'coupon_type.required' => 'Select Coupon Type',
                'amount_type.required' => 'Select Amount Type',
                'amount.required' => 'Amount Is Required',
                'amount.numeric' => 'Amount Must Be Numeric',
                'expiry_date.required' => 'Expiry Date Is Required',
            ];

            $this->validate($request, $rules, $customMessages);

            if (isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            } else {
                $categories = "";
            }
            if (isset($data['brands'])) {
                $brands = implode(',', $data['brands']);
            } else {
                $brands = "";
            }
            if (isset($data['users'])) {
                $users = implode(',', $data['users']);
            } else {
                $users = "";
            }
            if ($data['coupon_option'] == "Automatic") {
                $coupon_code = str_random(8);
            } else {
                $coupon_code = $data['coupon_code'];
            }
            //  echo "<pre>"; print_r($data);die;

            $adminType = Auth::guard('admin')->user()->type;
            if ($adminType == 'vendor') {
                $coupon->vendor_id = Auth::guard('admin')->user()->vendor_id;
            } else {
                $coupon->vendor_id = 0;
            }

            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->brands = $brands;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->save();
            return redirect('admin/coupons')->with('success_message', $message);
        }

        $categories = Section::with('categories')->get()->toArray();
        $brands = Brand::where('status', 1)->get()->toArray();
        $users = User::select('email')->where('status', 1)->get();
        return view('admin.coupons.add-edit-coupon', compact('title', 'coupon', 'categories', 'brands', 'users','selCats','selBrands','selUsers'));
    }
}
