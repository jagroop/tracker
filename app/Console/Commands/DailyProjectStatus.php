<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Mail\DailyStatus;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;

class DailyProjectStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pms:status_update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily status update command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $now = now()->toDateTimeString();
        // $past10Hours = now()->subHours(10)->toDateTimeString();  
        // TaskResource::withoutWrapping();      
        // $todayTasks = Task::whereBetween('created_at', [$past10Hours, $now])->get();
        // if(count($todayTasks) > 0) {
        //   $collection  = collect(TaskResource::collection($todayTasks))->groupBy('project_name')->toArray();
        //   $data = [];
        //   foreach ($collection as $projectName => $tasks) {
        //     $groupedTasks = collect($tasks)->groupBy('assigned_to')->toArray();
        //     foreach ($groupedTasks as $assignedTo => $groupedTask) {
        //       $data[$projectName][$assignedTo] = $groupedTask;
        //     }
        //   }
        //   Mail::to('ram.sharma@kindlebit.com')->cc('jagroop.singh@kindlebit.com')->send(new DailyStatus($data));
        // }
    }
}
