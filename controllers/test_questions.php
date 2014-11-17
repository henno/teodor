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
        $test_question_id = $this->params[0];

        $this->question = get_first("SELECT * FROM test_question NATURAL JOIN test_question_type
                                       WHERE test_question_id = '$test_question_id'");
        $this->answers = get_all("SELECT * FROM test_question_answer WHERE test_question_id = $test_question_id");

    }
} 