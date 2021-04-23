<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
       
        'subcat_id',
        'days',
        'products',
        'delete_status',
        'created_at',
        'updated_at',
    ]; 
    
    #feedbacks 
    public function getUsersFeedbacks()
    {
        return $this->hasOne('App\models\UsersFeedbacks','product_id','id');
    }
    #products of subcat
    public function subCatProducts()
    {
        return $this->belongsTo('App\models\SubCategory','subcat_id');
    }  

}
