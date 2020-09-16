<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @SWG\Get(
     *     path="/api/file/{token}",
     *     description="Get file",
     *     operationId="api.file.show",
     *     tags={"Files"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         description="Authorization token format (Bearer {apikey})",
     *         required=true,
     *         in="header",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="token",
     *         description="Token",
     *         required=true,
     *         in="path",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="User logout"
     *     ),
     * )
     */
    public function show($token)
    {
        return new FileResource($this->fileService->getFile($token));
    }
}
