
    @foreach ($assignments as $assignment)
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
        {{ $assignment->title }}
        <a href="{{ route('viewSingleAssignment', $assignment->assignment_id) }}"> -> Go to assignment</a>
            </div>
        </div>
    </div>
    @endforeach

