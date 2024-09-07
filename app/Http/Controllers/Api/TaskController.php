<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    use ApiResponseTrait;


    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $tasks=$this->taskService->getAllTask();
     return $this->successResponse('this is all tasks', $tasks, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validationdata = $request->validated();
        $task=$this->taskService->create_task($validationdata);
        return $this->successResponse('successefuly added the task', $task, 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {


        $validatedRequest = $request->validated();
        $newTask = $this->taskService->update_task($task, $validatedRequest);
        return $this->successResponse($newTask, 'Book updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
