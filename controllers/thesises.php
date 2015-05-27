<?php

class thesises extends Controller
{

    function index()
    {

        $where = isset($_GET['query']) ? "and thesis_title LIKE '%{$_GET['query']}%'" : null;
        $this->query = isset($_GET['query']) ? $_GET['query'] : null;
        $sql = "SELECT * FROM `thesis` WHERE thesis_idea IS NULL AND instructor_id IS NOT NULL AND thesis_title_confirmed_at IS NULL $where";
        $this->thesises = get_all($sql);
        $this->instructors = get_all("SELECT * FROM thesis_instructor");
        $this->thesis_ideas = get_all("SELECT * FROM `thesis` WHERE thesis_idea=1 $where");
        $this->confirmed_thesises = get_all("SELECT * FROM `thesis` WHERE thesis_title_confirmed_at IS NOT NULL AND thesis_defended_at IS NULL $where");
        $this->archived_thesises = get_all("SELECT *, department.department_name FROM `thesis`LEFT JOIN department ON thesis.department_id=department.department_id WHERE thesis_defended_at IS NOT NULL $where");
        $person_id_author = $this->auth->person_id;
        $this->my_thesises = get_all("SELECT * FROM `thesis` NATURAL JOIN thesis_authors WHERE person_id = {$person_id_author} $where");


    }

    function index_post()
    {
        $data = $_POST['thesis'];
        $data['person_id_author'] = NULL;
        $data['person_id_instructor'] = empty($data['selected_person_id_instructor']) ? 1 : $data['selected_person_id_instructor'];
        $thesis_id = insert('thesis', $data);
        header('Location: ' . BASE_URL . 'thesises/' . $thesis_id);
    }

