<h1><? __('Lõputöö') ?> <i><?= $thesis['thesis_title'] ?></i></h1>
<form id="form" method="post">
    <table class="table table-bordered">
        <tr>
            <td><input type="text" value="<?= $thesis['thesis_title'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['thesis_description'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['thesis_client_info'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['author_name'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['instructor_name'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['thesis_instructor_confirmed_at'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['thesis_title_confirmed_at'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['thesis_defended_at'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['thesis_file_id_draft'] ?>"/></td>
            <td><input type="text" value="<?= $thesis['thesis_file_id_final'] ?>"/></td>
        </tr>
    </table>
</form>
