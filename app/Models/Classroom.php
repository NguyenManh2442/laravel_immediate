<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    protected $table = 'classrooms';

    protected $fillable = [
        'name',
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function getAllClassroom(){
        return DB::table('classrooms')->get();
    }
}
