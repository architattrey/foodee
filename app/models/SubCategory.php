<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_category';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'cat_id',
        'sub_cat_name',
        // 'mrp',
        // 'foodee_price',
        'description',
        'image',
        'delete_status',
        'created_at',
        'updated_at'
    ];
    public function getCat()
    {
        return $this->belongsTo('App\models\Category','cat_id');
    }
    #get cart sub category
    public function getCart()
    {
        return $this->hasMany('App\models\Cart','subcat_id','id');
    }
    #get getPlan
    public function getPlan()
    {
        return $this->hasMany('App\models\Plan','subcat_id','id');
    }
}
