<h1><? __('Kursus') ?> <?= $course['subject_name'] ?> <? __('grupile') ?> <?= $course['group_name'] ?></h1>
<h4><strong><? __('Õpetaja') ?>:</strong><?= $course['person_firstname'] . ' ' . $course['person_lastname'] ?></h4>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tasks" aria-controls="home" role="tab"
                                                  data-toggle="tab"><? __('Ülesanded') ?></a></li>
        <li role="presentation"><a href="#absense" aria-controls="profile" role="tab"
                                   data-toggle="tab"><? __('Puudumised') ?></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tasks">
            <table class="table table-bordered" style="margin-top: 40px;">
                <thead>
                <tr>
                    <td><b>#</b></td>
                    <td><b><? __('Ülesanne') ?></b></td>
                    <td><b><? __('Tähtaeg') ?></b></td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><a href="tasks/"><?= $task['task_name'] ?></a></td>
                        <td>22.06.2014</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="absense">
            <table class="table table-bordered" style="margin-top: 40px;">
                <theader>
                    <tr>
                        <td><b><? __('Kuupäev') ?></b></td>
                        <td><b><? __('Õpilane') ?></b></td>
                        <td><b><? __('Tunde') ?></b></td>
                        <td><b><? __('Osavõtt') ?></b></td>
                        <td><b><? __('Põhjus') ?></b></td>
                    </tr>
                </theader>
                <tbody>
                <td>01.04.2015</td>
                <td>Juhan Juhanson</td>
                <td>4</td>
                <td>-</td>
                <td>Haige</td>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script>
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>