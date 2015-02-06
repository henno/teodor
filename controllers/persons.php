<?php

/**
 * Created by PhpStorm.
 * person: Maile
 * Date: 17.09.14
 * Time: 18:19
 */
class persons extends Controller
{
    public $requires_auth = true;

    function index()
    {
        $this->persons = get_all("SELECT * FROM person WHERE deleted=0");

    }

    function view()
    {
        $person_id = $this->params[0];
        if(empty($person_id))
            error_out('Check person ID in address bar');
        $this->person = get_first("SELECT * FROM person WHERE person_id = '$person_id'");

    }
    function index_post(){
        $data = $_POST['data'];

        $data['active'] = isset($data['active']) ? 1 : 0;
        $person_id = insert('person', $data);
        header('Location: '.BASE_URL .'persons/view/'.$person_id);
    }

    function edit_post(){
        $data = $_POST['data'];
        $data['person_id'] = $this->params[0];
        $data['active'] = isset($data['active']) ? 1 : 0;
        ('person', $data);
        header('Location: '.BASE_URL .'persons/view/'.$this->params[0]);
    }
    function delete_post(){
        $person_id = $_POST['person_id'];
        update('person', ['deleted'=>'1'], "person_id = '$person_id'");
        exit("1");
    }
    function edit(){
        $person_id = $this->params[0];
        $this->person = get_first("SELECT * FROM person WHERE person_id = '$person_id'");
    }

} 