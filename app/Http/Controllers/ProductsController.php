<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductVarient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //

    public function imageupload($image){

        $filename = uniqid() . '_' . $image->getClientOriginalName();
        $destinationPath = 'uploads/menu_image/';
        $image->move($destinationPath, $filename);
        return $filename;

    }

    public function getAllProduct(Request $request){

        try {

            $product = Products::select('id', 'user_id', 'menu_name', 'image', 'menu_category_id', 'brand_origin')
                        ->where('user_id', $request->user_id)->get();

            foreach ($product as $key => $item) {
                $item->brand = optional($item->brands)->name;
            }


            $product->makeHidden('brands');
            return response([
                'status' => 203,
                'message' => 'All Brands ',
                'data'=> $product
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }


    public function addProduct(Request $request){

        try {


            $validator = Validator::make($request->all(),[
                'menu_name' => 'required|unique:fs_menu,menu_name',
                'product_code' => 'required|unique:fs_menu,product_code',
                'varient_images' => 'mimes:png,jpg,jpeg,webp',
                'image' => 'required|mimes:png,jpg,jpeg,webp',
            ]);

            if ($validator->fails()) {
                return response([
                    'status' => 400,
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            $product = new Products();
            $product->user_id = $request->user_id;
            $product->product_code = $request->product_code;
            $product->menu_category_id = $request->menu_category_id;
            $product->menu_sub_category_id = $request->menu_sub_category_id;
            $product->menu_retailer_id = $request->menu_retailer_id;
            $product->menu_type = $request->menu_type;
            $product->menu_name = $request->menu_name;
            $product->brand_origin = $request->brand_origin;
            $product->content = $request->content;
            $product->description = $request->description;
            $product->image = $this->imageupload($request->image) ?? 'null';
            $product->image = 'null';
            $product->status = 'active';
            $product->is_approve = 'pending';
            $product->country_id = $request->country_id ?? 7;
            $product->is_in_stock = $request->isin_stock;
            $product->quantity = $request->quantity;
            $product->tax_amount = $request->tax_amount;
            $product->keyword = $request->keyword;
            $product->notification = '0';
            $product->created_date = now();
            $product->updated_date = now();
            $product->lang = $request->lang ?? null;
            $product->save();


            if ($product) {

                foreach ($request->varient as $key => $value) {

                        $varient = new ProductVarient();
                        $varient->menu_id = $product->id ?? 22;
                        $varient->menu_varient_name = $value['menu_varient_name'];
                        $varient->unit_id = $value['unit_id'];
                        $varient->unit_value = $value['unit_value'];
                        $varient->square_per_meter = $value['mrp'];
                        $varient->discounts_val = $value['discounts_val'];
                        $varient->price = $value['price'];
                        $varient->price_for_retailer = $value['price'];
                        $varient->status = $value['status'];
                        $varient->is_in_stock = $value['is_in_stock'];
                        $varient->quantity = $value['quantity'];
                        $varient->position = $value['position'];
                        $varient->created_date = now();
                        $varient->updated_date =  now();
                        $varient->lang = $request->lang;
                        $varient->variant_filters = $value['variant_filters'];
                        $varient->size = 0;
                        $varient->color = 0;
                        $varient->product_details = 0;
                        $varient->specifications = 'null';
                        $varient->description = $value['descriptions'];
                        $varient->varient_image = $this->imageupload($request->varient_images[$key]) ?? 'null';
                        $varient->save();
                }
            }

            return response([
                'status' => 200,
                'message' =>'Product added successfully!',
                'data'=> $product->id
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

















}
