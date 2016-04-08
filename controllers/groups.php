<?php

class groups extends Controller
{

    function index()
    {
        $this->groups = get_all("SELECT *
                                 FROM groups g
                                   JOIN persons p ON p.person_id = g.person_id_representative");
    }

    function view()
    {
        $group_id = $this->params[0];

        $this->group = get_first("SELECT *
                                  FROM groups g
                                    JOIN persons p ON p.person_id = g.person_id_representative
                                  WHERE group_id = '{$group_id}'");

        $this->members = get_all("SELECT
                                    persons.person_id,
                                    concat(person_firstname,' ',person_lastname) person_name, person_image
                                  FROM group_persons
                                    JOIN persons ON group_persons.person_id = persons.person_id
                                  WHERE group_id = '{$group_id}'");
    }

    function edit()
    {

        $group_id = $this->params[0];
        $this->group = get_first("SELECT * FROM groups WHERE group_id = '{$group_id}'");
    }

    function edit_post()
    {
        $data = $_POST['data'];
        insert('groups', $data);
    }

}