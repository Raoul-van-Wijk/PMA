<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viewing assignment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if (auth()->user()->hasRole(['teacher', 'admin', 'root']))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('registerAssignment') }}">Create assignment</a>
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Teacher:  {{ $assignment->teacher->name }}</p>
                    <p>Title:  {{ $assignment->title }}</p>
                    <p>Content:  {{ $assignment->content }}</p>
                </div>
            </div>
        </div>
        @if(auth()->user()->hasRole(['admin', 'root']) || auth()->user()->id = $assignment->teacher_id)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('overview', $class_id ?? 8) }}">View students progression</a><br>
                    <a href="{{ route('editAssignment', $assignment->assignment_id) }}">Edit assignment</a>
                    <br>
                    <form action="{{ route('deleteAssignment', $assignment->assignment_id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete assignment</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @if(auth()->user()->hasRole(['student']))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('createProgression', $assignment->assignment_id) }}">{{ $progression }}</a>
                </div>
            </div>
        </div>
        @endif
</x-app-layout>
