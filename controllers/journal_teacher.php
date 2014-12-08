<?php
/**
 * Created by PhpStorm.
 * User: Anneli
 * Date: 13.10.14
 * Time: 10:23
 */

class journal_teacher extends Controller{
    function index(){
        $my_id = $this->auth->person_id;
        $time_window = "NOW() BETWEEN year_begin AND year_end";
        $sql = "SELECT *, sum(planned_lessons) as planned_lessons FROM period_courses natural join `year` natural join course natural join subject natural join period natural join `group`
                                        WHERE person_id = $my_id AND $time_window
                                        ";
        echo $sql;
        $this->period_courses= get_all($sql);
        var_dump($this->period_courses);
    }
}