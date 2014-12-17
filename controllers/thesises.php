<?php

class thesises extends Controller
{

    function index()
    {
        $this->thesises = get_all("SELECT * FROM `thesis`");
        $this->instructors = get_all("SELECT * FROM `person`");

        // Kas see ei ole mitte JS siin PHP kontrolleri sees? See peaks ikka vaates olema.
        /*$('#myTab a').click(function () {
            $('#myTab a[href="thesis_index"]').tab('show');
            $('#myTab a[href="thesises_in_progress_"]').tab('show');
            $('#myTab a[href="thesises_approval"]').tab('show');
            $('#myTab a[href="thesises_archive"]').tab('show');
        });*/
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
        $this->files = get_all("SELECT * FROM thesis_file WHERE thesis_id = '$thesis_id' ");
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
            global $db;
            $fp      = fopen($f["tmp_name"], 'r');
            $content = fread($fp, filesize($f["tmp_name"]));
            $content = mysqli_real_escape_string($db, $content);
            $size = 1262;
            fclose($fp);

            if(!get_magic_quotes_gpc())
            {
                $f["name"] = mysqli_real_escape_string($db, $f["name"]);
            }
            $query = "INSERT INTO thesis_file (thesis_file_name, thesis_id, thesis_file_size, thesis_file_type, thesis_file_content ) ".
                "VALUES ('$f[name]', $thesis_id, '$size', '$f[type]', '$content')";
            q ($query);
            if (move_uploaded_file($f["tmp_name"], $target_dir)) {
                echo "The file " . basename($f["name"]) . " has been uploaded.";

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    function file () {
        // clean the output buffer
        ob_end_clean();
        $thesis_file_id = $this->params[0];
        $file = get_first("SELECT * FROM thesis_file WHERE thesis_file_id = '$thesis_file_id' ");
        header("Content-length: $file[thesis_file_size]");
        header("Content-type: $file[thesis_file_type]");
        header("Content-Disposition: attachment; filename=$file[thesis_file_name]");
        exit($file['thesis_file_content']);
    }
    function add ()
    {}

    function edit ()
    {
        $this->thesis_id = $this->params[0];
        $this->thesis = get_first("SELECT *,
                                   author.person_name as author_name,
                                   instructor.person_name as instructor_name
                                   FROM thesis
                                   JOIN person instructor ON thesis.person_id_instructor = instructor.person_id
                                   JOIN person author ON thesis.person_id_author = author.person_id
                                   WHERE thesis_id = '$this->thesis_id' ");
    }

    function edit_post() { 
        $thesis = $_POST['thesis'];
        $this->thesis_id = $this->params[0];
        update('thesis', $thesis, "thesis_id = {$this->thesis_id}");

    }

    function approval ()
    {}

    function in_progress()
    {}
}