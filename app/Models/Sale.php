<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'member_id',
        'user_id',
        'account_id',
        'statement',
        'is_payed'
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
        return $this->hasMany(SaleDetail::class);
    }

    public function total(){
        return $this->details->map(function ($detail){
            return $detail->product->price_sale * $detail->number;
        })->sum();
    }
}
