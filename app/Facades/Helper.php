<?php

namespace App\Facades;

class Helper
{
    public function toUpperCase($keyWord)
    {
        return mb_strtoupper($keyWord);
    }
}
