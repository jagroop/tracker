<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $table = "tasks";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
  		'id',
  		'project_id',
  		'assigned_by',
  		'assigned_to',
  		'task_name',
  		'task_desc',
  		'task_status',
  		'started_date',
  		'closed_date',
  		'created_at',
  		'updated_at',
    ];

    public static $rules = [
       'project_id' => 'required|exists:projects,id',
       'task_name' => 'required',
       'task_desc' => 'required',
       // 'assigned_to' => 'required|exists:users,id',
       'task_status' => 'required',
    ];

    
	public function project() {
		return $this->hasOne(Project::class, 'id', 'project_id');
	}

  public function assignedBy() {
    return $this->hasOne(User::class, 'id', 'assigned_by');
  }

  public function assignedTo() {
    return $this->hasOne(User::class, 'id', 'assigned_to');
  }
	
}
