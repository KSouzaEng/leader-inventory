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
        'quantity_product_order',
        'total_order',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
