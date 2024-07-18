<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

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
}
