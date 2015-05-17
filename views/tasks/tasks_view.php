<h1>
    <?= $task['task_name'] ?>
    <span
        class="label label-<?= $task['task_status_id'] == 1 ? 'danger' : 'success' ?> pull-right"><?= $task['task_status_name'] ?>
    </span>
</h1>
<div class="row">
    <div class="col-sm-5 col-md-3">
        <table class="table table-bordered">
            <tr>
                <th><? __('Tähtaeg') ?></th>
                <td><?= $task['task_due'] ?></td>
            </tr>
            <tr>
                <th><? __('Aeg') ?></th>
                <td><?= $task['task_time_required'] ?> min</td>
            </tr>
            <tr>
                <th><? __('Loodud') ?></th>
                <td><?= $task['task_date_added'] ?></td>
            </tr>
            <tr>
                <th><? __('Looja') ?></th>
                <td><?= $task['person_lastname'] ?></td>
            </tr>
        </table>
    </div>
    <div class="col-sm-7 col-md-9">
        <p><?= $task['task_text'] ?></p>
        <button class="btn btn-primary">
            <? __('Loo virtuaalmasin') ?>
        </button>
    </div>
</div>

<h3><? __('Virtuaalmasina andmed') ?></h3>
<table class="table table-bordered" style="width: auto;">
    <tbody>
    <tr>
        <th>IP Aadress</th>
        <th>Tunnid</th>
        <th>Viimane toiming</th>
        <th>Staatus</th>
        <th>SSL</th>
        <th>Ekraanipilt</th>
        <th title="Märgi ära, kui oled ülesande valmis saanud">Valmis?</th>
        <th>Aegub</th>
    </tr>

    <tr data-status="active" data-ip="178.62.224.61" data-id="4678950" data-name="is114-jurgennarits-cacti"
        data-created="2015-04-01T09:05:18Z" class="Ready">

        <td><a target="_blank" href="http://178.62.224.61">178.62.224.61</a>
        </td>
        <td class="runtime">
            <div class="runtime"></div>
            <div class="starttime">30</div>
        </td>
        <td class="droplet_action" id="da4678950"></td>
        <td class="vert-align"><span class="label label-success">aktiivne</span></td>
        <td class="ssl" id="ssl178.62.224.61"><span class="label label-danger">Ei</span></td>
        <td class="screenshot" id="ss178.62.224.61" style="padding:0px;">
        </td>
        <td><input type="checkbox" class="ready-checkboxes" checked="checked">
        </td>
        <td class="expiry">
            <time class="timeago" datetime="2015-04-02 21:37:35" title="2015-04-02 21:37:35">umbes 4 tundi praegusest
            </time>
        </td>
    </tr>
    </tbody>
</table>
<h3><? __('Küsimused ja vastused') ?></h3>

<? $n = 0;
foreach ($comments as $comment): $n++ ?>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>

        <div class="media-body">
            <h4 class="media-heading"><?= $comment['person_lastname'] ?>
                <small><?= $comment['task_comment_date_created'] ?></small>
            </h4>
            <?= $comment['task_comment_text'] ?> <br/> <a href="#" class="label label-danger" data-toggle="modal" data-target="#myModal"><? __('Vasta') ?></a>
            <? if (!empty($comment['replies'])): ?>
                <? foreach ($comment['replies'] as $comment_reply): $n++ ?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>

                        <div class="media-body">
                            <h4 class="media-heading"><?= $comment_reply['person_lastname'] ?>
                                <small><?= $comment_reply['task_comment_date_created'] ?></small>
                            </h4>
                            <?= $comment_reply['task_comment_text'] ?> <br/> <a href="#" class="label label-danger"  data-toggle="modal" data-target="#myModal"><? __('Vasta') ?></a>
                        </div>
                    </div>
                <? endforeach ?>
            <? endif ?>
            <!-- End Nested Comment -->
        </div>
    </div>
<? endforeach ?>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><? __('Vastuse jätmine') ?></h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><? __('Sulge') ?></button>
                <button type="button" class="btn btn-primary" id="savecomment"><? __('Sisesta') ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#savecomment').on('click',function(){
        alert('To do: Write some actual code');
        $('#myModal').modal('hide')
    })
</script>