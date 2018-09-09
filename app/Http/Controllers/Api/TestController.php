<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;

class TestController extends Controller
{
    public function tasks()
    {
        $user = User::find(1);
        dd($user->todayTasks()->count());
    }
}
