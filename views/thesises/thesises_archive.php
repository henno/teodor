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

         <div class="pull-left">
            <button class="btn btn-primary">
                Sisesta uus
            </button>
        </div>
    <?php endif; ?>
<? endif ?>