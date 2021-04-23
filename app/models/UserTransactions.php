<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserTransactions extends Model
{
    protected $table = 'user_transactions';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'invoice_id',
        'amount',
        'amount_to_be_paid',
        'status',
        'promo_code',
        'dlvry_address',
        'dlvry_status',
        'expire_date',
        'plan_type',
        'created_at',
        'updated_at',
    ];
    #products
    public function TransactionProducts(){
        return $this->belongsTo('App\models\Products', 'product_id', 'id');
    }
     
    
}
