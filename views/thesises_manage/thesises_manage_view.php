<div class="row">

    <div class="col-md-3 col-sm-6">
        <div class="btn-group-vertical" role="group" aria-label="...">
            <? foreach ($departments as $department): ?>
                <button type="button" class="btn btn-default"><?= $department['department_name'] ?></button>
            <? endforeach ?>
        </div>
    </div>
    <div class="col-md-9 col-sm-6" style="border:1px solid red">
        <h1><?= $selected_department['department_name'] ?></h1>
        <table class="table table-bordered">
            <tr>
                <th></th>
                <th>#</th>
                <th style="width:100%">Nimi</th>
                <th></th>
            </tr>
            <? $n = 0;
            foreach ($admins as $admin): $n++ ?>
                <tr data-id="<?= $admin['person_id'] ?>">
                    <td><input type="checkbox"/></td>
                    <td><?= $n ?>.</td>
                    <td><?= $admin['person_name'] ?></td>
                    <td><span style="cursor:pointer"  class="glyphicon glyphicon-remove"></span></td>
                </tr>
            <? endforeach ?>
        </table>
        <h3><?__('Lisa uus administraator')?></h3>
        <select id="person_id" name="person[person_id]" class="chosen-select">
            <? foreach ($persons as $person): ?>
                <option
                    value="<?= $person['person_id'] ?>" <?= $person['person_name'] == $person['person_name'] ? 'selected="selected"' : '' ?>><?= $person['person_name'] ?></option>
            <? endforeach ?>
        </select><input class="btn btn-default" onclick="add_admin()" type="button" value="Lisa">
    </div>
</div>


<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    $(function () {
        $(".chosen-select").chosen();
        $('.chosen-select-deselect').chosen({allow_single_deselect: true});


        $(".glyphicon-remove").click(function (){
            var person_id=$(this).parents('tr').data('id');
            console.log(person_id);
            $.get("thesises/manage/delete_admin", {person_id: person_id,department_id: <?=$selected_department['department_id']?>}, function (data) {
                if(data == 'Ok'){
                    window.location.replace(window.location.pathname);
                }else{
                    alert('Fail');
                    console.log(data);
                }
            });
        })

    });


    function add_admin(){
        $.get("thesises/manage/add_admin", {person_id: $('#person_id').val(),department_id: <?=$selected_department['department_id']?>}, function (data) {
            if(data == 'Ok'){
                window.location.replace(window.location.pathname);
            }else{
                alert('Fail');
                console.log(data);
            }
        });

    }
</script>


