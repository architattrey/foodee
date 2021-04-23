<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    protected $table = 'days';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'days',
        'created_at',
        'updated_at',
    ];
}
