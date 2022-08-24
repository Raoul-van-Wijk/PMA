<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Current schedule') }}
        </h2>
    </x-slot>
<div class="schedule-container">
    <div class="header">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ url()->previous() }}">Go back</a><br>
                    <a href="{{ route('allSchedules') }}">View all schedules</a>
                </div>
            </div>
        </div>
    </div>
    <div class="schedule-content">
        <div class="schedule-content-item">
            <div class="schedule-content-item-header">
                <div class="row">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <p>Teacher: {{ $schedule[0]->teacher->name }}</p>
                                <p>Course: {{ $schedule[0]->courses->course_name }}</p>
                                <p>Location: {{ $schedule[0]->location }}</p>
                                <p>Timestamp: {{ $schedule[0]->date . ' - ' . $schedule[0]->startdate. ' - '. $schedule[0]->enddate }}</p>
                                <p>Assignment: {{ $schedule[0]->assignment->title }}</p>
                                <a href="{{ route('viewSingleAssignment', $schedule[0]->assignment->assignment_id) }}">Go to assignment</a>
                            </div>
                        </div>
                        @if(auth()->user()->user_type == 'root' || auth()->user()->id ==  $schedule[0]->teacher_id)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                            <div class="p-6 bg-white border-b border-gray-200">

                                <a href="{{ route('editSchedule', $schedule[0]->schedule_id) }}">edit schedule</a><br>
                                <form action="{{ route('deleteSchedule', $schedule[0]->schedule_id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete schedule</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
