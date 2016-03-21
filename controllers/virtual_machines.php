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
                $task_name = get_one("SELECT task_name FROM tasks WHERE task_id=$task_id");
                $group_name = get_one("SELECT group_name FROM group_persons NATURAL JOIN groups WHERE person_id={$this->auth->person_id}");
                $person = get_one("SELECT concat(person_firstname,' ', person_lastname) person_name FROM persons WHERE person_id={$this->auth->person_id}");

                // Create droplet and get its id
                $droplet_name = slugify($group_name) . '-' . slugify($person) . '-' . slugify($task_name);
                $droplet_id = $digitalocean->create_droplet($droplet_name);

                // Insert new virtual machine info into database
                insert('virtual_machines', array('virtual_machine_id' => $droplet_id, 'task_id' => $task_id, 'person_id' => $this->auth->person_id));
                //mysqli_query($db, "INSERT INTO log set ts=now(), action_type='create', action='$user lõi {$droplet_api->getById($droplet_id)->name}'") or die (mysqli_error($db));
                //mysqli_query($db, "INSERT INTO vms set droplet_id='$droplet_id', droplet_name='$ex_name', owner='$user', exercise_id='$exercise_id', expiry=NOW() + INTERVAL 12 HOUR") or die (mysqli_error($db));

                exit("OK");

            case 'delete':
                $droplet_id = $this->params[1];
                if (!$this->own_vm($droplet_id)) exit ('See ei ole sinu droplet');
                try {
                    $digitalocean->delete($droplet_id);
                } catch (Exception $e) {
                    if ($e->getMessage()=='[422] Droplet already has a pending event. (unprocessable_entity)') {
                        exit ("See droplet on hõivatud hetkel");
                    }
                    else {
                        exit($e->getMessage());
                    }
                }
                //q("DELETE FROM virtual_machine WHERE virtual_machine_id='$droplet_id'");
                $this->log('delete', $droplet_id);

                exit("OK");
        }
    }

    private
    function own_vm($virtual_machine_id)
    {
        $owner = get_one("SELECT person_id FROM virtual_machines WHERE virtual_machine_id = '$virtual_machine_id'");
        //var_dump($virtual_machine_id);
        //var_dump($owner);
       // var_dump($this->auth->person_id);
        return ($owner == $this->auth->person_id);
    }

    private
    function log($action, $droplet_id)
    {

        q("INSERT INTO task_logs (task_log_action_type_id, task_log_timestamp, person_id, virtual_machine_id)
           SELECT task_log_action_type_id, NOW(), {$this->auth->person_id}, {$droplet_id}
           FROM task_log_action_type WHERE task_log_action_type_name = '$action'");
    }
}