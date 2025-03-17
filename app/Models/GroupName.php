<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupName extends Model
{
    //


    public $timestamps = false;

    protected $table = "tbl_group_name";

    protected $fillable = [
         'group_name', 'add_more', 'show_on', 'status', 'position', 'required', 'created_date', 'updated_date'
    ];
}
