<?php

use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;

class digitalocean_api extends Controller
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

        // Get an instance of Key API
        $key_api = $digitalocean->key();
        $this->ssh_key = $key_api->getById(523573);
    }

    function get_all()
    {
        return $this->droplet_api->getAll();
    }

    function delete($droplet_id)
    {
        $this->droplet_api->delete($droplet_id);
    }

    function rebuild()
    {
        $this->droplet_api->rebuild($this->droplet_id, $this->droplet_api->getById($this->droplet_id)->image->id);
    }

    function reboot()
    {
        $this->droplet_api->reboot($this->droplet_id);
    }

    public function create_droplet($droplet_name)
    {
        if (!(empty($droplet_name))) {
            $droplet = $this->droplet_api->create($droplet_name, 'ams3', '1gb', 'ubuntu-14-04-x64', 0, 0, 0, array($this->ssh_key->id)) or exit ('Creating of droplet failed');
            return $droplet->id;
        }
    }
}