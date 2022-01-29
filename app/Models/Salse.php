<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salse extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $fillable = [
        'product_id',
        'member_id',
        'statement',
        'number',
        'user_id',
        'account_id',

    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id','id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }


}
