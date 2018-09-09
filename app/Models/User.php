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
        'name' => 'required',
        'role' => 'required',
        'email' => 'required|email|unique:users',
    ];

    public function todayTasks()
    {
      return $this->hasMany(Task::class, 'assigned_to', 'id')->whereDate('created_at', now()->toDateString());
    }

    public function todayIssues()
    {
      return $this->hasMany(Issue::class, 'assigned_to', 'id')->whereDate('created_at', now()->toDateString());
    }
}
