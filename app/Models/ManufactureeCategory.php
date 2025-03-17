<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufactureeCategory extends Model
{
    //

    public $timestamps = false;

    protected $table = "fs_manufacturer_category";

    protected $fillable = [
       'name', 'status', 'created_date', 'updated_date', 'lang'
    ];
}
