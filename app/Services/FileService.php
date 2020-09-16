<?php

namespace App\Services;

use App\Http\Requests\UploadPdfFileRequest;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    /**
     * @var File
     */
    private $fileModel;

    /**
     * FileService constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->fileModel = $file;
    }

    /**
     * @param UploadPdfFileRequest $request
     * @return File
     */
    public function upload(UploadPdfFileRequest $request): File
    {
        $token = Str::uuid();
        Storage::disk('files')->putFileAs('', $request->file, $token);
        return $this->fileModel->create([
            'name' => $request->file->getClientOriginalName(),
            'token' => $token,
            'task_id' => $request->post('task_id')
        ]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $file = $this->fileModel->findOrFail($id);
        Storage::disk('files')->delete($file->token);
        $file->delete();
    }

    /**
     * @param $token
     * @return File
     */
    public function getFile($token): File
    {
        return $this->fileModel->whereToken($token)->firstOrFail();
    }
}
