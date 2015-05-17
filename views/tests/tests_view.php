<script>
    var maxQ = 1;
</script>
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
            <input type="text" class="form-control" name="test[person_lastname]" id="person_id" placeholder="Keemia"
                   value="<?= $test['person_lastname'] ?>"> <input type="hidden" class="form-control"
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
                    Salvesta test
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
            <td>
                <a href="<?= BASE_URL ?>test_questions/<?= $question['test_question_id'] ?>"><?= $question['test_question_text'] ?></a>
            </td>
             
            <td><?= $question['test_question_score'] . " punkti" ?></td>
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

                <form id="addQuestion" role="form" class="form-horizontal" method="post"
                      action="tests/<?= $test['test_id'] ?>">

                    <div class="form-group">
                        <label class="col-sm-5 control-label"
                               for="test_question_text"><? __('Küsimuse tekst') ?></label>

                        <div class="col-sm-7">
                            <textarea name="question[test_question][test_question_text]" id="test_question_text"
                                      cols="30" rows="10"
                                      placeholder="<? __('Sisesta küsimus') ?>"
                                      class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label" for="test_question_type_id"><? __('Tüüp') ?></label>

                        <div class="col-sm-7" style="padding-top: 10px; padding-bottom: 10px">
                            <select name="question[test_question][test_question_type_id]"
                                    id="test_question_type_id" class="chosen-select">
                                <? foreach ($question_types as $question_type): ?>
                                    <option
                                        value="<?= $question_type['test_question_type_id'] ?>" <?= $question['test_question_type_id'] == $question_type['test_question_type_id'] ? 'selected="selected"' : '' ?>><?= $question_type['test_question_type_name'] ?></option>
                                <? endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label"
                               for="question[test_question_answer]">Vastusevariandid</label>

                        <div class="col-sm-7">

                            <p class="answer">
                                <input type="checkbox"
                                       name="question[test_question_answer][1][test_question_answer_correct]"/>
                                <input type="text" class="form-control answer"
                                       name="question[test_question_answer][1][test_question_answer_text]"
                                       id="test_question_answer_text" placeholder="Vastusevariant 1">
                            </p>


                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label"
                               for="test_question_score">Mitu punkti</label>

                        <div class="col-sm-7">
                            <p><input type="text" class="form-control"
                                      name="question[test_question][test_question_score]"
                                      id="test_question_score" placeholder="Punkti"></p>
                        </div>
                    </div>


                    <!-- EDIT BUTTON -->
                    <script>
                        function saveQuestion() {
                            $.post("<?=BASE_URL?>tests/view/<?=$test['test_id']?>", $("form#addQuestion").serialize()).done(function (data) {
                                if (data != 'OK') {
                                    alert('<?__('Salvestamine ebaõnnestus')?>');
                                    console.debug(data);
                                    return false;
                                }

                                alert("Data Loaded: " + data);
                            });
                            return false;
                        }

                    </script>
                    <? if ($auth->is_admin): ?>
                        <div class="pull-right">
                            <button type="button" id="save_Question" class="btn btn-primary" onclick="saveQuestion()">
                                Salvesta küsimus
                            </button>
                        </div>
                    <? endif; ?>
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
    $(function () {
        $(".chosen-select").chosen({width: "100%"});
        $('.chosen-select-deselect').chosen({allow_single_deselect: true});

        function klaabu(){
            maxQ++;
            $('p.answer').parent().children("p.answer:last").after('' +
            '<p class="answer" id="answer' + maxQ + '">' +
            '<input type="checkbox" name="question[test_question_answer][' + maxQ + '][test_question_answer_correct]"/> ' +
            '<input onchange="klaabu();" class="answer" type="text" class="form-control" name="question[test_question_answer][' + maxQ + '][test_question_answer_text]" id="test_question_answer_text" placeholder="Vastusevariant ' + (maxQ) + '">' +
            '</p>');
        }
        $('input.answer').change(klaabu() );
    });
</script>