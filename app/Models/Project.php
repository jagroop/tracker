<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = "projects";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
      'id',
  		'user_id',
  		'name',
  		'status',
  		'started_date',
  		'closed_date',
  		'created_at',
  		'updated_at'
    ];

    public static $rules = [
        'name' => 'required|unique:projects',
        'status' => 'required',
    ];

    // Project 
}
