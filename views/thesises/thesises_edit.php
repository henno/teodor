<h1><i><input type="text" name="thesis[thesis_title]" value="<?= $thesis['thesis_title'] ?>"/></i></h1>
<form id="form" method="post">
    <p><textarea name="thesis[thesis_description]"><?= $thesis['thesis_description'] ?></textarea></p>
    <h4><input type="text" name="thesis[thesis_client_info]" value="<?= $thesis['thesis_client_info'] ?>"/></h4>
    <h4><input type="text" name="thesis[author_name]" value="<?= $thesis['author_name'] ?>"/></h4>
    <h4><input type="text" name="thesis[instructor_name]" value="<?= $thesis['instructor_name'] ?>"/></h4>
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