<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'subcat_id',
        'plans',
        'mrp',
        'foodee_price',
        'discount',
        'discount_unit',
        'delete_status',
        'created_at',
        'updated_at',
    ];
    # get ubcat
    public function getSubCat()
    {
        return $this->belongsTo('App\models\SubCategory','subcat_id');
    }
}
