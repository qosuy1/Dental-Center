<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    function doctors()
    {
        return $this->hasMany(Doctor::class);
    }


    function services()
    {
        return $this->hasMany(Service::class);
    }

}
