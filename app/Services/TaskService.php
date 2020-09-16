<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TaskService
{
    /**
     * @var Task
     */
    private $taskModel;

    /**
     * TaskService constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->taskModel = $task;
    }

    /**
     * @param $id
     * @return Task
     */
    public function getTask($id): Task
    {
        return $this->taskModel->findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->taskModel->with('files')->get();
    }

    /**
     * @param Request $request
     * @return Task
     */
    public function createTask(Request $request): Task
    {
        $task = $this->taskModel->create(['name' => $request->post('name')]);
        return $task;
    }

    /**
     * @param $id
     * @param $name
     * @return Task
     */
    public function updateTask($id, $name): Task
    {
        $task = $this->taskModel->findOrFail($id);
        $task->update(['name' => $name]);
        return $task;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTask($id)
    {
        return $this->taskModel->findOrFail($id)->delete();
    }
}
