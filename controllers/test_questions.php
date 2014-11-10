<?php

/**
 * Created by PhpStorm.
 * User: silja
 * Date: 05.11.14
 * Time: 18:21
 */
class test_questions extends Controller
{
    function view()
    {
        $test_id = $this->params[0];
        $test_question_id = $this->params[1];
        echo $test_question_id;
        $this->question = get_first("SELECT * FROM test_question NATURAL JOIN test_question_type
                                       WHERE test_id = '$test_id'");
        $this->answers = get_all("SELECT * FROM test_question_answer WHERE test_question_id = $test_question_id");
        echo "<pre>";
        var_dump($this->answers);
        echo "</pre>";
    }
} 