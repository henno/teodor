<? if (empty($thesises)): ?>
    <div class="alert alert-info"><?__('Hetkel lõputööde andmebaas on tühi.') ?></div>
<? else: ?>

    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default">Väljapakutud ideed</button>
        <button type="button" class="btn btn-default">Kinnitamisel</button>
        <button type="button" class="btn btn-default">Teostamisel</button>
        <button type="button" class="btn btn-default">Eelnevate aastate lõputööd</button>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Teema</th>
            <th>Tegevused</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($thesises as $thesis): ?>
            <tr>
                <td><?= $thesis['thesis_id'] ?></td>
                <td><a href="thesises/view/<?= $thesis['thesis_id'] ?>/<?= $thesis['thesis_title'] ?>"><?= $thesis['thesis_title'] ?></a>
                </td>
                <td>...</td>
            </tr>
        <? endforeach ?>
        <tbody>
    </table>

    <?php if ($auth->is_admin): ?>

         <div class="pull-left">
            <button class="btn btn-primary">
                Sisesta uus
            </button>
        </div>
    <?php endif; ?>
<? endif ?>