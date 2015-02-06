<?php

/**
 * Created by PhpStorm.
 * User: carolin
 * Date: 28.01.15
 * Time: 9:50
 */
class thesises_manage extends Controller
{
    function index()
    {
        $this->departments = get_all("SELECT * FROM department");
    }

    function view()
    {
        $department_id = $this->params[1];
        $this->selected_department = get_first("SELECT * FROM department WHERE department_id='{$department_id}'");
        $this->departments = get_all("SELECT * FROM department");
        $this->admins = get_all("SELECT * FROM thesis_admins NATURAL JOIN person WHERE department_id='{$department_id}'");
        $this->persons = get_all("SELECT * FROM person");

    }

    function add_admin()
    {
        insert('thesis_admins', $_GET);
        exit('Ok');
    }

    function delete_admin() {
        $person_id = $_GET['person_id'];
        $department_id = $_GET['department_id'];
        q("delete from thesis_admins WHERE person_id={$person_id} AND department_id={$department_id}");
        exit('Ok');
    }

}

