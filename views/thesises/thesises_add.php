<form role="form" class="form-horizontal" method="post" action="thesises/<?= $thesis['thesis_title'] ?>">
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label" for="formGroupInputLarge">Sisesta lõputöö pealkiri</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="formGroupInputLarge" name="thesis[thesis_title]" placeholder="Sisesta lõputöö pealkiri">
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        <textarea class="form-control" rows="5" placeholder="Valitud teema lühikirjeldus" name="thesis[thesis_description]"></textarea>
    </div>
    <label class="col-sm-2 control-label" for="formGroupInputLarge" >Tellija</label>
    <div class="col-sm-5">
        <input class="form-control" type="text" id="formGroupInputLarge" placeholder="Tellija nimi" name="thesis[thesis_client_info]">
    </div>
    <div class="pull-right">
        <button class="btn btn-primary" id="thesis_title">Salvesta
        </button>
    </div>
</form>
<div class="row upload_files">
    <h3>Laadi sobivad failid</h3>

    <div class="col-md-6">
        <span class="lead">Laadi üles:</span>
        <div class="pull-right">
            <div class="btn-group btn-group-lg">
                <button type="button" class="btn btn-default" id="thesis-draft">Eelkaitsmine</button>
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
            $('#final_upload').change(function (click) {
//  $('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
        <form id="uploadForm" method="post" enctype="multipart/form-data" style=" display: none">
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
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    $(function() {
        $(".chosen-select").chosen({width: "100%"});
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
    });
</script>