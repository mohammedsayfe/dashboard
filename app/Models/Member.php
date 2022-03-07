<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;
    use Notifiable;


    protected $guard = 'member';

    protected $table = "members";

    protected $fillable = [
        'name',
        'email',
        'id_number',
        'number_of_shares',
        'phone',
        'password',
    ];

    protected $hidden = [
        'remember_token',
    ];
}
