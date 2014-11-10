<h1><? __('Test') ?> <i><?= $test['test_name'] ?></i></h1>

<form role="form" class="form-horizontal" method="post" action="tests/<?= $test['test_id'] ?>">
    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_name">Testi nimi</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="test[test_name]" id="test_name"
                   placeholder="Keemia" value="<?= $test['test_name'] ?>">

        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_max_allowed_attempts">Lubatud soorituste arv</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="test[test_max_allowed_attempts]"
                   id="test_max_allowed_attempts"
                   placeholder="Keemia" value="<?= $test['test_max_allowed_attempts'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_min_score">Minimaalne positiivne punktisumma</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="test[test_min_score]" id="test_min_score" placeholder="Keemia"
                   value="<?= $test['test_min_score'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="person_id">Testi looja</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="test[person_name]" id="person_id" placeholder="Keemia"
                   value="<?= $test['person_name'] ?>"> <input type="hidden" class="form-control"
                                                               name="test[person_id]" id="person_id"
                                                               value="<?= $test['person_id'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="subject_id">Aine nimi</label>

        <div class="col-sm-7">
            <select id="subject_id" name="test[subject_id]" class="chosen-select">
                <? foreach ($subjects as $subject): ?>
                    <option
                        value="<?= $subject['subject_id'] ?>" <?= $test['subject_id'] == $subject['subject_id'] ? 'selected="selected"' : '' ?>><?= $subject['subject_name'] ?></option>
                <? endforeach ?>
            </select>
        </div>
    </div>

    <!-- EDIT BUTTON -->
    <? if ($auth->is_admin): ?>
        <form>
            <div class="pull-right">
                <button class="btn btn-primary">
                    Salvesta
                </button>
            </div>
        </form>
    <? endif; ?>
</form>

<h1><? __('Küsimused') ?></h1>

<!-- ADD NEW QUESTION BUTTON -->
<?php if ($auth->is_admin): ?>
    <button type="button" class="btn btn-primary" data-toggle="modal"
            data-target="div.new-question-modal"><? __('Uus küsimus') ?></button>
<?php endif; ?>

<table class="table table-bordered">

    <? $n = 0;
    foreach ($questions as $question): $n++ ?>
        <tr>
            <td><?= $n ?>.</td>
            <td><?= $question['test_question_text'] ?></td>
        </tr>
    <? endforeach ?>
</table>

<!-- QUESTION POPUP -->
<div class="modal fade new-question-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 class="modal-title"><? __('Uus küsimus') ?></h3>
</div>
<div class="modal-body">
<form action="" method="post">
<form role="form" class="form-horizontal" method="post" action="tests/<?= $test['test_id'] ?>">

    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_question_text"><? __('Küsimuse tekst') ?></label>

        <div class="col-sm-7">
            <textarea name="question[test_question_text]" id="test_question_text" cols="30" rows="10"
                      class="form-control"><?= $test['test_name'] ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_question_type_id"><? __('Tüüp') ?></label>

        <div class="col-sm-7" style="padding-top: 10px; padding-bottom: 10px">
            <select name="question[test_question_type_id]" id="test_question_type_id" class="chosen-select">
                <? foreach ($question_types as $question_type): ?>
                    <option
                        value="<?= $question_type['test_question_type_id'] ?>" <?= $question['test_question_type_id'] == $question_type['test_question_type_id'] ? 'selected="selected"' : '' ?>><?= $question_type['test_question_type_name'] ?></option>
                <? endforeach ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-5 control-label" for="test_question_answer_text">Vastusevariandid</label>

        <div class="col-sm-7">

            <p><input type="text" class="form-control" name="question[test_question_answer_text]"
                      id="test_question_answer_text" placeholder="Vastusevariant 1"></p>

            <p><input type="text" class="form-control" name="question[test_question_answer_text]"
                      id="test_question_answer_text" placeholder="Vastusevariant 2"></p>

            <p><input type="text" class="form-control" name="question[test_question_answer_text]"
                      id="test_question_answer_text" placeholder="Vastusevariant 3"></p>

            <p><input type="text" class="form-control" name="question[test_question_answer_text]"
                      id="test_question_answer_text" placeholder="Vastusevariant 4"></p>

            <p>
                <button onclick="return false"
                        class="btn btn-default pull-right"><? __('Lisa uus vastusevariant') ?></button>
            </p>

        </div>

    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="person_id">Testi looja</label>

        <div class="col-sm-7">
            <input type="text" class="form-control" name="test[person_name]" id="person_id" placeholder="Keemia"
                   value="<?= $test['person_name'] ?>"> <input type="hidden" class="form-control"
                                                               name="test[person_id]" id="person_id"
                                                               value="<?= $test['person_id'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 control-label" for="subject_id">Aine nimi</label>

        <div class="col-sm-7">
            <select id="subject_id" name="test[subject_id]" class="chosen-select">
                <? foreach ($subjects as $subject): ?>
                    <option
                        value="<?= $subject['subject_id'] ?>" <?= $test['subject_id'] == $subject['subject_id'] ? 'selected="selected"' : '' ?>><?= $subject['subject_name'] ?></option>
                <? endforeach ?>
            </select>
        </div>
    </div>

    <!-- EDIT BUTTON -->
    <? if ($auth->is_admin): ?>
        <div class="pull-right">
            <button class="btn btn-primary">
                Salvesta
            </button>
        </div>
    <? endif; ?>
