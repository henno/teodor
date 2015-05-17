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
        $this->subjects = get_all("SELECT * FROM subject");
    }

    function view_ajax()
    {

        $test_id = $this->params[0];

        // Set shortcut
        $question = $_POST['question'];

        // Save to database
        if (!empty($question['test_question']['test_question_text'])) {

            // Insert question
            $question_id = insert('test_question', $question['test_question'] + array('test_id' => $test_id));

            // Insert answers
            foreach ($question['test_question_answer'] as $test_question_answer) {

                // Skip empty answers
                if (!empty($test_question_answer['test_question_answer_text'])) {
                    $test_question_answer['test_question_answer_correct'] = isset($test_question_answer['test_question_answer_correct']) ? 1 : 0;
                    insert('test_question_answer', $test_question_answer + array('test_question_id' => $question_id));
                }
            }

            exit('OK');
        }
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
        $test_id = $this->params[0];

        // Update test properties
        if (isset($_POST['test'])) {
            $test = $_POST['test'];
            unset($test['person_id']);
            unset($test['person_lastname']);
            update('test', $test, "test_id = {$test_id}");
            header('Location: ' . BASE_URL . 'tests/' . $test_id);


        }


    }
}