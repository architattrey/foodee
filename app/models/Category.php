<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'categories',
        'image',
        'cat_logo',
        'price_org',
        'price_fake',
        'discription',
        'ratings',
        'delete_status',
    ];
}
