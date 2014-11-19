<?php

class groups extends Controller
{

    function index()
    {
        $this->groups = get_all("SELECT * FROM period_courses NATURAL JOIN period NATURAL JOIN course NATURAL JOIN person NATURAL JOIN year NATURAL JOIN `group`");
    }

    function view()
    {
        $group_id = $this->params[0];
        $this->group = get_first("SELECT * FROM `group` WHERE group_id = '{$group_id}'");
        $this->members = get_all("SELECT * FROM `student` NATURAL JOIN person WHERE group_id = '{$group_id}'");
    }

    function edit()
    {
        $group_id = $this->params[0];
        $this->group = get_all("SELECT * FROM `group` WHERE group_id = '{$group_id}'");
    }

    function edit_post()
    {
        $data = $_POST['data'];
        insert('group', $data);
    }

}