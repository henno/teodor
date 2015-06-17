<?php

/**
 * Created by PhpStorm.
 * User: Anneli
 * Date: 13.10.14
 * Time: 10:23
 */
class courses extends Controller
{
    function index()
    {
        $my_id = $this->auth->person_id;

        $sql = "SELECT *
                FROM period_courses
                  natural join `year`
                  natural join course
                  natural join subject
                  natural join period
                  natural join `group`
                  natural join task
                WHERE course.person_id = $my_id";
        $this->period_courses = get_all($sql);
        $this->periods = get_all("SELECT * FROM period");
        $this->taught_courses = get_all("SELECT * FROM course NATURAL JOIN subject NATURAL JOIN `group` WHERE `course`.person_id={$my_id}");
        $this->courses_taken = get_all("SELECT * FROM group_persons gp
                                                 JOIN course c ON c.group_id = gp.group_id
                                                 JOIN `group` g ON g.group_id = c.group_id
                                                 JOIN `subject` s ON s.subject_id = c.subject_id
                                                 JOIN `person` p ON p.person_id = c.person_id
                                                 WHERE `gp`.person_id={$my_id}");

    }

    private function get_current_period_id()
    {
        return get_one("SELECT period_id FROM period WHERE now() BETWEEN period_start AND period_end");
    }
    function view() {
        $this->course = get_first("SELECT * FROM course NATURAL JOIN person NATURAL JOIN subject NATURAL JOIN `group` WHERE course_id = '{$this->params[0]}'");
        $this->task = get_first("SELECT * FROM task");
    }
}