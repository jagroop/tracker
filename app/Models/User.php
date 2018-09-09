<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = "users";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
  		'id',
  		'name',
  		'role',
  		'email',
  		'password',
  		'remember_token',
  		'created_at',
  		'updated_at',
    ];

    public static $rules = [
        // create rules
    ];

    // User 
}
