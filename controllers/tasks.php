<?php
/**
 * Created by PhpStorm.
 * User: Malin
 * Date: 2.04.2015
 * Time: 17:17
 */

use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;


class tasks extends Controller {
    function index() {
        $this->tasks=get_all("SELECT * FROM person
                              NATURAL JOIN group_persons
                              NATURAL JOIN `group`
                              JOIN course USING (group_id)
                              NATURAL JOIN `course_tasks`
                              NATURAL JOIN subject
                              NATURAL JOIN task
                              NATURAL JOIN task_status
                              WHERE person.person_id={$this->auth->person_id}");
    }

    function klaabu()
    {
        require 'vendor/autoload.php';

        // create an adapter with your access token which can be
        // generated at https://cloud.digitalocean.com/settings/applications
        $adapter = new BuzzAdapter('cd23fc6824f19fbae06104e75d8e998adedb7bd5e575849d99246c77987d59c6');

        // create a digital ocean object with the previous adapter
        $digitalocean = new DigitalOceanV2($adapter);

        // ..
        // return the droplet api
        $droplet = $digitalocean->droplet();

        // return a collection of Droplet entity
        $droplets = $droplet->getAll();
        var_dump($droplets);
        $this->tasks = get_all("SELECT * FROM task");
        $this->n=1;
    }
    function create_ajax(){

    }
}