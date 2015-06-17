<?php

// Project constants
define('DEFAULT_CONTROLLER', 'welcome');

// Load main menu badges
$badges['tasks'] = 1;

// Load app
require 'system/classes/Application.php';
$app = new Application;
