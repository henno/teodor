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
        $this->tasks=array(array('subject_name' => 'veebitehnoloogiad','task_name' => 'jenkins_docker','task_due' => '2014-04-12', 'task_status_name' =>'tehtud', 'task_time_required'=>'15'));
        //$this->tasks=get_all("SELECT * FROM task NATURAL JOIN subject ");
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