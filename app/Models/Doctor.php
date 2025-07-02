<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory ;

    function blogs()
    {
        return $this->hasMany(Blog::class);
    }


    function department()
    {
        return $this->belongsTo(Department::class);
    }

    function specailCases()
    {
        return $this->hasMany(SpecialCase::class);
    }

    public function getFirstTenWordsFromTheExpe()
    {
        $array = explode(" ", $this->experince);

        if (count($array) <= 10) {
            return $this->experince;
        }

        $tenWords = "";
        for ($i = 0; $i < 10; $i++) {
            $tenWords .= $array[$i] . " ";
        }
        $tenWords .= "....";

        return $tenWords;
    }
}
