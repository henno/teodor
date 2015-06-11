<?php

use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;

class virtual_machine extends Controller
{
    private $droplet_id = 0;

    function __construct()
    {
        require 'vendor/autoload.php';
        if (!empty($this->params[0])) {
            $this->droplet_id = $this->params[0];
        }

        // Create Droplet API
        $adapter = new BuzzAdapter('cd23fc6824f19fbae06104e75d8e998adedb7bd5e575849d99246c77987d59c6');
        $digitalocean = new DigitalOceanV2($adapter);
        $this->droplet_api = $digitalocean->droplet();
    }

    function get_all()
    {
        return $this->droplet_api->getAll();
    }

    function delete()
    {
        if (!$this->own_vm($this->droplet_id)) exit ('See ei ole sinu droplet');
        $this->droplet_api->delete($this->droplet_id);
        $this->log('delete', $this->droplet_id);
    }

    function rebuild()
    {
        if (!$this->own_vm($this->droplet_id)) exit ('See ei ole sinu droplet');
        $this->droplet_api->rebuild($this->droplet_id, $this->droplet_api->getById($this->droplet_id)->image->id);
    }

    function reboot()
    {
        if (!$this->own_vm($this->droplet_id)) exit ('See ei ole sinu droplet');
        $this->droplet_api->reboot($this->droplet_id);
    }

    private function own_vm($droplet_id)
    {
        $owner = get_one("SELECT person_id FROM virtual_machine WHERE virtual_machine_id = '$this->droplet_id'");
        return ($owner == $this->auth->person_id);
    }

    private function log($action)
    {

        q("INSERT INTO task_log (task_log_action_type_id, task_log_timestamp, person_id, virtual_machine_id)
           SELECT task_log_action_type_id, NOW(), {$this->auth->person_id}, {$this->droplet_id}
           FROM task_log_action_type WHERE task_log_action_type_name = '$action'");
    }
}