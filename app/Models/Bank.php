<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = "banks";

    protected $fillable = [
        'name',
        'address',
        'description',
        'user_id',
        ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }



}
