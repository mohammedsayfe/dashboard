<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = "accounts";

    protected $fillable = [
        'account_number',
        'member_id',
        'bank_id',
        'balance',
        'statement',
        'branch',
        ];


    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id','id');
    }

    public function banks()
    {
        return $this->belongsTo(Bank::class, 'bank_id','id');
    }



}
