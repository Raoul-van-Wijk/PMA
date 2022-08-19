
<x-auth-validation-errors class="mb-4" :errors="$errors" />
<form action="{{ route('storeSchedule') }}" method="POST">
    @csrf
    <select name="class" id="class">
        <option value="">Select a class</option>
        @foreach ($classes as $class)
            <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
        @endforeach
    </select>
    @if(auth()->user()->hasRole(['root', 'admin']))
        <select name="teacher" id="teacher">
            <option value="">Select a teacher</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->user_id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    @endif
    <select name="course" id="course">
        <option value="">Select a course</option>
        @foreach ($courses as $course)
            <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
        @endforeach
    </select>

    <select name="assignment" id="assignment">
        <option value="">Select an assignment</option>
        @foreach ($assignments as $assignment)
            <option value="{{ $assignment->assignment_id }}">{{ $assignment->title }}</option>
        @endforeach
    </select>
    <input type="text" name="classroom" id="">
    <input type="date" name="date" id="">
    <input type="time" name="start_time" id="">
    <input type="time" name="end_time" id="">
    <button type="submit">Create Schedule</button>
</form>
