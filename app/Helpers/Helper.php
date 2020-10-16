<?php

namespace App\Http\Helpers;

class Helper
{
    public static function toUpperCase($keyWord){
        return mb_strtoupper($keyWord);
    }
}
