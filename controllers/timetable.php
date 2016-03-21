<?php


class timetable extends Controller
{
    public $timetable = [];

    function index()
    {

        $lectures = get_all("SELECT *
                                   FROM schedules
                                   JOIN courses USING (course_id)
                                   JOIN groups USING (group_id)
                                   JOIN persons ON (teacher_id=person_id)
                                   JOIN rooms USING (room_id)
                                   JOIN subjects USING (subject_id)"
        );


        foreach ($lectures as $lecture) {
            $timetable['title'] = <<<EOT
                <a title="$lecture[room_nr]" href="schedule/rooms/$lecture[room_id]"><span class="label label-danger">$lecture[room_nr]</span></a>
                <a title="$lecture[group_name]" href="schedule/groups/$lecture[group_id]"><span class="label label-danger">$lecture[group_name]</span></a>
                <a title="$lecture[person_lastname]" href="schedule/persons/$lecture[person_id]"><span class="label label-success">$lecture[person_lastname]</span></a>
                <a title="$lecture[subject_name]" href="courses/$lecture[subject_id]">$lecture[subject_name]</a>
EOT;
            $timetable['start'] = $lecture['start'];
            $timetable['end'] = $lecture['end'];
            $this->schedule[] = $timetable;
        };
        $this->schedule = json_encode($this->schedule);
    }
}
//start_time > DATE_SUB(NOW(), INTERVAL 1 WEEK)

//DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)