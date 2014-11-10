<?php

/**
 * Created by PhpStorm.
 * User: Silja
 * Date: 13.10.14
 * Time: 11:44
 */
class tests extends Controller
{
    function index()
    {
        $this->tests = get_all("SELECT * FROM `test`");
    }

    function view()
    {
        $test_id = $this->params[0];
        $this->test = get_first("SELECT * FROM test NATURAL JOIN person WHERE test_id = '$test_id'");
        $this->questions = get_all("SELECT * FROM test_question NATURAL JOIN test_question_type
                                       WHERE test_id = '$test_id'");
        $this->question_types = get_all("SELECT * FROM test_question_type");
        var_dump($this->question_types);
        $this->subjects = get_all("SELECT * FROM subject");
    }

    function index_post()
    {
        $data = $_POST['data'];
        $data['person_id'] = $this->auth->person_id;
        $test_id = insert('test', $data);
        header('Location: ' . BASE_URL . 'tests/' . $test_id);
    }

    function view_post()
    {
        // Update test properties
        if (isset($_POST['test'])) {
            $test = $_POST['test'];
            unset($test['person_id']);
            unset($test['person_name']);
            $test_id = $this->params[0];
            update('test', $test, "test_id = {$test_id}");
            header('Location: ' . BASE_URL . 'tests/' . $test_id);

            // Add question
        } elseif (isset($_POST['question'])) {
            $question = $_POST['question'];
            $test_id = $this->params[0];
            $question['test_id'] = $test_id;
            $question['test_question_type_id'] = 1;
            insert('test_question', $question);
            header('Location: ' . BASE_URL . 'tests/' . $test_id);

        }
    }

}