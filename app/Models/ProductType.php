<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    public $timestamps = false;

    protected $table = "tbl_product_type";

    protected $fillable = [
        'title', 'gst', 'status', 'created_date', 'updated_date'
    ];
}
