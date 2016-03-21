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
                  join courses USING (course_id)
                  join subjects USING (subject_id)
                  join periods USING (period_id)
                  join years USING (year_id)
                  join groups USING (group_id)
                  join course_tasks USING (course_id)
                  join tasks USING (task_id)
                WHERE courses.teacher_id = $my_id";
        $this->period_courses = get_all($sql);
        $this->periods = get_all("SELECT * FROM periods");
        $this->taught_courses = get_all("SELECT * FROM courses 
                                                  JOIN subjects USING (subject_id) 
                                                  JOIN groups USING (group_id)
                                                  WHERE courses.teacher_id={$my_id}");
        $this->courses_taken = get_all("SELECT * FROM group_persons gp
                                                 JOIN courses c ON c.group_id = gp.group_id
                                                 JOIN groups g ON g.group_id = c.group_id
                                                 JOIN subjects s ON s.subject_id = c.subject_id
                                                 JOIN persons p ON p.person_id = c.teacher_id
                                                 WHERE `gp`.person_id={$my_id}");

    }

    private function get_current_period_id()
    {
        return get_one("SELECT period_id FROM periods WHERE now() BETWEEN period_start AND period_end");
    }
    function view() {
        $this->course = get_first("SELECT * FROM courses 
                                          
                                            JOIN subjects USING (subject_id)
                                            JOIN groups USING (group_id)
                                            JOIN group_persons USING (group_id)
                                            JOIN persons USING (person_id)
                                            WHERE course_id = '{$this->params[0]}'");
        $this->task = get_first("SELECT * FROM tasks");
    }
}