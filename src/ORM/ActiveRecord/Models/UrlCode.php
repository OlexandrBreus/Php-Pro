<?php

namespace Slim\PhpPro\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;

class UrlCode extends Model
{
    protected $table = "urlcodes";
    protected $fillable = [
        "id",
        "url",
        "code"
    ];
    public $timestamps = false;

}

