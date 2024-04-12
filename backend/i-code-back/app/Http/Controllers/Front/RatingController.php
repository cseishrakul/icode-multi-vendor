<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Auth;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        if (!Auth::check()) {
            $message = "Login to rate this product";
            return redirect()->back()->with('error_message', $message);
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $user_id = Auth::user()->id;
            $ratingCount = Rating::where(['user_id' => $user_id, 'product_id' => $data['product_id']])->count();
            if ($ratingCount > 0) {
                $message = "Your rating already exists for this product";
                return redirect()->back()->with('error_message', $message);
            } else {
                if (empty($data['rating'])) {
                    $message = "Please add rating for your product";
                    return redirect()->back()->with("error_message", $message);
                } else {
                    // echo "Add rating";
                    $rating = new Rating;
                    $rating->user_id = $user_id;
                    $rating->product_id = $data['product_id'];
                    $rating->review = $data['review'];
                    $rating->rating = $data['rating'];
                    $rating->status = 0;
                    $rating->save();
                    $message = "Thanks for rating this product! It will be shown once approved.";
                    return redirect()->back()->with('success_message',$message);
                }
            }
        }
    }
}
