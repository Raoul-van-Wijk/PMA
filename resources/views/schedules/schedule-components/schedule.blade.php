<div class="schedule-container">
    <div class="header">
        <p>Today's schedule</p>
        <a href="{{ route('allSchedules') }}">View all</a>
    </div>
    <div class="schedule-content">
        <div class="schedule-content-item">
            <div class="schedule-content-item-header">
                @foreach ($schedules as $schedule)
                <div class="row">
                    {{ $schedule->courses->course_name . '-' . $schedule->location. ' - '. $schedule->startdate. ' - '. $schedule->enddate }}
                    <a href="{{ route('showSingleSchedule', $schedule->schedule_id) }}">></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
