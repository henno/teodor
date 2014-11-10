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
            $person = get_first("SELECT person_id, is_admin FROM person
                                WHERE username = '$username'
                                  AND password = '$password'
                                  AND  deleted = 0");
            if (! empty($person['person_id'])) {
                $_SESSION['person_id'] = $person['person_id'];
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
}
