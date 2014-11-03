<h2><? __('Lõputööd') ?></h2>
<h3>Dokumentatsioon</h3>

<h3>Kinnita lõputöö juhendaja</h3>
<div class="row">
    <div class="col-lg-6">
        <form method="post">
            <div class="input-group">
                <select name="data[person_id_instructor]" data-placeholder="Juhendaja nimi" class="chosen-select" tabindex="2">
                    <option value=""></option>
                    <? foreach ($instructors as $instructor): ?>
                        <option value="<?= $instructor['person_id'] ?>"><?= $instructor['person_name'] ?></option>
                    <? endforeach ?>
                </select>
                <p>Kui ei leidnud sobivat juhendajat kirjuta juhendaja nimi ja ettevõte alljärgnevasse kasti</p>
                <div class="input-group instructor">
                    <input type="text" class="form-control" placeholder="Juhendaja nimi, ettevõte">
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Kinnita</button>
                </span>
            </div>
        </form>
        <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<h3>Kinnita lõputöö teema</h3>
<div class="row">
    <div class="col-lg-6">
        <form method="post">
            <div class="input-group">
                <select name="data[thesis_name]" data-placeholder="Lõputöö pealkiri" class="chosen-select" tabindex="2">
                    <option value=""></option>
                    <? foreach ($instructors as $instructor): ?>
                        <option value="<?= $instructor['person_id'] ?>"><?= $instructor['person_name'] ?></option>
                    <? endforeach ?>
                </select>
                <p>Kui ei leidnud sobivat teemat, kirjuta teema alljärgnevasse kasti</p>
                <div class="input-group thesis_name">
                    <input type="text" class="form-control" placeholder="Lõputöö pealkiri">
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Kinnita</button>
                </span>
            </div>
        </form>
        <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<h3>Laadi sobivad failid</h3>
<div class="row">
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

