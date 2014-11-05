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
        $this->questions = get_all("SELECT * FROM test_question
                                       WHERE test_id = '$test_id'");
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
        $data = $_POST['data'];
        unset($data['person_id']);
        unset($data['person_name']);
        $test_id= $this->params[0];
        update('test', $data, "test_id = {$test_id}");
        header('Location: ' . BASE_URL . 'tests/' . $test_id);
    }

}