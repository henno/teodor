<? if (!empty($taught_subjects)): ?>
<h1><? __('Õpetatavad ained') ?></h1>

<!-- Table -->
<table class="table table-bordered">
    <tr>
        <td><b>Grupp</b></td>
        <td><b>Aine</b></td>
        <!-- <td><b>1.</b></td>
         <td><b>2.</b></td>
         <td><b>3.</b></td>
         <td><b>4.</b></td>
         <td><b>5.</b></td>
         <td><b>6.</b></td>
         <td><b>7.</b></td>
         <td><b>8.</b></td>-->
    </tr>
    <? $n = 0;
    foreach ($taught_courses as $course): $n++ ?>
        <tr>
            <td><?= $course['group_name'] ?></td>
            <td><a href="ained/<?= $course['course_id'] ?>"><?= $course['course_name'] ?></a></td>
        </tr>
    <? endforeach ?>
</table>
<? endif?>
<? if (!empty($courses_taken)): ?>
<h1><? __('Õpitavad ained') ?></h1>

<!-- Table -->
<table class="table table-bordered">
    <tr>
        <td><b><? __('Grupp') ?></b></td>
        <td><b><? __('Aine') ?></b></td>
        <td><b><? __('Nimi') ?></b></td>
        <!-- <td><b>1.</b></td>
         <td><b>2.</b></td>
         <td><b>3.</b></td>
         <td><b>4.</b></td>
         <td><b>5.</b></td>
         <td><b>6.</b></td>
         <td><b>7.</b></td>
         <td><b>8.</b></td>-->
    </tr>
    <? $n = 0;
    foreach ($courses_taken as $course): $n++ ?>
        <tr>
            <td><?= $course['group_name'] ?></td>
            <td><a href="<? __('kursused') ?>/<?= $course['course_id'] ?>"><?= $course['subject_name'] ?></a></td>
            <td><?= $course['person_firstname'] .' '. $course['person_lastname'] ?></td>
        </tr>
    <? endforeach ?>
</table>
<? endif?>
<? if (empty($courses_taken) && empty($taught_courses)): ?>
    <div class="alert alert-info"><? __('Ained puuduvad') ?></div>
<? endif?>



