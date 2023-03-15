<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'fullname',
        'address',
        'phoneno',
        'date_of_appoint',
        'session',
        'no_of_participantss',
        'name_of_institution'

    ];
    protected $table = 'conference';
        use HasFactory;
}
