<h1><? __('Lõputöö muutmine') ?></h1>



<form id="form" method="post">

    <p><textarea rows="2" cols="50" name="thesis[thesis_title]"><?= $thesis['thesis_title'] ?></textarea>
    <p><textarea rows="4" cols="50" name="thesis[thesis_description]"><?= $thesis['thesis_description'] ?></textarea>
    <p><textarea rows="2" cols="50" name="thesis[thesis_client_info]"><?= $thesis['thesis_client_info'] ?></textarea>
    <p><div class="control-group"><select  id="select-repo" class="repositories" multiple="multiple">
            <? foreach ($thesis_authors as $thesis_author): ?>
                <option
                    value="<?= $thesis_author['person_id'] ?>" <?= $thesis_author['person_firstname'] == $thesis_author['person_firstname'] ? 'selected="selected"' : '' ?>><?= $thesis_author['person_firstname'] . " " . $thesis_author['person_lastname'] ?></option>
            <? endforeach ?>
        </select></div>
    <p><textarea rows="2" cols="50" name="thesis[instructor_id]"><?= $thesis['instructor_name'] ?></textarea>
</form>

<!-- BUTTONS -->


<!-- CANCEL -->
<div class="pull-right">
    <button class="btn btn-default"
            onclick="window.location.href = 'thesises/view/<?= $thesis['thesis_id'] ?>/<?= $thesis['thesis_title'] ?>'">
        Tühista
    </button>
</div>
<!-- DELETE
    <button class="btn btn-danger" onclick="delete_thesises(<?= $thesis['thesis_id'] ?>)">
        Kustuta
    </button>
-->
<div class="pull-right">
    <form action="thesises/delete_thesis/<?= $thesis['thesis_id'] ?>">
        <button class="btn btn-danger">
            Kustuta
        </button>
    </form>
</div>
<!-- SAVE -->
<div class="pull-right">
    <button class="btn btn-primary" id="form" onclick="save()">
        Salvesta
    </button>
</div>


<!-- END BUTTONS -->
<script src="assets/components/selectize/0.12.1/js/standalone/selectize.min.js"></script>
<link rel="stylesheet" href="assets/components/selectize/0.12.1/css/selectize.bootstrap3.css"/>

<script>
    function save() {
        
        $.post('<?=BASE_URL. "thesises/edit/$params[0]"?>', $("#form").serialize());
    };


    $('#select-repo').selectize({
        valueField: 'person_id',
        labelField: 'person_name',
        searchField: 'person_name',
        options: [],
        create: false,
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '<?= BASE_URL ?>thesises/autocomplete/' + encodeURIComponent(query),
                type: 'GET',
                error: function() {
                    callback();
                },
                success: function() {
                    callback(res.repositories.slice(0, 10));
                }
            });
        }
    });



</script>