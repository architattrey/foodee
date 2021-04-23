<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'subcat_id',
        'user_id',
        'plan_id',
        'meal_type',
        'amount',
        'expire_date',
        'created_at',
        'updated_at'
    ];
    #get sub cat
    public function subCat()
    {
        return $this->belongsTo('App\models\SubCategory','subcat_id');
    }  
    #plan
    public function plan()
    {
        return $this->belongsTo('App\models\Plan','plan_id');
    }  
}
