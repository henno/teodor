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
        <? if ($task['uses_virtual_machines'] && !$task['virtual_machine_id']): ?>
            <button class="btn btn-primary">
                <? __('Loo virtuaalmasin') ?>
            </button>
        <? endif ?>
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
    <? $n = 0;
    foreach ($droplets as $droplet): $n++ ?>
        <tr data-status="<?= $droplet->status ?>"
            data-ip="<?= $droplet->networks[0]->ipAddress ?>"
            data-id="<?= $droplet->id ?>"
            data-name="<?= $droplet->name ?>"
            data-created="<?= $droplet->createdAt ?>"
            class="<?= isset($virtual_machines[$droplet->id]) && ($virtual_machines[$droplet->id]['status'] == 1) ? 'Ready' : 'NotReady' ?>">

            <td><input type="checkbox" class="selection" name="droplets[<?= $droplet->id ?>]"/></td>
            <td><?= $n ?></td>
            <td><?= $droplet->name ?></td>
            <td><a target="_blank"
                   href="http://<?= $droplet->networks[0]->ipAddress ?>"><?= $droplet->networks[0]->ipAddress ?></a>
            </td>
            <td class="runtime">
                <div class="runtime"></div>
                <div class="starttime"><?= $droplet->createdAt ?></div>
            </td>
            <td class="droplet_action" id="da<?= $droplet->id ?>"></td>
            <td class="vert-align"><?= $droplet->status == 'active' ? '<span class="label label-success">aktiivne</span>' : '<span class="label label-danger">' . $droplet->status . '</span>' ?></td>
            <td class="ssl" id="ssl<?= $droplet->networks[0]->ipAddress ?>"></td>
            <td class="screenshot" id="ss<?= $droplet->networks[0]->ipAddress ?>" style="padding:0px;">
                <?= !empty($virtual_machines[$droplet->id]['image_link']) ? '<img src="screenshots/' . $droplet->id . '.jpg"></img>' : '' ?>
            </td>
            <td><input type="checkbox"
                       class="ready-checkboxes"
                       <? if ($virtual_machines[$droplet->id]['owner'] != $user AND $user != 'henno.taht'): ?>disabled="disabled"<? endif ?>
                    <?= isset($virtual_machines[$droplet->id]) && ($virtual_machines[$droplet->id]['status'] == 1) ? 'checked="checked"' : '' ?>/>
            </td>
            <td class="comment comment_student"><?= !empty($virtual_machines[$droplet->id]['comment_student']) ? $virtual_machines[$droplet->id]['comment_student'] : '<span style="color:#adadad"><i>Lisamiseks kliki siia</i></span>' ?></td>
            <td class="comment comment_teacher"><?= isset($virtual_machines[$droplet->id]) ? $virtual_machines[$droplet->id]['comment_teacher'] : '' ?></td>
            <td class="expiry">
                <? if ($virtual_machines[$droplet->id]['status'] != 1): ?>
                    <time class="timeago"
                          datetime="<?= isset($virtual_machines[$droplet->id]) ? $virtual_machines[$droplet->id]['expiry'] : '' ?>"
                          title="<?= $virtual_machines[$droplet->id]['expiry'] ?>"></time>
                    <? if (isset($virtual_machines[$droplet->id]['expiry']) && ($virtual_machines[$droplet->id]['owner'] == $user || $user == 'henno.taht')): ?>
                        <button class="expiry-button" title="Pikenda praegusest 12h">
                            <img src="windup_key.png" width="20px" height="20px" alt="Pikenda 12h"/>
                        </button>
                    <? endif ?>
                <? else: ?>
                    Valmis märgitud droplet ei aegu.
                <? endif ?>
            </td>
            <? if (true): ?>
                <td class="mark">
                    <button <?= $droplet->isReady ? 'disabled="true"' : '' ?>
                        class="mark-button btn btn-default <?= $droplet->isReady ? 'disabled' : '' ?>"
                        name="mark[<?= $droplet->id ?>]" type="submit">
                        Arvesta
                    </button>
                </td>
            <? endif ?>
        </tr>
    <? endforeach ?>
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
            <?= $comment['task_comment_text'] ?> <br/> <a href="#" class="label label-danger" data-toggle="modal"
                                                          data-target="#myModal"><? __('Vasta') ?></a>
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
                            <?= $comment_reply['task_comment_text'] ?> <br/> <a href="#" class="label label-danger"
                                                                                data-toggle="modal"
                                                                                data-target="#myModal"><? __('Vasta') ?></a>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
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
    $('#savecomment').on('click', function () {
        alert('To do: Write some actual code');
        $('#myModal').modal('hide')
    })
</script>
