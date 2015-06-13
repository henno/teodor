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
    public $requires_auth = false;

    function thesises_approval()
    {
        // Get thesises in approval stage
        $thesises = get_all("SELECT * FROM `thesis` t
                             LEFT JOIN thesis_instructor i ON i.instructor_id = t.instructor_id
                             LEFT JOIN thesis_authors ta ON ta.thesis_id = t.thesis_id
                             LEFT JOIN person a ON a.person_id = ta.person_id
                             LEFT JOIN group_persons ON ta.person_id=group_persons.person_id
                             LEFT JOIN `group` g ON g.group_id = group_persons.group_id
                             LEFT JOIN curriculum_groups ON group_persons.group_id=curriculum_groups.group_id
                             LEFT JOIN curriculum ON curriculum_groups.curriculum_id=curriculum.curriculum_id
                             LEFT JOIN department on curriculum.department_id=department.department_id
                             WHERE thesis_idea IS NULL
                             AND thesis_title_confirmed_at IS NULL
                             AND thesis_deleted IS NULL OR thesis_idea=0
                             AND thesis_title_confirmed_at IS NULL
                             AND thesis_deleted IS NULL");

        // Get HTML for PDF
        ob_start();
        include 'views/thesises/pdf_for_approval.php';
        $html = ob_get_clean();

        // Generate PDF from HTML
        include 'assets/components/mpdf/5.7/mpdf.php';
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullwidth');
        $mpdf->Output();
        exit();

    }

}