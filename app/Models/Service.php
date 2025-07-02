<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    function department()
    {
        return $this->belongsTo(Department::class);
    }
}
