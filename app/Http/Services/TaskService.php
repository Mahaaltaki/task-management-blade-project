<?php
namespace App\Http\Services;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Mail\SendEmailNotification;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskService
{ 
    /*
     * @param Request $request 
     * @return array containing paginated task resources.
     */
    public function getAllTasks()
    {
        // query builder instance for the task model
        $tasks = Task::all();
        return $tasks;
    }

    /**
     * Store a new task.
     * @param array $data array containing 'title','description','status',
      *  'due_date'
     * @return array array containing the created task resource.
     * @throws \Exception
     * Throws an exception if the task creation fails */
    public function storeTask($request)
    {
        $task = new Task();
        $task->fill($request->all()); // استخدام البيانات من الطلب مباشرةً
        $task->save();
        return TaskResource::make($task)->toArray(request());
        //dd($task); 
    }
    



    /*Retrieve a specific task by its ID.
     * @param int $id of the task.
     * @return array containing the task resource.
     * @throws \Exception exception if the task is not found.*/
    public function showtask(int $id): array
    {
        // Find task by ID
        $task = Task::find($id);
        

        // Return the found task
        return TaskResource::make($task)->toArray(request());

    }

    /**
     * Update an task.
     * @param Task $task
     * update The task model.
     * @param array $data array containing the fields to update ('title','description','status',
      *  'due_date').
     * @return array containing the updated task resource.
     */
    public function updateTask(Request $request, int $id)
    {
      // العثور على المهمة بواسطة ID
    $task = Task::findOrFail($id);

    // التحقق مما إذا كان المستخدم الحالي هو صاحب المهمة
    if ($task->user_id !== Auth::id()) {
        return redirect()->route('tasks.index')->with('error', 'لا يمكنك تعديل هذه المهمة.');
    }

    // update the status only
    $validated = $request->only('status');

    // update the task if it was 'status'
    $task->update($validated);

    return redirect()->route('tasks.index')->with('success', 'تم تحديث حالة المهمة بنجاح');
}
     
    /**
     * Delete task by ID.
     * @param int $id of task to delete.
     * @return void
     * @throws \Exception an exception if the task is not found.
     */
    public function deletetask(int $id): void
    {
        // Find the task by ID
        $task = Task::find($id);

        // If no task is found, throw an exception
        if (!$task) {
            throw new \Exception('task not found.');
        }

        // Delete task
        $task->delete();
    }
     
}
