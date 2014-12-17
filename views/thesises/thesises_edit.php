<h1><i><textarea name="thesis[thesis_title]"> <?= $thesis['thesis_title'] ?></textarea></i></h1>
<form id="form" method="post">
    <p><textarea name="thesis[thesis_description]"><?= $thesis['thesis_description'] ?></textarea></p>
    <h4><textarea name="thesis[thesis_client_info]"><?= $thesis['thesis_client_info'] ?></textarea></h4>
    <h4><textarea name="thesis[author_name]" ><?= $thesis['author_name'] ?></textarea></h4>
    <h4><textarea name="thesis[instructor_name]"> <?= $thesis['instructor_name'] ?></textarea></h4>
</form>

<!-- BUTTONS -->
<div class="pull-right">

    <!-- CANCEL -->
    <button class="btn btn-default"
            onclick="window.location.href = 'thesises/view/<?= $thesis['thesis_id'] ?>/<?= $thesis['thesis_title'] ?>'">
        Cancel
    </button>

    <!-- DELETE -->
    <button class="btn btn-danger" onclick="delete_thesises(<?= $thesis['thesis_id'] ?>)">
        Delete
    </button>

    <!-- SAVE -->
    <button class="btn btn-primary" onclick="save()">
        Save
    </button>

</div>
<!-- END BUTTONS -->
<script>
    function save() {


        $.post('<?=BASE_URL. "thesises/edit/$params[0]"?>', $("#form").serialize());
    }
</script>