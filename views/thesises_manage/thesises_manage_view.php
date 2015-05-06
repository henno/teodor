<div class="row">


    <div class="col-md-3 col-sm-6">
        <div class="btn-group-vertical" role="group" aria-label="...">
            <? foreach ($departments as $department): ?>
                <a class="btn btn-default" href="thesises/manage/view/<?=$department['department_id']?>"><?=$department['department_name']?></a>
            <? endforeach ?>
        </div>
    </div>
    <div class="col-md-9 col-sm-6">
        <h1><?= $selected_department['department_name'] ?></h1>
        <table id="tblAdmins" class="table table-bordered">
            <tr>
                <th><input type="checkbox" id="select-all-admins"/></th>
                <th>#</th>
                <th style="width:100%">Nimi</th>
                <th></th>
            </tr>
            <form class="selection" action="thesises" method="post">
                <? $n = 0;
                foreach ($admins as $admin): $n++ ?>
                    <tr data-id="<?= $admin['person_id'] ?>">
                        <td><input class="selection" name="admins[]" value="<?= $admin['person_id'] ?>"
                                   type="checkbox"/></td>
                        <td><?= $n ?>.</td>
                        <td><?= $admin['person_name'] ?></td>
                        <td><span style="cursor:pointer" class="glyphicon glyphicon-remove"></span></td>
                    </tr>
                <? endforeach ?></form>
        </table>
        <img
            src="http://diarainfra.com/pma/themes/pmahomme/img/arrow_ltr.png"
            alt=""/>
        <button id="btnDeleteAll" type="button" class="batch btn btn-default pull-right">Kustuta korraga</button>
        <h3><? __('Lisa uus administraator') ?></h3>
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
        // Initialize dropdown for adding new admins
        $(".chosen-select").chosen();
        $('.chosen-select-deselect').chosen({allow_single_deselect: true});

        // Initialize checkboxes
        $('#select-all-admins').click(function () {
            $('input.selection').prop('checked', this.checked);
        });

        $("#btnDeleteAll").click(function () {
            var person_id = [];
            $('#tblAdmins').find('td input').each(function () {
                console.log(this.checked);
                if (this.checked) {
                    person_id.push($(this).parents('tr').data('id'))
                }
            });
            console.log(person_id);
            if (confirm("Oled kindel, et soovid valitud administraatorid kustutada?") === true) {
                $.get("thesises/manage/delete_admin", {
                    person_id: person_id,
                    department_id: <?=$selected_department['department_id']?>
                }, function (data) {
                    if (data == 'Ok') {
                        window.location.replace(window.location.pathname);
                    } else {
                        alert('Fail');
                        console.log(data);
                    }
                });
            }
        });

        // Bind function to admin removal icons
        $(".glyphicon-remove").click(function () {
            var person_id = $(this).parents('tr').data('id');
            console.log(person_id);
            $.get("thesises/manage/delete_admin", {
                person_id: person_id,
                department_id: <?=$selected_department['department_id']?>
            }, function (data) {
                if (data == 'Ok') {
                    window.location.replace(window.location.pathname);
                } else {
                    alert('Fail');
                    console.log(data);
                }
            });
        })

    });

    // Adds selected admin to current department
    function add_admin() {
        $.get("thesises/manage/add_admin", {
            person_id: $('#person_id').val(),
            department_id: <?=$selected_department['department_id']?>
        }, function (data) {
            if (data == 'Ok') {
                window.location.replace(window.location.pathname);
            } else {
                alert('Fail');
                console.log(data);
            }
        });

    }


</script>


