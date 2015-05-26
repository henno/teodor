<h1><i><?= $thesis['thesis_title'] ?></i></h1>

<dl class="dl-horizontal">
    <dt>Lõputöö kirjeldus:</dt>
    <dd><?= $thesis['thesis_description'] ?></dd>
    <dt>Lõputöö tellija:</dt>
    <dd><?= $thesis['thesis_client_info'] ?></dd>
    <dt>Lõputöö autor:</dt>
    <dd><?= $thesis['author_first_name'] . " " . $thesis['author_last_name'] ?></dd>
    <dt>Juhendaja:</dt>
    <dd><?= $thesis['instructor_name'] ?></dd>
    <dt>Staatus:</dt>
    <dd><?php

        if ($thesis['thesis_title_confirmed_at'] != NULL && $thesis['thesis_defended_at'] == NULL) {
            echo "Kinnitatud";
        } elseif ($thesis['thesis_defended_at'] != NULL) {
            echo "Kaitstud";
        } elseif ($thesis['person_id_author'] != NULL && $thesis['instructor_id'] != NULL) {
            echo "Kinnitamisel";
        } else {
            echo "Lõputöö pakkumine";
        }
        ?> </dd>
</dl>

<? if ($thesis['thesis_title_confirmed_at'] == NULL && $thesis['person_id_author'] == NULL): ?>
    <h3>Vali juhendaja:</h3>
    <form role="form" class="form-horizontal" method="post"
          action="thesises/confirmation_request/<?= $thesis['thesis_id'] ?>">
        <div class="col-sm-12">
            <select id="instructor_id" name="instructor_select" class="chosen-select">
                <? foreach ($instructors as $instructor): ?>
                    <option
                        value="<?= $instructor['instructor_id'] ?>" <?= $instructor['instructor_name'] == $instructor['instructor_name'] ? 'selected="selected"' : '' ?>><?= $instructor['instructor_name'] . " (" . $instructor['instructor_company'] . ")" ?></option>
                <? endforeach ?>
            </select> <span class="glyphicon glyphicon-plus" style="cursor:pointer" data-toggle="modal"
                            data-target="#myModal"></span> Lisa juhendaja, kui teda rippmenüüst ei leidnud!
        </div>

        <div class="pull-right">
            <button class="btn btn-primary">
                Soovin teostada
            </button>
        </div>
    </form>
<? endif; ?>
<? if ($thesis['person_id_author']!= NULL && $thesis['person_id_author'] != $this->auth->person_id && $thesis['thesis_title_confirmed_at'] == NULL): ?>
<form action="thesises/join_as_coauthor/<?= $thesis['thesis_id'] ?>">
    <div class="pull-right">
        <button class="btn btn-primary">
            Soovin liituda
        </button>
    </div>
</form>
<? endif; ?>
<? if ($auth->is_admin && $thesis['thesis_title_confirmed_at'] != NULL): ?>
<form action="thesises/defended/<?= $thesis['thesis_id'] ?>">
    <div class="pull-right">
        <button class="btn btn-primary">
            Kaitstud
        </button>
    </div>
</form>
<? endif; ?>
<? if ($auth->is_admin && $thesis['thesis_defended_at'] == NULL): ?>
    <form action="thesises/edit/<?= $thesis['thesis_id'] ?>">
        <div class="pull-right">
            <button class="btn btn-primary">
                Muuda
            </button>
        </div>
    </form>
    <? endif; ?>
    <? if ($auth->is_admin && $thesis['person_id_author'] != NULL && $thesis['thesis_title_confirmed_at'] == NULL): ?>
        <form action="thesises/confirm/<?= $thesis['thesis_id'] ?>">
            <div class="pull-right">
                <button class="btn btn-primary">
                    Kinnita
                </button>
            </div>
        </form>
    <? endif; ?>


<? if ($thesis['thesis_title_confirmed_at'] != NULL && $thesis['person_id_author']== $this->auth->person_id && $thesis['thesis_defended_at'] == NULL): ?>
    <div class="row upload_files">
        <div class="col-md-6">
            <span class="lead">Laadi üles:</span>
            <div class=" hnvh">
                <div class="btn-group btn-group-lg">
                    <button type="button" class="btn btn-default" id="thesis-draft">Eelkaitsmine</button>
                    <button type="button" class="btn btn-default" id="thesis-final">Lõputöö</button>
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

<? endif; ?>


<? if ($thesis['thesis_title_confirmed_at'] != NULL && $auth->is_admin || $thesis['thesis_title_confirmed_at'] != NULL && $can_view_uploaded_files || $thesis['thesis_title_confirmed_at'] != NULL && $thesis['person_id_author']== $this->auth->person_id || $thesis['thesis_title_confirmed_at'] != NULL && $thesis['person_id_author']== $this->auth->person_id || $thesis['thesis_defended_at'] != NULL ):?>
<h2>Üleslaaditud failid</h2>
<table class="table table-bordered">
    <? foreach ($files as $file): ?>
        <tr>
            <td>
                <a href="<?= BASE_URL ?>thesises/file/<?= $file['thesis_file_id'] ?>"><?= $file['thesis_file_name'] ?></a>
            </td>
             
            <td><?= $file['thesis_file_uploaded_at'] ?></td>
        </tr>
    <? endforeach ?>
</table>

<? endif; ?>

<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
    $(function () {
        // Initialize dropdown for adding thesis instructors
        $(".chosen-select").chosen();
        $('.chosen-select-deselect').chosen({allow_single_deselect: true});

    });


    $('#savecomment').on('click', function () {
        $('#myModal').modal('hide');

    });


    // ajax action to adding instructor popup
    function add_instructor() {
        $.get("thesises/add_instructor", {
            instructor_name: $('.instructor_name').val(),
            instructor_company: $('.instructor_company').val()
        }, function (data) {
            if (data == 'Ok') {
                window.location.replace(window.location.pathname);
            } else {
                alert('Fail');
                console.log(data);
            }
        }); }
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Juhendaja lisamine</h4>
            </div>
            <div class="modal-body">
                <form role="form" name="ajaxform" id="ajaxform" class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="formGroupInputLarge">Juhendaja nimi:</label>

                        <div class="col-sm-10">
                            <input class="instructor_name form-control" name="instructor_name" type="text" id="formGroupInputLarge" placeholder="nimi">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="formGroupInputLarge">Ettevõte:</label>

                        <div class="col-sm-10">
                            <input class="instructor_company form-control" name="instructor_company" type="text" id="formGroupInputLarge" placeholder="ettevõte">
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Sulge</button>
                <button type="submit" class="btn btn-primary" onclick="add_instructor()" id="savecomment">Sisesta</button>
            </div>
        </div>
    </div>
</div>