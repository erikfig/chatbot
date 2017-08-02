<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuButton extends Model
{
    public $timestamps = false;
    public $fillable = ['type', 'title', 'value', 'parent_id', 'menu_id'];
}
