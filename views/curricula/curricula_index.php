<style>
    td {
        text-align: center;
    }
</style>
<h1><? __('Õppekavad') ?></h1>
<? if (empty($curricula)): ?>
    <div class="alert alert-info"><? __('Õppekavad puuduvad') ?></div>
<? else: ?>
    <table class="table table-bordered" style="width: auto;">
        <thead>
        <tr>
            <th class="header">EHISe kood</th>
            <th class="header">Liik</th>
            <th class="header">Õppekava nimetus</th>
            <th class="header">Õppekava maht</th>
            <th class="header">Seis</th>
            <th class="header">Koolitusluba</th>
            <th class="header">Õppegrupid</th>
            <th class="header">Kontaktisik</th>
            <th class="header">Tegevused</th>
        </tr>
        </thead>
        <tbody>

        <? $n = 0;
        foreach ($curricula as $curriculum): $n++ ?>
            <tr data-id="<?= $curriculum['curriculum_id'] ?>">
                <td><?= $n++ ?>.</td>
                <td><?= $curriculum['curriculum_EHIS_code'] ?></td>
                <td><?= $curriculum['curriculum_type'] ?></td>
                <td><?= $curriculum['curriculum_name'] ?></td>
                <td><?= $curriculum['curriculum_length'] ?></td>
                <td><?= $curriculum['curriculum_state'] ?></td>
                <td><?= $curriculum['curriculum_licence'] ?></td>
                <td><?= $curriculum['curriculum_groups'] ?></td>
                <td><?= $curriculum['curriculum_contacts'] ?></td>
                <td><?= $curriculum['curriculum_actions'] ?></td>
                <td><a href="curricula/<?= $curriculum['curriculum_id'] ?>"><? __('Ava') ?></a></td>
            </tr>
        <? endforeach ?>

        </tbody>
    </table>
<? endif ?>

<script>
    $('table').on('click', 'tbody tr', function () {
        alert(this);
    });
</script>


