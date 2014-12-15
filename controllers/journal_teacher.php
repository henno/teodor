<?php
/**
 * Created by PhpStorm.
 * User: Anneli
 * Date: 13.10.14
 * Time: 10:23
 */
class journal_teacher extends Controller
{
    function index()
    {
        $my_id = $this->auth->person_id;
        $this->period_id = empty($_GET["period_id"])? $this->get_current_period_id() : $_GET["period_id"];
        $time_window = "period_id = $this->period_id";
        $sql = "SELECT *
                FROM period_courses
                  natural join `year`
                  natural join course
                  natural join subject
                  natural join period
                  natural join `group`
                WHERE course.person_id = $my_id AND $time_window";
        $this->period_courses = get_all($sql);
        $this->periods = get_all("SELECT * FROM period");
    }

    private function get_current_period_id()
    {
        return get_one("SELECT period_id from period where now() between period_start and period_end");
    }
}