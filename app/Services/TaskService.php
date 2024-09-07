<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TaskResource;
use App\Http\Traits\ApiResponseTrait;

class TaskService
{

    use ApiResponseTrait;

    public function getAllTask()
    {
        $tasks = Task::all();

        return TaskResource::collection($tasks);
    }


    public function create_task(array $data)
    {
        $task = Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority'],
            'due_date' => $data['due_date'],
            'status' => $data['status'],
            'assigned_to' => $data['assigned_to'],
            'deadline' => $data['deadline'],
        ]);
        return $task;
    }

    public function update_task(Task $task, array $data)
    {
        try {
            // dd($task);

            if (!$task->exists) {
                return $this->notFound('Task not found.');
            }
            //   Update only the fields that are provided in the data array
            $task->update(array_filter([
                'title' => $data['title'] ?? $task->title,
                'description' => $data['description'] ?? $task->description,
                'priority' => $data['priority'] ?? $task->priority,
                'due_date' => $data['due_date'] ?? $task->due_date,
                'status' => $data['status'] ?? $task->status,
                'assigned_to' => $data['assigned_to'] ?? $task->assigned_to,
                'deadline' => $data['deadline'] ?? $task->deadline,
            ]));

            // Return the updated task as a resource
            // return TaskResource::make($task)->toArray(request());
            return $task;
        } catch (\Exception $e) {
            Log::error('Error in TaskService@update' . $e->getMessage());
            return $this->errorResponse('An error occurred: ' . 'there is an error in the server', [], 500);
        }
    }
}
