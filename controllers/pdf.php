<?php
/**
 * Created by PhpStorm.
 * User: carolin
 * Date: 10.06.2015
 * Time: 14:04
 */


class pdf extends Controller
{

    public $template = "pdf";

    function thesises_approval()
    {
        // thesises to be confirmed
        $this->thesises = get_all("SELECT * FROM `thesis` NATURAL JOIN thesis_authors NATURAL JOIN person LEFT JOIN group_persons ON thesis_authors.person_id=group_persons.person_id LEFT JOIN curriculum_groups ON group_persons.group_id=curriculum_groups.group_id LEFT JOIN curriculum ON curriculum_groups.curriculum_id=curriculum.curriculum_id LEFT JOIN department on curriculum.department_id=department.department_id WHERE thesis_idea IS NULL AND thesis_title_confirmed_at IS NULL AND thesis_deleted IS NULL OR thesis_idea=0 AND thesis_title_confirmed_at IS NULL AND thesis_deleted IS NULL");
        require('views/thesises/pdf_for_approval.php');
        exit();

    }

}