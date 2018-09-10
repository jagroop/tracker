<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public $table = "issues";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
  		'id',
  		'project_id',
  		'assigned_by',
  		'assigned_to',
  		'issue_name',
  		'issue_desc',
  		'issue_status',
  		'started_date',
  		'closed_date',
  		'created_at',
  		'updated_at'
    ];

    public static $rules = [
       'project_id' => 'required|exists:projects,id',
       'issue_name' => 'required',
       'issue_desc' => 'required',
       // 'assigned_to' => 'required|exists:users,id',
       'issue_status' => 'required',
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
