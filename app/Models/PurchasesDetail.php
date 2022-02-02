<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_details';

    protected $with = ['puchases'];

    protected $fillable = [
        'product_id',
        'purchases_id',
        'number',
    ];

    public $timestamps = false;

    public function puchases(){
        return $this->belongsTo(Product::class);
    }

    public function product(){
        return $this->hasOne(Product::class, 'id','product_id');
    }

}
