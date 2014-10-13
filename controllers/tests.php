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
        $test_id = $this->params[0];
        $this->test = get_first("SELECT * FROM test");
        $this->questions = get_all("SELECT * FROM test_question
                                       WHERE test_id = '$test_id'");
    }
}