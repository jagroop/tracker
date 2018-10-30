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
        $now = now()->toDateTimeString();
        $past10Hours = now()->subHours(15)->toDateTimeString();
        TaskResource::withoutWrapping();      
        $todayTasks = Task::whereBetween('created_at', [$past10Hours, $now])->get();
        $tasks  = collect(TaskResource::collection($todayTasks))->sortBy('project_name');
        echo $now;
        die($past10Hours);
        return $tasks;
        dd($tasks);
        die;
        $now = now()->toDateTimeString();
        $past10Hours = now()->subHours(10)->toDateTimeString();  
        TaskResource::withoutWrapping();      
        
        $todayTasks = Task::whereBetween('created_at', [$past10Hours, $now])->where(function($query){
          return $query->where('task_status', 'done')->where('completion_precentage', '!=', 100);
        })->orWhere(function($query){
          return $query->where('task_status', 'in_progress')->where('work_hours', 0);
        })->get();

        $tasks  = collect(TaskResource::collection($todayTasks))->sortBy('project_name');
        dd($tasks);
        $cc = array_unique($tasks->pluck('assigned_to_email')->all());
        if(count($todayTasks) > 0) {
          Mail::to('jagroop.singh@kindlebit.com')->cc($cc)->send(new DailyStatus($tasks, $projectsStats));
        }
    }
}
