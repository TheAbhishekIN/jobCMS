<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    protected $fillable = [
        'street_address', 'city', 'state','country','zip'
    ];
}
