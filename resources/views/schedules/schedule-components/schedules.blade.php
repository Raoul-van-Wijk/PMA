<div id="schedules">
    <div class="schedule-comp">
        @foreach($schedules as $i => $schedule)
            <div class="schedule-item">
                {{ $schedule[$i]->courses->course_name . '-' . $schedule[$i]->location. ' - '. $schedule[$i]->startdate. ' - '. $schedule[$i]->enddate }}
            </div>
        @endforeach
    </div>
</div>
