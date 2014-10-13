<?php
/**
 * Created by PhpStorm.
 * User: Silja
 * Date: 13.10.14
 * Time: 11:44
 */
class tests extends Controller{
    function index(){
        $this->tests = get_all("SELECT * FROM `test`");
    }

    function view()
    {
        $test_name = $this->params[0];
        $this->tests = get_all("SELECT person_name, test_name COUNT(*)
                                FROM test_participants
                                NATURAL JOIN person
                                NATURAL JOIN test
                                GROUP BY person_id, test_id
                                 WHERE test_name ='$test_name'");
    }
}