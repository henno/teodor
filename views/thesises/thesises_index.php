<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li role="presentation" class="active"><a href="#thesises_index" aria-controls="thesises_index" role="tab"
                                                  data-toggle="tab">Väljapakutud
                ideed</a></li>
        <li role="presentation"><a href="#thesises_approval" aria-controls="thesises_approval" role="tab"
                                   data-toggle="tab">Kinnitamisel</a>
        </li>
        <li role="presentation"><a href="#thesises_in_progress" aria-controls="thesises_in_progress" role="tab"
                                   data-toggle="tab">Teostamisel</a></li>
        <li role="presentation"><a href="#thesises_archive" aria-controls="thesises_archive" role="tab"
                                   data-toggle="tab">Eelnevate
                aastate lõputööd</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="thesises_index"><? if (empty($thesises)): ?>
                <div class="alert alert-info"><? __('Hetkel lõputööde andmebaas on tühi.') ?></div>
            <? else: ?>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-9">Teema</th>
                    <th class="col-md-2">Tegevused</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($thesises as $thesis): ?>
                    <tr>
                        <td><?= $thesis['thesis_id'] ?></td>
                        <td><?= $thesis['thesis_title'] ?>  </td>
                        <td><a href="thesises/view/<?= $thesis['thesis_id'] ?>/<?= $thesis['thesis_title'] ?>"
                               class="btn btn-default" role="button">Vaatan lähemalt</a></td>
                    </tr>
                <? endforeach ?>
                <tbody>
                <? endif ?>
            </table>
            <?php if ($auth->is_admin): ?>

                <div class="pull-left">
                    <button class="btn btn-primary" onclick="window.location.href = 'thesises/add'">
                        Sisesta uus
                    </button>
                </div>
            <?php endif; ?></div>
        <div role="tabpanel" class="tab-pane" id="thesises_approval">
            <td><?= $thesis['thesis_title_confirmed_at'] ?></td>
            <td><?= $thesis['thesis_instructor_confirmed_at'] ?></td>
        </div>
        <div role="tabpanel" class="tab-pane" id="thesises_in_progress">
            <td><?= $thesis['thesis_defended_at'] ?></td>
        </div>
        <div role="tabpanel" class="tab-pane" id="thesises_archive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-5">Teema</th>
                    <th class="col-md-3">Eriala</th>
                    <th class="col-md-3">Osakond</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($thesises as $thesis): ?>
                    <tr>
                        <td><?= $thesis['thesis_id'] ?></td>
                        <td><?= $thesis['thesis_title'] ?>  </td>
                        <td><a href="thesises/view/<?= $thesis['thesis_id'] ?>/<?= $thesis['thesis_title'] ?>"
                    </tr>
                <? endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(function () {
            $('#myTab a:last').tab('show')
        })
    </script>
</div>
