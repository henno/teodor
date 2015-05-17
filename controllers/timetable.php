<?php


class timetable extends Controller
{
    public $timetable = [];

    function index()
    {

        $lectures = get_all("SELECT *
                                   FROM timetable
                                   NATURAL JOIN `group`
                                   NATURAL JOIN person
                                   NATURAL JOIN room
                                   NATURAL JOIN subject"
        );

        foreach ($lectures as $lecture) {
            $timetable['title'] = <<<EOT
                <a title="$lecture[room_nr]" href="timetable/rooms/$lecture[room_id]"><span class="label label-danger">$lecture[room_nr]</span></a>
                <a title="$lecture[group_name]" href="timetable/groups/$lecture[group_id]"><span class="label label-danger">$lecture[group_name]</span></a>
                <a title="$lecture[person_lastname]" href="timetable/persons/$lecture[person_id]"><span class="label label-success">$lecture[person_lastname]</span></a>
                <a title="$lecture[subject_name]" href="subjects/$lecture[subject_id]">$lecture[subject_name]</a>
EOT;
            $timetable['start'] = $lecture['start'];
            $timetable['end'] = $lecture['end'];
            $this->timetable[] = $timetable;
        };
        $this->timetable = json_encode($this->timetable);
    }
}
//start_time > DATE_SUB(NOW(), INTERVAL 1 WEEK)

//DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)