<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPdfFileRequest;
use App\Services\FileService;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    /**
     * @var FileService
     */
    private $uploadFileService;

    /**
     * FileController constructor.
     * @param FileService $uploadFileService
     */
    public function __construct(FileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

    /**
     * @param UploadPdfFileRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function upload(UploadPdfFileRequest $request)
    {
        $this->uploadFileService->upload($request);
        Session::flash('alert-success', 'File uploaded');
        return redirect(route('tasks.show', $request->post('task_id')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->uploadFileService->delete($id);
        Session::flash('alert-success', 'File deleted');
        return back();
    }

    /**
     * @param $token
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($token)
    {
        $file = $this->uploadFileService->download($token);
        return response()->download($file->path, $file->name);
    }
}
