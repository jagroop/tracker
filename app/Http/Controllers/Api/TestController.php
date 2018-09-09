<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TestController extends Controller
{
    public function tasks()
    {
        $knownDate = Carbon::create(2018, 9, 10, 17);
        Carbon::setTestNow($knownDate);

        $test = !now()->isWeekend();
        dd($test);
    }
}
