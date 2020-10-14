<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Model
{
    Use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'mail_address',
        'name',
        'password',
        'address',
        'phone',
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
