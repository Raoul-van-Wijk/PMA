<div id="schedules">
    <div class="schedule-comp">
            @foreach ($schedules as $schedule)
                <div class="schedule-item">
                    {{ $schedule->courses->course_name .'-' . $schedule->location.' - '. $schedule->startdate.' - '. $schedule->enddate }}
                    <a href="{{ route('showSingleSchedule', $schedule->schedule_id) }}">></a>
                </div>
            @endforeach
    </div>
</div>
