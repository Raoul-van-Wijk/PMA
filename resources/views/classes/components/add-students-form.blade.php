<form action="{{ route('addStudentsToClassConfirmed', $class_id) }}" method="post">
    @csrf
    <select name="selectedStudents[]" id="" multiple>
        @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->email }}</option>
        @endforeach
    </select>
    <button type="submit">Add</button>
</form>
