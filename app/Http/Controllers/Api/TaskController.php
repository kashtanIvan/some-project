<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;

class TaskController extends ApiController
{
    /**
     * @var TaskService
     */
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @SWG\Get(
     *     path="/api/tasks",
     *     description="Get all Tasks",
     *     operationId="api.tasks.all",
     *     consumes={"multipart/form-data"},
     *     tags={"Task"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         description="Authorization token format (Bearer {apikey})",
     *         required=true,
     *         in="header",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="User logout"
     *     ),
     * )
     */
    public function index()
    {
        return TaskResource::collection($this->taskService->getTasks());
    }


    /**
     *
     * @SWG\Post(
     *     path="/api/task",
     *     description="Create new task",
     *     operationId="api.task.store",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     tags={"Task"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         description="Authorization token format (Bearer {apikey})",
     *         required=true,
     *         in="header",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         description="Create Task",
     *         required=true,
     *         in="body",
     *         @SWG\Schema(
     *             @SWG\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Task created"
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Token has expired"
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="The given data was invalid"
     *     )
     * )
     */
    public function store(StoreTaskRequest $request)
    {
        return new TaskResource($this->taskService->createTask($request));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Delete(
     *      path="/api/task/{id}",
     *      tags={"Task"},
     *      operationId="api.task.delete",
     *      summary="Delete Task",
     *     @SWG\Parameter(
     *         name="Authorization",
     *         description="Authorization token format (Bearer {apikey})",
     *         required=true,
     *         in="header",
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          type="string"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     */
    public function destroy($id)
    {
        return response()->json(['success' => $this->taskService->deleteTask($id)]);
    }
}
