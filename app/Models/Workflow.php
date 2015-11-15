<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    public static $validator = [
        'name'  => 'required|max:255',
        'path'  => 'required|max:255',
        'args'  => 'max:255',
    ];

    public function getStartedAttribute()
    {
        if($this->pid){
            return true;
        }

        return false;
    }
}