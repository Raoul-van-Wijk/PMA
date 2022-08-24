<div id="schedules">
    <div class="schedule-comp">
        @foreach($schedules as $i => $schedule)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
            {{ $days[$i] }}
            @foreach ($schedule as $schedule)
                <div class="schedule-item">
                    {{ $schedule->courses->course_name .'-' . $schedule->location.' - '. $schedule->startdate.' - '. $schedule->enddate }}
                    <a href="{{ route('showSingleSchedule', $schedule->schedule_id) }}">></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
        @endforeach
        <nav>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="{{ route('allSchedules',$id -1) }}">Previous Week</a></li>
                <li class="page-item"><a class="page-link" href="{{ route('allSchedules',$id +1) }}">Next Week</a></li>
            </ul>
        </nav>
    </div>
</div>