    function view()
    {
        $thesis_id = $this->params[0];
        $this->thesis = get_first("SELECT *,
                                   author.person_firstname as author_first_name,
                                   author.person_lastname as author_last_name,
                                   instructor.instructor_name as instructor_name
                                   FROM thesis
                                  LEFT JOIN thesis_instructor instructor ON thesis.instructor_id = instructor.instructor_id
                                   LEFT JOIN person author ON thesis.person_id_author = author.person_id
                                   WHERE thesis_id = '$thesis_id' ");
        $this->files = get_all("SELECT * FROM thesis_file WHERE thesis_id = '$thesis_id' ");
        $this->thesis_authors = get_all("SELECT * FROM thesis_authors NATURAL JOIN person WHERE thesis_id=$thesis_id");
        $this->instructors = get_all("SELECT * FROM thesis_instructor");
        $person_id = $this->auth->person_id;
        $this->can_view_uploaded_files = get_all("SELECT * FROM `person_roles` WHERE person_id = {$person_id} AND role_id=1");
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
            $fp = fopen($f["tmp_name"], 'r');
            $content = fread($fp, filesize($f["tmp_name"]));
            $content = mysqli_real_escape_string($db, $content);
            $size = 1262;
            fclose($fp);

            if (!get_magic_quotes_gpc()) {
                $f["name"] = mysqli_real_escape_string($db, $f["name"]);
            }
            $query = "INSERT INTO thesis_file (thesis_file_name, thesis_id, thesis_file_size, thesis_file_type, thesis_file_content ) " .
                "VALUES ('$f[name]', $thesis_id, '$size', '$f[type]', '$content')";
            q($query);
            if (move_uploaded_file($f["tmp_name"], $target_dir)) {
                echo "The file " . basename($f["name"]) . " has been uploaded.";

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    function file()
    {
        // clean the output buffer
        ob_end_clean();
        $thesis_file_id = $this->params[0];
        $file = get_first("SELECT * FROM thesis_file WHERE thesis_file_id = '$thesis_file_id' ");
        header("Content-length: $file[thesis_file_size]");
        header("Content-type: $file[thesis_file_type]");
        header("Content-Disposition: attachment; filename=$file[thesis_file_name]");
        exit($file['thesis_file_content']);
    }

    function edit()
    {
        $thesis_id = $this->params[0];
        $this->thesis = get_first("SELECT *,
                                   author.person_firstname as author_first_name,
                                   author.person_lastname as author_last_name,
                                   instructor.instructor_name as instructor_name
                                   FROM thesis
                                  LEFT JOIN thesis_instructor instructor ON thesis.instructor_id = instructor.instructor_id
                                   LEFT JOIN person author ON thesis.person_id_author = author.person_id
                                   WHERE thesis_id = '$thesis_id' ");
        $this->thesis_authors = get_all("SELECT *, person.person_firstname, person.person_lastname FROM thesis_authors LEFT JOIN person on thesis_authors.person_id=person.person_id WHERE thesis_id=$thesis_id");
        $this->instructors = get_all("SELECT * FROM thesis_instructor");

    }

    function edit_post()
    {
        $thesis = $_POST['thesis'];
        $this->thesis_id = $this->params[0];
        update('thesis', $thesis, "thesis_id = '{$thesis_id}'");

    }

    function confirmation_request()
    {
        $thesis_id = $this->params[0];
        $instructor_id = $_POST['instructor_select'];
        $data2['thesis_id'] = $thesis_id;
        $data2['person_id'] = $this->auth->person_id;
		q("BEGIN");
        update('thesis', array('instructor_id'=>$instructor_id, 'thesis_idea'=>"0"), "thesis_id = '{$thesis_id}'");
		insert('thesis_authors', $data2);
        q("COMMIT");
        header('Location: ' . BASE_URL. "thesises/view/$thesis_id");

    }



    function confirm()
    {
        $thesis_id = $this->params[0];
        update('thesis', array('thesis_title_confirmed_at'=>date('Y-m-d')), "thesis_id = '{$thesis_id}'");
        header('Location: ' . BASE_URL. "thesises/view/$thesis_id");

    }

    function defended()
    {
        $thesis_id = $this->params[0];
        update('thesis', array('thesis_defended_at'=>date('Y-m-d')), "thesis_id = '{$thesis_id}'");
        header('Location: ' . BASE_URL. "thesises/view/$thesis_id");

    }


    function add()
    {$this->instructors = get_all("SELECT * FROM thesis_instructor");
    }

    function add_instructor()
    {
        insert('thesis_instructor', $_GET);
        exit('Ok');
    }

    function add_post()
    {
        $data1 = $_POST['thesis'];
        $data1['instructor_id'] = $_POST['instructor_select'];
        $data['thesis_idea'] = 0;
        $person_id = $this->auth->person_id;
        q("BEGIN");
        $thesis_id = insert('thesis', $data1);
        $data2['person_id'] = $person_id;
        $data2['thesis_id'] = $thesis_id;
        insert('thesis_authors', $data2);
        q("COMMIT");
        header('Location: ' . BASE_URL . 'thesises/' . $thesis_id);
    }

    function suggested_thesis()
    {
        $data = $_POST['thesis'];
        $data['instructor_id'] = NULL;
        $data['thesis_idea'] = "1";
        $thesis_id = insert('thesis', $data);
        header('Location: ' . BASE_URL . 'thesises/' . $thesis_id);
    }

    function join_as_coauthor()
    {
        $thesis_id = $this->params[0];
        $person_id = $this->auth->person_id;
        $data['thesis_id'] = $thesis_id;
        $data['person_id'] = $person_id;
        $thesis_id = insert('thesis_authors', $data);
        header('Location: ' . BASE_URL . 'thesises/' . $thesis_id);
    }

    function delete_ajax()
    {

        $person_id = $_GET['person_id'];
        $department_id = $_GET['department_id'];
        $result = q("delete from thesis_admins WHERE person_id={$person_id} AND department_id={$department_id}");
        echo $result ? 'Ok' : 'Fail';
        exit("1");
    }


}



