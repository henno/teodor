<h3><?__('Grupid')?></h3>
<ul class="list-group">
    <? foreach ($tests as $test): ?>
        <li class="list-group-item">
            <a href="tests/view/<?= $test['test_id'] ?>/<?= $test['test_name'] ?>"><?= $test['test_name'] ?></a>
        </li>
    <? endforeach ?>
</ul>

<?php if ($auth->is_admin): ?>
<h3>Add new test</h3>

<form method="post" id="form">
    <form id="form" method="post">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><input type="text" name="data[test_name]" placeholder=""/></td>
            </tr>
        </table>

        <button class="btn btn-primary" type="submit">Add</button>
    </form>
    <?php endif; ?>
