<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialCase extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialCaseFactory> */
    use HasFactory;

    function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}
