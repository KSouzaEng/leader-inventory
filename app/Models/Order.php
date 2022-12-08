<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Order extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'product_id',
        'order_code',
        'quantity_product_order',
        'total_order',
        'status',

    ];

    public function products()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }

}