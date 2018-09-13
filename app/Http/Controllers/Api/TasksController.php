<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TaskService;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;

class TasksController extends Controller
{
    public function __construct(TaskService $task_service)
    {
        $this->service = $task_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $filters = json_decode($request->filters);
        $tasks = $this->service->paginated($filters);
        return TaskResource::collection($tasks);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $tasks = $this->service->search($request->search);
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {
        $data = $request->except('_token');
        if(trim($request->input('assigned_to')) == '') {
          $data['assigned_to'] = auth()->user()->id;
        }
        $result = $this->service->create($data);

        if ($result) {
            if($data['assigned_to'] != auth()->user()->id) {
              // Send NOtification
              \Notifications::notify($data['assigned_to'], 'success', auth()->user()->name  . ' have assigned you a task #' . $result->id, 'tasks');
            }  
            $task = new TaskResource($this->service->find($result->id));
            return response()->json($task);
        }

        return response()->json(['error' => 'Unable to create task'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->service->find($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {        
        $result = $this->service->update($id, $request->except(['index']));

        if ($result) {
            $task = new TaskResource($this->service->find($id));
            return response()->json($task);
        }

        return response()->json(['error' => 'Unable to update task'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return response()->json(['success' => 'Task was deleted'], 200);
        }

        return response()->json(['error' => 'Unable to delete task'], 500);
    }
}
