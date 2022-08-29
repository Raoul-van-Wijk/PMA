@foreach ($classes as $classes)
@foreach ($classes as $class)
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
        <div class="p-6 bg-white border-b border-gray-200">
            {{ $class->class_name .' - Total students: '. $countStudents[$class->class_name] }}</br>
            <a href="{{ route('addStudentsToClass', $class->class_id) }}">Add students to class</a><br>
            <a href="{{ route('removeStudentsFromClass', $class->class_id) }}">Remove students from class</a><br>
            <a href="{{ route('viewSingleClass', $class->class_id) }}">View class</a><br>
            <form action="{{ route("deleteClass", $class->class_id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete class</button>
            </form>
        </div>
    </div>
    @endforeach

    @endforeach

