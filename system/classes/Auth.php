<?php

/**
 * Class auth authenticates person and permits to check if the person has been logged in
 * Automatically loaded when the controller has $requires_auth property.
 */
class Auth
{

    public $logged_in = FALSE;
    public $is_admin = FALSE;

    function __construct()
    {
        if (isset($_SESSION['person_id'])) {
            $person = get_first("SELECT *
                                       FROM person
                                       WHERE person_id = '{$_SESSION['person_id']}'");

            $this->load_user_data($person);
        }
    }

    /**
     * Verifies if the person is logged in and authenticates if not and POST contains username, else displays the login form
     * @return bool Returns true when the person has been logged in
     */
    function require_auth()
    {
        global $errors;

        // If person has already logged in...
        if ($this->logged_in) {
            return TRUE;
        }

        // Authenticate by POST data
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->login($username, $password)) {
                $person = get_first("SELECT person_id, is_admin FROM person
                                WHERE username = '$username'
                                  AND  deleted = 0");
                if (empty($person['person_id'])) {
                    $now = date('Y-m-d H:i:s');
                    $_SESSION['person_id'] = insert('person', array('username' => $username, 'person_first_visit' => $now, 'person_last_visit' => $now));
                } else {
                    q("UPDATE person SET person_last_visit=NOW() WHERE username = '$username'");
                    $_SESSION['person_id'] = $person['person_id'];
                }
                $this->load_user_data($person);
                return true;
            } else {
                $errors[] = "Vale kasutajanimi või parool";
            }
        }

        // Display the login form
        require 'templates/auth_template.php';

        // Prevent loading the requested controller (not authenticated)
        exit();
    }

    /**
     * Dynamically add all person table fields as object properties to auth object
     * @param $person
     */
    public function load_user_data($person)
    {
        foreach ($person as $person_attr => $value) {
            $this->$person_attr = $value;
        }
        $this->logged_in = TRUE;
    }

    function login($username, $password)
    {
        $output = '';

        // Curl check
        if (!function_exists("curl_init") &&
            !function_exists("curl_setopt") &&
            !function_exists("curl_exec") &&
            !function_exists("curl_close")
        ) die('Install curl extension first.');

        try {
            $ch = curl_init();

            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            // set url
            curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/ClientLogin");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "Email=$username@khk.ee&Passwd=$password&accountType=GOOGLE&source=Google-cURL-Example&service=apps");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $output = curl_exec($ch);

            if (FALSE === $output)
                throw new Exception(curl_error($ch), curl_errno($ch));


        } catch (Exception $e) {
            if ($e->getCode() == 60) {
                echo 'Kasutad Windowsi ja sinu php.ini-st puudub rida curl.cainfo kohta. Seet&otilde;ttu cURL ei suuda kontrollida SSL sertifikaatide kehtivust.
<br>T&otilde;mba <a href="http://curl.haxx.se/ca/cacert.pem">cacert.pem</a> ning lisa php.ini-sse (' . php_ini_loaded_file() . ') rida<strong> curl.cainfo = "FULL_PATH\cacert.pem"</strong> asendades FULL_PATH teekonnaga failini.';
            }
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        }

        // ...process $content now
        return substr($output, 0, 3) == 'SID';
    }
}
