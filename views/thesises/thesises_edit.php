<h1><? __('Lõputöö muutmine') ?></h1>


<form role="form" id="form" class="form-horizontal" method="post">
    <div class="form-group">
        <label for="thesis[thesis_title]">Lõputöö teema:</label>
    <textarea class="form-control" rows="2" name="thesis[thesis_title]"><?= $thesis['thesis_title'] ?></textarea>
    </div>
        <div class="form-group">
            <label for="thesis[thesis_description]">Lõputöö kirjeldus:</label>
    <textarea class="form-control" rows="4" name="thesis[thesis_description]"><?= $thesis['thesis_description'] ?></textarea>
        </div>
            <div class="form-group">
                <label for="thesis[thesis_client_info]">Lõputöö klient:</label>
    <textarea class="form-control" rows="2" name="thesis[thesis_client_info]"><?= $thesis['thesis_client_info'] ?></textarea>
            </div>
    <div class="form-group">
    <label for="thesis_authors[]">Lõputöö autor:</label>
    <select id="select-authors" name="thesis_authors[]"  multiple="multiple">
            <? foreach ($thesis_authors as $thesis_author): ?>
                <option
                    value="<?= $thesis_author['person_id'] ?>" <?= $thesis_author['person_firstname'] == $thesis_author['person_firstname'] ? 'selected="selected"' : '' ?>><?= $thesis_author['person_firstname'] . " " . $thesis_author['person_lastname'] ?></option>
            <? endforeach ?>
        </select></div>
    <div class="form-group">
        <label for="thesis[instructor_id]">Lõputöö juhendaja:</label>
    <select id="select-instructor" name="thesis[instructor_id]">
                <option
                    value="<?= $thesis['instructor_id'] ?>" <?= $thesis['instructor_name'] == $thesis['instructor_name'] ? 'selected="selected"' : '' ?>><?= $thesis['instructor_name'] ?></option>
        </select></div>
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

        $.post('<?=BASE_URL. "thesises/edit/$params[0]"?>',
            $("#form").serialize(),
            function (data) {
                if (data != 'Ok') {
                    alert('Fail');
                    console.log(data);
                }
            })
    };

    $('#select-authors').selectize({
        valueField: 'person_id',
        labelField: 'person_name',
        searchField: 'person_name',
        options: [],
        create: false,
        load: function (query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '<?= BASE_URL ?>thesises/autocomplete/' + encodeURIComponent(query),
                type: 'GET',
                error: function () {
                    callback();
                },
                success: function (res) {
                    callback(res);
                }
            });
        }
    });

    $('#select-instructor').selectize({
        valueField: 'instructor_id',
        labelField: 'instructor_name',
        searchField: 'instructor_name',
        options: [],
        create: false,
        load: function (query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '<?= BASE_URL ?>thesises/autocomplete_instructors/' + encodeURIComponent(query),
                type: 'GET',
                error: function () {
                    callback();
                },
                success: function (res) {
                    callback(res);
                }
            });
        }
    });

</script>