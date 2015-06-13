<?php

/**
 * Created by PhpStorm.
 * User: Malin
 * Date: 13.06.2015
 * Time: 21:33
 */
class virtual_machines extends Controller
{
    function digitalocean()
    {
        // Teodor/virtual_machines/digitalocean/create/<task_id>
        $action = $this->params[0];

        $digitalocean = new digitalocean_api();

        switch ($action) {
            case 'create':
                // Set variables
                $task_id = $this->params[1];
                $task_name = get_one("SELECT task_name FROM task WHERE task_id=$task_id");
                $group_name = get_one("SELECT group_name FROM group_persons NATURAL JOIN `group` WHERE person_id={$this->auth->person_id}");
                $person = get_one ("SELECT concat(person_firstname,' ', person_lastname) person_name FROM person WHERE person_id={$this->auth->person_id}");

                // Create droplet and get its id
                $droplet_name = slugify($group_name).'-'.slugify($person).'-'. slugify($task_name);
                $droplet_id = $digitalocean->create_droplet($droplet_name);

                // Insert new virtual machine info into database
                insert('virtual_machine', array('virtual_machine_id'=>$droplet_id, 'task_id'=>$task_id, 'person_id'=>$this->auth->person_id));
                //mysqli_query($db, "INSERT INTO log set ts=now(), action_type='create', action='$user lõi {$droplet_api->getById($droplet_id)->name}'") or die (mysqli_error($db));
                //mysqli_query($db, "INSERT INTO vms set droplet_id='$droplet_id', droplet_name='$ex_name', owner='$user', exercise_id='$exercise_id', expiry=NOW() + INTERVAL 12 HOUR") or die (mysqli_error($db));

                exit("OK");
        }
    }
}