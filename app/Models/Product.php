<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'price_buy',
        'price_sale',
        'description',
        'product_image',
        'user_id',
        'expired_date',
        'quantity',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

}
