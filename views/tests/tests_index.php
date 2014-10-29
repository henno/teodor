<h3><?__('Testid')?></h3>
<ul class="list-group">
    <? foreach ($tests as $test): ?>
        <li class="list-group-item">
            <a href="tests/view/<?= $test['test_id'] ?>/<?= $test['test_name'] ?>"><?= $test['test_name'] ?></a>
        </li>
    <? endforeach ?>
</ul>



<div class="btn-group btn-group-lg">
    <a href="tests/add/"><button type="button" class="btn btn-default">Lisa uus test </button></a>
</div>





