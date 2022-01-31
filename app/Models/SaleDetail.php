<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'sale_details';

    protected $with = ['product'];

    protected $fillable = [
        'sale_id',
        'product_id',
        'number',
    ];

    public $timestamps = false;

    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function product(){
        return $this->hasOne(Product::class, 'id','product_id');
    }

}
