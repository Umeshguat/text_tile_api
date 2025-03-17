<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //

    public $timestamps = false;

    protected $table = "fs_brand";

    protected $fillable = [
        'name', 'status', 'show_on_home', 'icon_image',
    ];
}
