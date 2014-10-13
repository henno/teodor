<h1><?__('Grupp')?> <i><?= $group['group_name'] ?></i></h1>
<table class="table table-bordered">
    <tr>
        <th><?__('Kursusevanem')?></th>
        <td><input name="data[group_representative]" type="text"/></td>
    </tr>
    <tr>
        <th><?__('Kursusejuhataja')?></th>
        <td><input name="data[group_manager]" type="text"/></td>
    </tr>
    <? if( $auth->is_admin ): ?>
        <tr>
            <th></th>
            <td><?= $group['password'] ?></td>
        </tr>
    <? endif; ?>
    <tr>
        <th>Aktiivne</th>
        <td><input type="checkbox" name="data[active]" <?= $group['active'] != 0 ? 'checked="checked"' : '' ?> disabled="disabled"/></td>
    </tr>
</table>

<!-- EDIT BUTTON -->
<? if($auth->is_admin):?>
    <form action="groups/edit/<?= $group['group_id'] ?>">
        <div class="pull-right">
            <button class="btn btn-primary">
                Edit
            </button>
        </div>
    </form>
<? endif; ?>

<h1><?__('Liikmed')?></h1>
<table class="table table-bordered">
    <tr>
        <th><?__('Nimi')?></th>
        <th><? __('Pilt') ?></th>
    </tr>
    <? foreach($members as $member): ?>
    <tr>
        <td><?=$member['person_name'] ?></td>
        <td><?=$member['person_image'] ?></td>
    </tr>
    <? endforeach ?>
</table>