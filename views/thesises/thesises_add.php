<h1><? __('Lõputöö sisestamine') ?></h1>
<form role="form" class="form-horizontal" method="post">
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label" for="formGroupInputLarge">Sisesta lõputöö pealkiri</label>

        <div class="col-sm-10">
            <input class="form-control" type="text" id="formGroupInputLarge" name="thesis[thesis_title]"
                   placeholder="Sisesta lõputöö pealkiri">
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        <textarea class="form-control" rows="5" placeholder="Valitud teema lühikirjeldus"
                  name="thesis[thesis_description]"></textarea>
    </div>
    <label class="col-sm-2 control-label" for="formGroupInputLarge">Tellija</label>

    <div class="col-sm-10">
        <input class="form-control" type="text" id="formGroupInputLarge" placeholder="Tellija nimi"
               name="thesis[thesis_client_info]">
    </div>

    <label class="col-sm-2 control-label" for="formGroupInputLarge">Juhendaja ja ettevõte</label>

    <div class="col-sm-10">
        <select id="instructor_id" name="instructor_select" class="chosen-select">
            <? foreach ($instructors as $instructor): ?>
                <option
                    value="<?= $instructor['instructor_id'] ?>" <?= $instructor['instructor_name'] == $instructor['instructor_name'] ? 'selected="selected"' : '' ?>><?= $instructor['instructor_name']. " (" . $instructor['instructor_company'] . ")" ?></option>
            <? endforeach ?>
        </select> <span class="glyphicon glyphicon-plus" style="cursor:pointer" data-toggle="modal"
                        data-target="#myModal"></span>
    </div>

    <label class="col-sm-2 control-label" for="formGroupInputLarge">Lõputöö idee:</label>

    <div class="col-sm-10">
        <input class=" pull-left" name="thesis_idea" type="checkbox" value="1"/>
    </div>

    <div class="pull-right">
        <button class="btn btn-primary" id="thesis_title">Salvesta
        </button>
        <button class="btn btn-primary">Saada
        </button>
    </div>
</form>


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

<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    $('#savecomment').on('click', function () {
        $('#myModal').modal('hide');

    });


    $(function () {
        // Initialize dropdown for adding thesis instructors
        $(".chosen-select").chosen();
        $('.chosen-select-deselect').chosen({allow_single_deselect: true});

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