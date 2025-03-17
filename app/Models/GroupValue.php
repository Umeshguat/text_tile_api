<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupValue extends Model
{
    //

    public $timestamps = false;

    protected $table = "tbl_value_name";

    protected $fillable = [
        'group_name', 'filter_value', 'icon_value', 'icon_image', 'approved_status', 'status', 'created_date', 'updated_date'
    ];
}
