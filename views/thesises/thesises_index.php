<h2 xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"><? __('Lõputööd') ?></h2>
<h3>Dokumentatsioon</h3>
<form role="form" class="form-horizontal" method="post" action="tests/<?= $test['test_id'] ?>">
    <div class="thesis_title">
        <div class="row">
            <h3 class="col-sm-5">Kinnita lõputöö teema</h3>
            <div class="form-group col-sm-7">
                <form method="post">
                    <div class="input-group">
                        <select name="data[thesis_name]" data-placeholder="Lõputöö pealkiri" class="chosen-select" tabindex="2">
                            <option value=""></option>
                            <? foreach ($instructors as $instructor): ?>
                                <option value="<?= $instructor['person_id'] ?>"><?= $instructor['person_name'] ?></option>
                            <? endforeach ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-5 control-label" for="thesis_title">Lõputöö teema</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="data[test_name]" id="test_name"
                       placeholder="Siia kirjuta lõputöö teema" value="<?= $test['test_name'] ?>">
            </div>
        </div>
    </div>
    <div class="instructor">
        <div class="row">
            <h3 class="col-sm-5">Kinnita juhendaja nimi</h3>
            <div class="form-group col-sm-7">
                <form method="post">
                    <div class="input-group">
                        <select name="data[thesis_name]" data-placeholder="Juhendaja nimi" class="chosen-select" tabindex="2">
                            <option value=""></option>
                            <? foreach ($instructors as $instructor): ?>
                                <option value="<?= $instructor['person_id'] ?>"><?= $instructor['person_name'] ?></option>
                            <? endforeach ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-5 control-label" for="instructor">Juhendaja nimi ja ettevõte</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="data[person_id_instructor]" id="test_name"
                       placeholder="Siia kirjuta juhendaja kui ei leidnud valikust sobivat" value="<?= $test['test_name'] ?>">
            </div>
        </div>
        <span class="commit_btn">
            <button class="btn btn-primary" type="submit">Kinnita</button>
        </span>
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
<div class="row upload_files">
<h3>Laadi sobivad failid</h3>

    <div class="col-md-6">
        <span class="lead">Laadi üles:</span>
        <div class="pull-right">
            <div class="btn-group btn-group-lg">
                <button type="button" class="btn btn-default" id="thesis-draft">Eelkaitsmine</button>
                <button type="button" class="btn btn-default" id="thesis-final">Lõputöö</button>
                <button type="button" class="btn btn-default">Lisamaterjalid</button>
            </div>
        </div>
        <form id="uploadForm" method="post" enctype="multipart/form-data" style=" display: none">
            <input type="file" name="draft_upload" id="draft_upload" class="file-upload"/>
        </form>

        <?php var_dump($_FILES) ?>
        <script>
            $('#thesis-draft').click(function (event) {
                $('#draft_upload').click();
            });

            //capture selected filename
            $('#draft_upload').change(function (click) {
//  $('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
        <form id="uploadForm" method="post" enctype="multipart/form-data" style=" display: none">
            <input type="file" name="final_upload" id="final_upload" class="file-upload"/>
        </form>
        <script>
            $('#thesis-final').click(function (event) {
                $('#final_upload').click();
            });

            //capture selected filename
            $('#ifinal_upload').change(function (click) {
//  $('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
        <form id="uploadForm" method="post" enctype="multipart/form-data" style=" display: none">
            <input type="file" name="draft_upload" id="draft_upload" class="file-upload"/>
        </form>
        <script>
            $('#thesis-draft').click(function (event) {
                $('#input_upload').click();
            });

            //capture selected filename
            $('#input_upload').change(function (click) {
//  $('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
    </div>
</div>

