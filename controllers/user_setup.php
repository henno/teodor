<?php
/**
 * Created by PhpStorm.
 * User: carolin
 * Date: 28.05.2015
 * Time: 17:30
 */
class user_setup extends Controller
{

function index() {
    $this->groups = get_all("SELECT * FROM groups");
}

        function index_post()
        {

            if (isset($_POST['groups'])) {
                $data2['setup'] = 1;
                $person_id = $this->auth->person_id;
                update('persons', $data2, "person_id = '{$person_id}'");
                header('Location: ' . BASE_URL);
            } else {
                $data1 = $_POST['group_persons'];
                $data1['group_id'] = $_POST['group_select'];
                $person_id = $this->auth->person_id;
                $data1['person_id'] = $person_id;
                $data2['setup'] = 1;
                q("BEGIN");
                insert('group_persons', $data1);
                update('persons', $data2, "person_id = '{$person_id}'");
                q("COMMIT");
                header('Location: ' . BASE_URL);
            }
        }
    }