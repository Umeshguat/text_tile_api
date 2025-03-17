<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    public $timestamps = false;

    protected $table = "fs_menu";

    protected $fillable = [

      'user_id', 'product_code', 'menu_category_id', 'menu_sub_category_id', 'menu_retailer_id', 'menu_type', 'menu_name', 'brand_origin', 'content', 'description', 'image', 'status', 'is_approve', 'country_id', 'is_in_stock', 'quantity', 'tax_amount', 'keyword', 'notification', 'created_date', 'updated_date', 'lang'
    ];


    public function category(){

        return $this->hasOne(Category::class, 'id','menu_category_id');
    }


    public function brands(){

        return $this->hasOne(Category::class, 'id','brand_origin');
    }
}
