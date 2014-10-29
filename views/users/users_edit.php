<? if( !$auth->is_admin ):?>
    <div class="alert alert-danger fade in">
        <button class="close" data-dismiss="alert">×</button>
        You are not an administrator.
    </div>
<? exit(); endif; ?>
<h1>User '<?= $user['person_name'] ?>'</h1>
<form id="form" method="post">
    <table class="table table-bordered">
        <tr>
            <th>Username</th>
            <td><input type="text" name="data[person_name]" value="<?= $user['person_name'] ?>"/></td>
        </tr>
        <tr>
            <th>Password</th>
            <td><input type="text" name="data[password]" value="<?= $user['password'] ?>"/></td>
        </tr>
        <tr>
            <th>Active</th>
            <td><input type="checkbox" name="data[active]" <?= $user['active'] != 0 ? 'checked="checked"' : '' ?>/>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="text" name="data[email]" value="<?= $user['email'] ?>">
        </tr>
    </table>
</form>

<!-- BUTTONS -->
<div class="pull-right">

    <!-- CANCEL -->
    <button class="btn btn-default" onclick="window.location.href = 'users/view/<?= $user['person_id'] ?>/<?= $user['person_name'] ?>'">
        Cancel
    </button>

    <!-- DELETE -->
    <button class="btn btn-danger" onclick="delete_user(<?=$user['person_id']?>)">
        Delete
    </button>

    <!-- SAVE -->
    <button class="btn btn-primary" onclick="$('#form').submit()">
        Save
    </button>

</div>
<!-- END BUTTONS -->

<script>
    function delete_user(person_id){
        $.post("users/delete", {user_id: <?=$user['person_id']?>}, function (data) {
            if(data == '1'){
                window.location.href = 'users';
            }else{
                alert('Fail');
            }
        });
    }
</script>