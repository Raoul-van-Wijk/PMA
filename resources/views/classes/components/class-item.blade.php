<div>
    @foreach ($classes as $class)

        {{ $class[0]->class_name .' - Total students: '. $countStudents[$class[0]->class_name] }}</br>
    @endforeach
</div>
