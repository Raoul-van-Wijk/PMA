<x-app-layout>
    <x-slot name="header">
        {{ __('Overview') }}
    </x-slot>
    {{ dd($ass) }}
    @foreach ($ass as $period => $progress )

        <h2>period: {{ $period }}</h2>
        @foreach ($progress as $week => $progression)
            <h3>Week: {{ $week }}</h3>
            <?php $i = 0 ?>
            @foreach ($progression['assignments'] as $assignment => $prog)

                <p>Assignment: {{ $prog[$i]['title'] }}</p>

                @foreach ($prog[$i]['students_progression'] as $student)
                {{-- {{ dd($student) }} --}}
                <p>Student: {{ $student['name'] }}</p>
                @if ($student['progress']['completed'] == 0)
                <p class="not-finished">Progression: Not completed</p>
                @endif
                @if ($student['progress']['completed'] == 1)
                <p class="finished">Progression: Completed</p>
                @endif
                @endforeach
                <?php $i++ ?>
            @endforeach
        @endforeach

    @endforeach

</x-app-layout>
