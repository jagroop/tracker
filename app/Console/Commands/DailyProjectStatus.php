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
        $cc = ['jagroop.singh@kindlebit.com'];
        $now = now()->toDateTimeString();
        $past10Hours = now()->subHours(10)->toDateTimeString();  
        TaskResource::withoutWrapping();      
        $todayTasks = Task::whereBetween('created_at', [$past10Hours, $now])->get();
        $tasks  = collect(TaskResource::collection($todayTasks))->sortBy('project_name');
        $cc = array_unique(array_merge($cc, $tasks->pluck('assigned_to_email')->all()));
        if(count($todayTasks) > 0) {
          Mail::to('ram.sharma@kindlebit.com')->cc($cc)->send(new DailyStatus($tasks));
        }
    }
}
