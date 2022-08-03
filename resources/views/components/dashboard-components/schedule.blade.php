<div class="schedule-container">
    <div class="header">Today's schedule</div>
    <div class="schedule-content">
        <div class="schedule-content-item">
            <div class="schedule-content-item-header">
                @foreach ($schedules as $schedule)
                <div class="row">
                    {{ $schedule->courses->course_name . '-' . $schedule->location. ' - '. $schedule->startdate. ' - '. $schedule->enddate }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
