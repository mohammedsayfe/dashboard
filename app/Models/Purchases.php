<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    protected $fillable = [

        'user_id',

        'statement',
    ];

    protected $with = ['member','user','details'];

    public function member(){
        return $this->belongsTo(Member::class, 'member_id')->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function details(){
        return $this->hasMany(PurchasesDetail::class,'purchase_id');
    }

    public function total(){
        return $this->details->map(function ($detail){
            return $detail->product->price_sale * $detail->number;
        })->sum();
    }
}
