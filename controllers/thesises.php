<?php

class thesises extends Controller
{

    function index()
    {
        $this->thesises = get_all("SELECT * FROM `thesis`");
        $this->instructors = get_all("SELECT * FROM `person`");
    }

    function index_post()
    {
        $data = $_POST['thesis'];
        $data['person_id_author'] = $this->auth->person_id;
        $data['person_id_instructor'] = empty($data['selected_person_id_instructor']) ? 1 : $data['selected_person_id_instructor'];
        $thesis_id = insert('thesis', $data);
        header('Location: ' . BASE_URL . 'thesises/' . $thesis_id);
    }

    function view()
    {
        $thesis_id = $this->params[0];
        $this->thesis = get_first("SELECT *,
                                   author.person_name as author_name,
                                   instructor.person_name as instructor_name
                                   FROM thesis
                                   JOIN person instructor ON thesis.person_id_instructor = instructor.person_id
                                   JOIN person author ON thesis.person_id_author = author.person_id
                                   WHERE thesis_id = '$thesis_id' ");
    }

    function view_upload()
    {
        $thesis_id = $this->params[0];
        $f = isset($_FILES["draft_upload"]) ? $_FILES["draft_upload"] : false;
        if (!$f) {
            __('upload ebaõnnestus');
            return false;
        }
        $target_dir = "assets/uploads/" . basename($f["name"]);
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_dir . $f["name"])) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($f['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Only PDF files allowed
       /* if (!($f['type'] == "application/pdf")) {
            __('upload ebaõnnestus');
            $uploadOk = 0;
        }*/

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($f["tmp_name"], $target_dir)) {
                echo "The file " . basename($f["name"]) . " has been uploaded.";

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    function add ()
    {}

    function edit ()
    {}

    function approval ()
    {}

    function in_progress()
    {}
}