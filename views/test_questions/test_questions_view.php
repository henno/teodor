<h1><?= $question['test_question_text'] ?></i></h1>
<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th><? __('Vastus') ?></th>
        <th>Õige?</th>
    </tr>
    <? $n = 0;
    foreach ($answers as $answer): $n++ ?>
        <tr>
            <td><?= $n ?>.</td>
            <td><?= $answer['test_question_answer_text'] ?></td>
            <td><input type="checkbox" <?= $answer['test_question_answer_correct'] ? 'checked=checked' : '' ?>/></td>
        </tr>
    <? endforeach ?>
</table>