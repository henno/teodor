<table class="table table-bordered" style="width: auto;">
    <tbody>
    <tr>
        <th>#</th>
        <th><?__('Aine')?></th>
        <th><?__('Ülesanne')?></th>
        <th><?__('Tähtaeg')?></th>
        <th><?__('Staatus')?></th>
        <th><?__('Aeg')?></th>
        <th><?__('Tegevused')?></th>
    </tr>

    <? $n=0; foreach ($tasks as $task): $n++ ?>
        <tr class="<?=$task['task_status_name'] ?>">
            <td><?= $n++ ?>.</td>
            <td><?= $task['subject_name'] ?></td>
            <td><?= $task['task_name'] ?></td>
            <td><?= $task['task_due'] ?></td>
            <td><?= $task['task_status_name'] ?></td>
            <td><?= $task['task_time_required'] ?></td>
            <td></td>
        </tr>
    <? endforeach ?>

    </tbody>
</table>