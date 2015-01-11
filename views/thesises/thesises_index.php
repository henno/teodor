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
            <table id="table2" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Osakond</th>
                    <th>Eriala</th>
                    <th>Aasta</th>
                    <th>Teema</th>
                </tr>
                <tr>
                    <td>IKT</td>
                    <td>Infosüsteemid</td>
                    <td>2015</td>
                    <td>Midagi infosüsteemidest</td>
                </tr>
                <tr>
                    <td>Puidutehnoloogia</td>
                    <td>Puusepp</td>
                    <td>2013</td>
                    <td>Eriti peen trepp</td>
                </tr>
                <tr>
                    <td>Toiduainetetööstus</td>
                    <td>Pagar-kondiiter</td>
                    <td>2014</td>
                    <td>Vastlakuklid</td>
                </tr>
            </table>

            <script>
                var table2 = {
                    col_0: "select",
                    col_4: "none",
                    display_all_text: " [ Show all ] ",
                    sort_select: true
                };
                /* var tf2 = setFilterGrid("table2", table2);*/
            </script>
        </div>
    </div>

    <script>
        $(function () {
            $('#myTab a:last').tab('show')
        })
    </script>
</div>
