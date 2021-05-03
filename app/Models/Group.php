<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'active'];
    protected $hidden = ['system_name', 'remember_token'];
}
