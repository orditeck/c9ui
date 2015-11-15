<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public static $validator = [
        'home_path'     => 'required|max:255',
        'nodejs_path'   => 'required|max:255',
        'c9_path'       => 'required|max:255',
        'default_args'  => 'max:255',
    ];
}