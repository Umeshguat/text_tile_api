<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login(Request $request){

        try {

            $email = $request->email;
            $password = $request->password;

            $user = User::where('email', $email)->first();

            if ($user->password  == md5($password)) {

                $data['user_id'] = $user['id'];
                $data['first_name'] = $user['first_name'];
                $data['last_name'] = $user['last_name'];
                $data['email'] = $user['email'];
                $data['token'] = $user->createToken('API TOKEN')->plainTextToken;

                $user->otp = 1234;
                $user->save();

                return response([
                    'status' => 201,
                    'message' => 'Welcome',
                    "data" => $data
                ], 200);
            } else {

                return response([
                    'status' => 202,
                    'message' => 'Password wrong'
                ], 200);
            }

            return response([
                'status' => 203,
                'message' => 'Otp send Successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function register(Request $request){

        try {

            $validator = Validator::make($request->all(),[
                'email' => 'required|unique:fs_users,email',
                'mobile_number' => 'required|unique:fs_users,mobile_number'
            ]);

            if ($validator->fails()) {

                return response([
                    'status'=>401,
                    'message'=>$validator->errors()->first()
                ],401);
            }

            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->firm_name = '';
            $user->otp = 1234;
            $user->role_id = 5;
            $user->profile_image = '';
            $user->manufacturer_category = '';
            $user->type = 0;
            $user->address = '';
            $user->street = '';
            $user->address_country = 0;
            $user->pincode = 0;
            $user->latitude = 0;
            $user->city = 0;
            $user->longitude = 0;
            $user->website = '';
            $user->contact_person = '';
            $user->phone = '';
            $user->referal_code = '';
            $user->total_loyalty_point = 0;
            $user->commission_rate = 0;
            $user->country_id  = '';
            $user->created_date = now();
            $user->last_login = now();
            $user->added_by  = 0;
            $user->wallet_total_amount = 0;
            $user->wallet_used_amount = 0;
            $user->lang = '';
            $user->is_retailer_approved = '';
            $user->mobile_number = $request->mobile_number;
            $user->password = $request->password;
            $user->user_type = '4';
            $user->gstno = $request->gstno;
            $user->panno = $request->panno;
            $user->save();



            return response([
                'status' => 200,
                'message' => 'Otp Send Successfully',
            //    'data'=>$data
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function verifyOtp(Request $request){

        try {


            $user = User::where('mobile_number', $request->mobile)->first();

            if ($user->otp  == $request->otp) {
                $data['user_id'] = $user['id'];
                $data['first_name'] = $user['first_name'];
                $data['last_name'] = $user['last_name'];
                $data['email'] = $user['email'];
                $data['token'] = $user->createToken('API TOKEN')->plainTextToken;


                return response([
                    'status'=>200,
                    'message'=>'OTP Verified Successfully !',
                    'data'=>$data
                ],200);
            }

            return response([
                'status'=>201,
                'message'=>'Invalid OTP !'
            ],200);


        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function getUserDetail(Request $request){

        try {

            $user = User::find($request->id);

            return response([
                'status'=>200,
                'message'=>'User details',
                'data'=>$user
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }


    public function updateUserDetail(Request $request){

        try {

            $auth = Auth::user()->id;

            $user =  User::find($auth);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->manufacturer_category = $request->manufacturer_category;
            $user->brand = $request->brand;
            $user->country_id  = $request->country_id;
            $user->state_id  = $request->state_id;
            $user->city = $request->city_id;
            $user->street = $request->street;
            $user->pincode =  $request->pincode;
            $user->firm_name = $request->firm_name;
            $user->mobile_number = $request->mobile_number;
            $user->profile_image = $request->profile_image;
            $user->commission_rate = $request->commission_rate;
            $user->gstno = $request->gstno;
            $user->panno = $request->panno;
            $user->type = 0;
            $user->pannoimage = $request->pan_image;
            $user->gstnofiles = $request->gst_image;
            $user->payment_term = $request->payment_term;
            $user->address_country = 0;
            $user->save();

            return response([
                'status' => 200,
                'message' => 'User Detail succeefully!',
            //    'data'=>$data
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }
}
