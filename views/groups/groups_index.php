<h3><?__('Grupid')?></h3>
<ul class="list-group">
    <? foreach ($groups as $group): ?>
        <li class="list-group-item">
            <a href="groups/view/<?= $group['group_id'] ?>/<?= $group['group_name'] ?>"><?= $group['group_name'] ?></a>
        </li>
    <? endforeach ?>
</ul>

<?php if ($auth->is_admin): ?>
<h3>Add new group</h3>

<form method="post" id="form">
    <form id="form" method="post">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><input type="text" name="data[group_name]" placeholder=""/></td>
            </tr>
        </table>

        <button class="btn btn-primary" type="submit">Add</button>
    </form>
    <?php endif; ?>
