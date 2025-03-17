<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Cities;
use App\Models\GroupName;
use App\Models\GroupValue;
use App\Models\ManufactureeCategory;
use App\Models\ProductType;
use App\Models\States;
use App\Models\Units;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class CommonController extends Controller
{
    //
    public function getAllBrand(Request $request){

        try {
            $brand = Brand::where('status','active')->get();

            return response([
                'status' => 203,
                'message' => 'All Brands ',
                'data'=> $brand
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }


    public function getAllCategory(Request $request){

        try {
            $brand = Category::select('id','name','group_name')->where('status','active')->get();

            foreach ($brand as $key => $value) {
                 $groupIds = explode(',', $value->group_name);

                 $value->group_names = GroupName::whereIn('id', $groupIds)->select('id','group_name')->get();
            }

            return response([
                'status' => 203,
                'message' => 'All Catgory',
                'data'=> $brand
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function getAllGroupValue(Request $request){

        try {

            $brand = GroupValue::where('group_name', $request->id)->where('approved_status','approve')->where('status','1')
                    ->select('id', 'filter_value')->get();

            return response([
                'status' => 203,
                'message' => 'All Group value',
                'data'=> $brand
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function getAllProductType(Request $request){

        try {
            $brand = ProductType::where('status','1')->get();

            return response([
                'status' => 203,
                'message' => 'All Brands ',
                'data'=> $brand
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function getAllUnit(Request $request){

        try {
            $brand = Units::where('status','active')->get();

            return response([
                'status' => 203,
                'message' => 'All Brands ',
                'data'=> $brand
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function getSupplierCatgory(Request $request){

        try {

            $data = ManufactureeCategory::where('status', 'active')->get();
            return response([
                'status' => 203,
                'message' => 'get all manufacture category',
                'data'=> $data
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }

    }

    public function getAllCities(Request $request){

        try {

            $data = Cities::where('state_id', $request->id)->get();

            return response([
                'status' => 203,
                'message' => 'get all Cities',
                'data'=> $data
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function getAllStates(Request $request){

        try {

            $data = States::get();

            return response([
                'status' => 203,
                'message' => 'get all Cities',
                'data'=> $data
            ], 200);

        } catch (\Throwable $th) {
            return response([
                'status' => 401,
                'message' => $th->getMessage()
            ], 401);
        }
    }


}
