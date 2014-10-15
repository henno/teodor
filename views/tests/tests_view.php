<h1><? __('Test') ?> <i><?= $test['test_name'] ?></i></h1>

<!-- EDIT BUTTON -->
<? if ($auth->is_admin): ?>
    <form action="tests/edit/<?= $test['test_id'] ?>">
        <div class="pull-right">
            <button class="btn btn-primary">
                Edit
            </button>
        </div>
    </form>
<? endif; ?>

<h1><? __('Küsimused') ?></h1>
<table class="table table-bordered">

    <? $n = 0;
    foreach ($questions as $question): $n++ ?>
        <tr>
            <td><?= $n ?>.</td>
            <td><?= $question['test_question_text'] ?></td>
        </tr>
    <? endforeach ?>
</table>