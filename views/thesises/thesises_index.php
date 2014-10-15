<h3><?__('Lõputööd')?></h3>
<? if (empty($thesises)): ?>
    <div class="alert alert-info"><?__('Hetkel lõputööde andmebaas on tühi.') ?></div>
    <? else: ?>
<ul class="list-group">
    <? foreach ($thesises as $thesis): ?>
        <li class="list-group-item">
            <a href="thesises/view/<?= $thesis['thesis_id'] ?>/<?= $thesis['thesis_title'] ?>"><?= $thesis['thesis_title'] ?></a>
        </li>
    <? endforeach ?>
</ul>

<?php if ($auth->is_admin): ?>
    <h3>Add new thesis</h3>

    <form method="post" id="form">
        <form id="form" method="post">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="data[thesis_name]" placeholder=""/></td>
                </tr>
            </table>

            <button class="btn btn-primary" type="submit">Add</button>
        </form>
    <?php endif; ?>
        <? endif ?>