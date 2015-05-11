<h1><i><?= $thesis['thesis_title'] ?></i></h1>

<dl class="dl-horizontal">
    <dt>Lõputöö kirjeldus:</dt>
    <dd><?= $thesis['thesis_description'] ?></dd>
    <dt>Lõputöö tellija:</dt>
    <dd><?= $thesis['thesis_client_info'] ?></dd>
    <dt>Lõputöö autor:</dt>
    <dd>
        <select multiple style="width: 300px">
            <? foreach ($thesis['thesis_authors'] as $author): ?>
                <option value=""><?= $author['person_name'] ?></option>
            <? endforeach ?>
        </select>
    </dd>
    <dt>Juhendaja:</dt>
    <dd><?= $thesis['instructor_name'] ?></dd>
</dl>



<? if ($auth->is_admin): ?>
    <form action="thesises/edit/<?= $thesis['thesis_id'] ?>">
        <div class="pull-right">
            <button class="btn btn-primary">
                Muuda
            </button>
        </div>
    </form>
    <? if (!$thesis['thesis_title_confirmed_at']): ?>
        <form action="thesises/confirm/<?= $thesis['thesis_id'] ?>">
            <div class="pull-right">
                <button class="btn btn-primary">
                    Kinnita
                </button>
            </div>
        </form>
    <? endif; ?>
<? else: ?>
    <form action="thesises/confirmation_request/<?= $thesis['thesis_id'] ?>">
        <div class="pull-right">
            <button class="btn btn-primary">
                Soovin liituda
            </button>
        </div>
        <div class="pull-right">
            <button class="btn btn-primary">
                Soovin teostada
            </button>
        </div>
    </form>
<? endif; ?>
<div class="row upload_files">
    <div class="col-md-6">
        <span class="lead">Laadi üles:</span>

        <div class=" hnvh">
            <div class="btn-group btn-group-lg">
                <button type="button" class="btn btn-default" id="thesis-draft">Eelkaitsmine</button>
                <button type="button" class="btn btn-default" id="thesis-final">Lõputöö</button>
                <button type="button" class="btn btn-default" id="thesis_file_upload">Lisamaterjalid</button>
            </div>
        </div>
        <form id="uploadForm" method="post" enctype="multipart/form-data" style=" display: none">
            <input type="file" name="draft_upload" id="draft_upload" class="file-upload"/>
        </form>


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

<h2>Üleslaaditud failid</h2>
<table class="table table-bordered">

    <? foreach ($files as $file): ?>
        <tr>
            <td>
                <a href="<?= BASE_URL ?>thesises/file/<?= $file['thesis_file_id'] ?>"><?= $file['thesis_file_name'] ?></a>
            </td>
             
            <td><?= $file['thesis_file_size'] ?></td>
        </tr>
    <? endforeach ?>
</table>
<script type="text/javascript">
    $(document).ready(function () {
        $('select').select2({
            tags: true
        });
    });
</script>