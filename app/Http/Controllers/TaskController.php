<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TaskRequest;
use App\Http\Services\TaskService;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller

{
    protected $taskService;
    public function __construct(taskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
            $tasks = $this->taskService->getAllTasks();
            return view('tasks.index', compact('tasks'));
            //var_dump($tasks);
    }
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $users=User::all();
        return view('tasks.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        //dd($request->all());
             $task = $this->taskService->storeTask($request);
            // //var_dump($task);
            return redirect()->route('tasks.index')->with('success', 'The task stored successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
            $task = $this->taskService->showTask($id);
            return view('tasks.show', compact('task'));
        
    }
     /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request,string $id)
    {
        
            $task = Task::findOrFail($id);
            $validated = $request->validated();
            $updatedTask = $this->taskService->updateTask($request,  $id);
            return redirect()->route('tasks.index')->with('success', 'The task updated successfully');
       
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
            $this->taskService->deleteTask($id);
            return redirect()->route('tasks.index')->with('success', 'The task deleted successfully');
        
    }

      /**
     * Handle exceptions and redirect with error message.
     */
    protected function handleException(\Exception $e, string $message)
    {
        // Log the error with additional context if needed
        Log::error($message, ['exception' => $e->getMessage(), 'request' => request()->all()]);

        return redirect()->route('tasks.index')->with('error', $message);
    }
}



