<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reguser extends Model
{
    use HasFactory;
    protected $table = 'regusers';

    protected $fillable = [
        'id',
        'username',
        'email',
        'user_type',
        'password',
    ];
}
