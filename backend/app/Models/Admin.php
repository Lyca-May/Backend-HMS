<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
        protected $fillable = ['id', 'username', 'password'];
        protected $table = 'adminside';
        use HasFactory;
}
