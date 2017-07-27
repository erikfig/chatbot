<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestions extends Model
{
    protected $fillable = ['user_face_id', 'suggestion', 'readed'];
}
