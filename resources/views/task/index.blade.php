<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Session::has('alert-success'))
                <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p>{{ Session::get('alert-success') }}</p>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Task
                </a>
                @if ($tasks->isNotEmpty())
                    <table class="table-fixed">
                        <thead>
                        <tr>
                            <th class="w-1/2 px-4 py-2">Title</th>
                            <th class="w-1/4 px-4 py-2">Author</th>
                            <th class="w-1/4 px-4 py-2">Views</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($tasks as $key => $task)
                            <tr {{ $key % 2 ? '' : 'class="bg-gray-100"' }}>
                                <td class="border px-4 py-2"><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                                <td class="border px-4 py-2">{{ $task->created_at->format('Y-m-d') }}</td>
                                <td class="border px-4 py-2">
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div>You don't have any tasks!</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
