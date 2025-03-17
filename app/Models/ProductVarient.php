<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVarient extends Model
{
    //

    public $timestamps = false;

    protected $table = "fs_menu_varient";

    protected $fillable = [
        'title', 'gst', 'status', 'created_date', 'updated_date'
    ];
}
