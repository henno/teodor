<h3><? __('Testid') ?></h3>

<?php if ($auth->is_admin): ?>

    <form role="form" class="form-inline" method="post">
        <div class="form-group">
            <label for="test_name">Lisa uus test</label>
            <input type="text" class="form-control" name="data[test_name]" id="test_name" placeholder="Testi nimi">
            <button class="btn btn-primary" type="submit">Lisa</button>
        </div>
    </form>

<?php endif; ?>

<ul class="list-group">
    <? foreach ($tests as $test): ?>
        <li class="list-group-item">
            <a href="tests/<?= $test['test_id'] ?>/<?= $test['test_name'] ?>"><?= $test['test_name'] ?></a>
        </li>
    <? endforeach ?>
</ul>

