<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use App\Mail\StatusReminderEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ProjectResource;

class TestController extends Controller
{
    public function tasks()
    {
      $task = Project::find(57);
      $tasks = $task->workHours(true);
      // return $tasks;
      dd($tasks);
    }
}