</form>

<label>Question 1 of 1</label>

<textarea cols="50" id="id_question" name="question" rows="5"></textarea>

<div id="points-input">
    <label>Points</label>
    <input id="id_points" name="points" size="2" type="text" value="1">
</div>

<label>Type</label>
<select id="id_type_id" name="type_id">
    <option value="1">True/false</option>
    <option value="2" selected="selected">Multiple choice</option>
    <option value="3">Multiple response</option>
    <option value="4">Fill in the blank</option>
</select>

<div id="answer-template">
    <!-- multiple choice -->

    <div id="type-id-1" class="answer-template" style="display: none;">

        <label>Enter the two answer choices and mark the correct answer</label>

        <input checked="checked" name="1-correct" type="radio" value="0">
        <textarea cols="40" id="id_1-answer_0" name="1-answer_0" rows="10">True</textarea>

        <input name="1-correct" type="radio" value="1">
        <textarea cols="40" id="id_1-answer_1" name="1-answer_1" rows="10">False</textarea>


    </div>

    <div id="type-id-2" class="answer-template" style="display: block;">

        <label>Enter the answer choices, and mark which answer is correct</label>

        <div id="multiple-choice-options">

            <div class="answer-option">
                <input checked="checked" name="2-correct" type="radio" value="0">
                <textarea cols="40" id="id_2-answer_0" name="2-answer_0" rows="10"></textarea>
            </div>

            <div class="answer-option">
                <input name="2-correct" type="radio" value="1">
                <textarea cols="40" id="id_2-answer_1" name="2-answer_1" rows="10"></textarea>
            </div>

            <div class="answer-option">
                <input name="2-correct" type="radio" value="2">
                <textarea cols="40" id="id_2-answer_2" name="2-answer_2" rows="10"></textarea>
            </div>

            <div class="answer-option">
                <input name="2-correct" type="radio" value="3">
                <textarea cols="40" id="id_2-answer_3" name="2-answer_3" rows="10"></textarea>
            </div>

        </div>
        <p><a href="#" class="add-answer-choice">Add</a> / <a href="#" class="remove-answer-choice">Remove</a>
            answer choice</p>
        <label><input id="id_shuffle_answers" name="shuffle_answers" type="checkbox"> Shuffle
            answers
            <small>Uncheck if you have an "all of the above" answer</small>
        </label>

    </div>

    <div id="type-id-3" class="answer-template" style="display: none;">

        <label>Enter the answer choices, and mark which answers are correct</label>

        <div id="multiple-response-answer-options">

            <div class="answer-option">
                <input checked="checked" id="id_3-correct_0" name="3-correct_0" type="checkbox">
                <textarea cols="40" id="id_3-answer_0" name="3-answer_0" rows="10"></textarea>
            </div>

            <div class="answer-option">
                <input id="id_3-correct_1" name="3-correct_1" type="checkbox">
                <textarea cols="40" id="id_3-answer_1" name="3-answer_1" rows="10"></textarea>
            </div>

            <div class="answer-option">
                <input id="id_3-correct_2" name="3-correct_2" type="checkbox">
                <textarea cols="40" id="id_3-answer_2" name="3-answer_2" rows="10"></textarea>
            </div>

            <div class="answer-option">
                <input id="id_3-correct_3" name="3-correct_3" type="checkbox">
                <textarea cols="40" id="id_3-answer_3" name="3-answer_3" rows="10"></textarea>
            </div>

        </div>
        <p><a href="#" class="add-answer-choice">Add</a> / <a href="#" class="remove-answer-choice">Remove</a>
            answer choice</p>
        <label><input id="id_shuffle_answers" name="shuffle_answers" type="checkbox"> Shuffle
            answers
            <small>Uncheck if you have an "all of the above" answer</small>
        </label>

    </div>

    <div id="type-id-4" class="answer-template" style="display: none;">

        <label>Enter the answer choices, and mark which answers are correct</label>

        <div id="fill-in-the-blank-answer-options">

            <div class="answer-option">
                <input checked="checked" disabled="disabled" id="id_4-correct_0" name="4-correct_0"
                       type="checkbox">
                <textarea cols="40" id="id_4-answer_0" name="4-answer_0" rows="10"></textarea>
            </div>

        </div>
        <p><a href="#" class="add-answer-choice">Add</a> / <a href="#" class="remove-answer-choice">Remove</a>
            answer choice</p>

    </div>

</div>

<div class="button-list">
    <input type="submit" name="submit" value="Save">
    <input type="submit" name="submit" value="Save and Add New Question">
    <input type="reset" name="cancel" value="Cancel"
           onclick="window.location = '/387905/admin/questions?question_id=0'">
</div>
</form>
</div>
<div class="modal-footer">
    <button class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    $(function() {
        $(".chosen-select").chosen({width: "100%"});
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
    });
</script>