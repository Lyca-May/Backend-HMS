<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'fullname',
        'address',
        'phoneno',
        'date_of_visit',
        'session',
        'no_of_visitors',
        'name_of_institution',
        'status',
        'reason',

    ];
    protected $table = 'visits';
        use HasFactory;
}
