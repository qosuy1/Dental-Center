<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";
    // protected $guarded = [] ;

    protected $fillable = [
        // 'site_name',
        'email',
        'number',
        'facebook',
        'instagram',
        'linkedin',
        'about_us_image',
        'our_story',
        'google_map_location',
    ];
}
