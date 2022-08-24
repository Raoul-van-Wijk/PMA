Courses
@foreach ($courses as $course)

    <p>{{ $course->course_name . ' - ' . $course->year }}</p>
@endforeach
