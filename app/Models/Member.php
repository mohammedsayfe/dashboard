<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use HasFactory;
    use Notifiable;


    // protected $guard = 'members';

    protected $table = "members";

    protected $fillable = [
        'name',
        'email',
        'id_number',
        'number_of_shares',
        'phone',
    ];

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
