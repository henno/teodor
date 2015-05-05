<table class="table table-bordered" style="width: auto;">
    <tbody>
        <tr>
            <th><input type="checkbox" id="select-all-droplets"></th>
            <th>#</th>
            <th>Nimetus</th>
            <th>IP Aadress</th>
            <th>Tunnid</th>
            <th>Viimane toiming</th>
            <th>Staatus</th>
            <th>SSL</th>
            <th>Ekraanipilt</th>
            <th title="Märgi ära, kui oled ülesande valmis saanud">Valmis?</th>
            <th>Õpilase kommentaar</th>
            <th>Õpetaja kommentaar</th>
            <th>Aegub</th>
        </tr>

    <? foreach ($tasks as $task): ?>
        <tr data-status="active" data-ip="178.62.224.61" data-id="4678950" data-name="is114-jurgennarits-cacti"
            data-created="2015-04-01T09:05:18Z" class="Ready">

            <td><input type="checkbox" class="selection" name="droplets[4678950]"></td>
            <td><?= $n++ ?>.</td>
            <td><?= $task['task_name'] ?></td>
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
            <td class="comment comment_student">Lisamiseks kliki siia</td>
            <td class="comment comment_teacher"></td>
            <td class="expiry">
                <time class="timeago" datetime="2015-04-02 21:37:35" title="2015-04-02 21:37:35">umbes 4 tundi praegusest
                </time>
            </td>
        </tr>
    <? endforeach ?>

    </tbody>
</table>