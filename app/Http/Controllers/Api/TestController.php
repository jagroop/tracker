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
      // \Notifications::notify(1, 'success', 'Hi this is a test', 'foo');
      //Mail::to('jagroop.singh@kindlebit.com')->send(new StatusReminderEmail);
    }
}
