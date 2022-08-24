
<x-auth-validation-errors class="mb-4" :errors="$errors" />
<form action="{{ route('editScheduleConfirmed', $id) }}" method="POST">
    @csrf
    @method('PUT')
    <select name="class" id="class">
        <option value="">Select a class</option>

        @foreach ($classes as $class)
            <option value="{{ $class->class_id }}" @if ($class->class_id == $schedule[0]->class_id) selected @endif>{{ $class->class->class_name }}</option>
        @endforeach
    </select>
    @if(auth()->user()->hasRole(['root', 'admin']))
        <select name="teacher" id="teacher">

            <option value="">Select a teacher</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}" @if ($teacher->id == $schedule[0]->teacher_id) selected @endif>{{ $teacher->name }}</option>
            @endforeach
        </select>
    @endif
    <select name="course" id="course">
        <option value="">Select a course</option>
        @foreach ($courses as $course)
            <option value="{{ $course->course_id }}" @if ($course->course_id == $schedule[0]->course_id) selected @endif>{{ $course->course_name }}</option>
        @endforeach
    </select>

    <select name="assignment" id="assignment">
        <option value="">Select an assignment</option>
        @foreach ($assignments as $assignment)
            <option value="{{ $assignment->assignment_id }}" @if ($assignment->assignment_id == $schedule[0]->assignment_id) selected @endif>{{ $assignment->title }}</option>
        @endforeach
    </select>
    <input type="text" name="classroom" id="" value="{{ $schedule[0]->location }}">
    <input type="date" name="date" id="" value="{{ $schedule[0]->date }}">
    <input type="time" name="start_time" id="" value="{{ $schedule[0]->startdate }}">
    <input type="time" name="end_time" id="" value="{{ $schedule[0]->enddate }}">
    @if(auth()->user()->hasRole(['teacher']))
        <input type="hidden" name="teacher" value="{{ auth()->user()->id }}">
    @endif
    <button type="submit">Edit Schedule</button>
</form>

