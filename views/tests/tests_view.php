<h1><? __('Test') ?> <i><?= $test['test_name'] ?></i></h1>

<form role="form" class="form-horizontal" method="post" action="tests/<?= $test['test_id'] ?>">
    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_name">Testi nimi</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="data[test_name]" id="test_name"
                   placeholder="Keemia" value="<?= $test['test_name'] ?>">

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_max_allowed_time">Testi sooritamiseks lubatud aeg</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="data[test_max_allowed_time]" id="test_max_allowed_time"
                   placeholder="Keemia" value="<?= $test['test_max_allowed_time'] ?>">

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_max_allowed_attempts">Lubatud soorituste arv</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="data[test_max_allowed_attempts]"
                   id="test_max_allowed_attempts"
                   placeholder="Keemia" value="<?= $test['test_max_allowed_attempts'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_min_score">Minimaalne positiivne punktisumma</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="data[test_min_score]" id="test_min_score" placeholder="Keemia"
                   value="<?= $test['test_min_score'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="person_id">Testi looja</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="data[person_name]" id="person_id" placeholder="Keemia"
                   value="<?= $test['person_name'] ?>"> <input type="hidden" class="form-control"
                                                               name="data[person_id]" id="person_id"
                                                               value="<?= $test['person_id'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="subject_id">Aine nimi</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="data[subject_id]" id="subject_id" placeholder="Keemia"
                   value="<?= $test['subject_id'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="lecture_id">Loengu nimi</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="data[lecture_id]" id="lecture_id" placeholder="Keemia"
                   value="<?= $test['lecture_id'] ?>">
        </div>
    </div>


    <!-- EDIT BUTTON -->
    <? if ($auth->is_admin): ?>
        <form >
            <div class="pull-right">
                <button class="btn btn-primary">
                    Salvesta
                </button>
            </div>
        </form>
    <? endif; ?>
</form>

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