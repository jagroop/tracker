<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\Issue;

class UpdateProtalData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pms:update_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Task::whereIn('task_status', ['on_hold', 'pending', 'in_progress'])->update(['created_at' => now()->toDateTimeString()]);
        Issue::whereIn('issue_status', ['on_hold', 'pending', 'in_progress'])->update(['created_at' => now()->toDateTimeString()]);
    }
}
