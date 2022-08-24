<form action="{{ route('addStudentsToClassConfirmed') }}" method="post">
    @csrf
    <select name="class" id="">
        @foreach ($classes as $class)
            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
        @endforeach
    </select>
    <select name="selectedStudents[]" id="" multiple>
        @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->email }}</option>
        @endforeach
    </select>
    <button type="submit">Add</button>
</form>
