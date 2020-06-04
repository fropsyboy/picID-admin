<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Image extends Model
{
    //
    protected $fillable = [
        'title', 'path', 'user_id', 'body', 'type'
    ];



}
