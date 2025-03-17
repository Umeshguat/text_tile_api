<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //


    public $timestamps = false;

    protected $table = "fs_menu_category";

    protected $fillable = [
        'parent', 'name', 'image', 'banner_image', 'url', 'status', 'group_name', 'created_date', 'updated_date', 'lang', 'is_selected_for_banner'
    ];
}
