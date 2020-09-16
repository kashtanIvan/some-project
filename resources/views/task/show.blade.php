<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
    </x-slot>
    <div class="flash-message">
        @if(Session::has('alert-success'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 mb-1.5" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{ Session::get('alert-success') }}</p>
            </div>
        @endif
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                    @csrf
                    @method('put')
                    <label for="name" class=" @error('name') text-red-600 @enderror">Task name</label>
                    <input type="text" value="{{ $task->name }}" name="name" class="border-2 @error('name') border-red-600 @enderror" id="name">
                    @error('name')
                    <small class="text-red-500">
                        {{ $errors->first('name') }}
                    </small>
                    @enderror
                    <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" value="Save">

                </form>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3>Files</h3>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form enctype="multipart/form-data" action="{{ route('upload.file') }}" method="post">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <label for="file" class=" @error('file') text-red-600 @enderror">Upload file</label>
                    <input type="file" value="" name="file" class="border-2 @error('file') border-red-600 @enderror" id="file">
                    @error('file')
                        <small class="text-red-500">
                            {{ $errors->first('file') }}
                        </small>
                    @enderror
                    <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" value="Upload">

                </form>
                @if ($task->files->isNotEmpty())
                    <table class="table-fixed">
                        <thead>
                        <tr>
                            <th class="w-1/2 px-4 py-2">Name</th>
                            <th class="w-1/4 px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($task->files as $key => $file)
                            <tr {{ $key % 2 ? '' : 'class="bg-gray-100"' }}>
                                <td class="border px-4 py-2">{{ $file->name }}</td>
                                <td class="border px-4 py-2">
                                    <form method="POST" action="{{ route('delete.file', $file->id) }}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="bg-red-300 float-right font-bold hover:bg-red-400 inline-flex items-center px-4 py-2 rounded text-gray-800" value="Delete">
                                    </form>
                                    <a target="_blank" href="/download/{{$file->token}}" class="bg-green-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                        <span>Download</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div>You don't have any files!</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
