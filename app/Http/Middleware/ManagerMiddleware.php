<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Task;
use Tymon\JWTAuth\Exceptions\JWTException;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        }

        if ($user->state === 'manager') {
            $taskId = $request->route('task');
            if ($taskId) {
                $task = Task::find($taskId);
                if (!$task || $task->owner_id !== $user->id) {
                    return response()->json(['error' => 'Unauthorized to update/delete this task'], 403);
                }
            }
        } elseif ($user->state !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
