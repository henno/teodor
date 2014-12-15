<h1><i><?= $thesis['thesis_title'] ?></i></h1>
<form id="form" method="post">
    <p><?= $thesis['thesis_description'] ?></p>
    <h4><?= $thesis['thesis_client_info'] ?></h4>
    <h4><?= $thesis['author_name'] ?></h4>
    <h4><?= $thesis['instructor_name'] ?></h4>
</form>
<? if ($auth->is_admin): ?>
    <form action="thesises/edit/<?= $thesis['thesis_id'] ?>">
        <div class="pull-right">
            <button class="btn btn-primary">
                Muuda
            </button>
        </div>
    </form>
<? endif; ?>
<div class="row upload_files">
    <div class="col-md-6">
        <span class="lead">Laadi üles:</span>
        <div class="pull-right">
            <div class="btn-group btn-group-lg">
                <h3><?= $thesis['thesis_file_id_draft'] ?></h3>
                <button type="button" class="btn btn-default" id="thesis-draft">Eelkaitsmine</button>
                <h3><?= $thesis['thesis_file_id_final'] ?></h3>
                <button type="button" class="btn btn-default" id="thesis-final">Lõputöö</button>
                <button type="button" class="btn btn-default" id="thesis_file_upload">Lisamaterjalid</button>
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
            //$('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
        <form id="uploadForm2" method="post" enctype="multipart/form-data" style=" display: none">
            <input type="file" name="final_upload" id="final_upload" class="file-upload"/>
        </form>
        <script>
            $('#thesis-final').click(function (event) {
                $('#final_upload').click();
            });

            //capture selected filename
            $('#final_upload').change(function (click) {
//  $('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
        <form id="uploadForm3" method="post" enctype="multipart/form-data" style=" display: none">
            <input type="file" name="thesis_file_upload" id="thesis_file_upload" class="file-upload"/>
        </form>
        <script>
            $('#thesis_files').click(function (event) {
                $('#files_upload').click();
            });

            //capture selected filename
            $('#files_upload').change(function (click) {
//  $('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
    </div>
</div>