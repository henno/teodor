<div class="row">
    <div class="col-md-12">
            <div class="col-md-3">
                <input id="search" type="search" class="form-control" placeholder="Otsi...">
            </div>


        <? if ($auth->is_admin): ?>

        <!-- Lõputöö tähtaegade sisestamise vorm

        <form action="thesises/insert_dates">
            Failide üleslaadimise algus:<br>
            <input type="date" name="upload_at"><br><br>
            Failide üleslaadimise lõpp:<br>
            <input type="date" name="upload_at" ><br><br>
            <input type="submit">
        </form> -->
        <? endif ?>

        <button class="btn btn-primary pull-right" onclick="window.location.href = 'thesises/add'">
            Sisesta lõputöö
        </button>

    </div>
    <? if ($auth->is_admin): ?>
    <div class="pull-right"><a href="thesises/manage"><span class="glyphicon glyphicon-cog"></span></a></div>
</div>
<? endif; ?>
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
        <li role="presentation"><a href="#thesises_doing" aria-controls="thesises_doing" role="tab"
                                   data-toggle="tab">Minu lõputöö</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="thesises_index">
            <? if (empty($thesises)): ?>
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
                <tbody class="lookup">
                <? foreach ($thesis_ideas as $thesis_idea): ?>
                    <tr>
                        <td><?= $thesis_idea['thesis_id'] ?></td>
                        <td><?= $thesis_idea['thesis_title'] ?>  </td>
                        <td><a href="thesises/view/<?= $thesis_idea['thesis_id'] ?>/<?= $thesis_idea['thesis_title'] ?>"
                               class="btn btn-default" role="button">Vaatan lähemalt</a></td>
                    </tr>
                <? endforeach ?>
                <tbody>
                <? endif ?>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="thesises_approval">
            <? if (empty($thesises)): ?>
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
                <tbody class="lookup">
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
            <? if ($auth->is_admin): ?>
            <button type='button' class="btn btn-default pull-right" onclick="window.open('<?=BASE_URL?>pdf/thesises_approval/');"  value="thesis_pdf"
                    id="thesis_pdf">PDF
            </button>
            <? endif ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="thesises_in_progress">
            <? if (empty($thesises)): ?>
                <div class="alert alert-info"><? __('Hetkel lõputööde andmebaas on tühi.') ?></div>
            <? else: ?>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-7">Teema</th>
                    <th class="col-md-9">Kinnitatud</th>
                    <th class="col-md-2">Tegevused</th>
                </tr>
                </thead>
                <tbody class="lookup">
                <? foreach ($confirmed_thesises as $confirmed_thesis): ?>
                    <tr>
                        <td><?= $confirmed_thesis['thesis_id'] ?></td>
                        <td><?= $confirmed_thesis['thesis_title'] ?>  </td>
                        <td><?= $confirmed_thesis['thesis_title_confirmed_at'] ?></td>
                        <td>
                            <a href="thesises/view/<?= $confirmed_thesis['thesis_id'] ?>/<?= $confirmed_thesis['thesis_title'] ?>"
                               class="btn btn-default" role="button">Vaatan lähemalt</a></td>
                    </tr>
                <? endforeach ?>
                <tbody>
                <? endif ?>
            </table>

        </div>
        <div role="tabpanel" class="tab-pane" id="thesises_archive">

            <table class="table table-bordered" id="table1">
                <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-5">Teema</th>
                    <th class="col-md-3">Eriala</th>
                    <th class="col-md-3">Osakond</th>
                    <th class="col-md-2">Tegevused</th>
                </tr>
                </thead>
                <tbody class="lookup">
                <? foreach ($archived_thesises as $archived_thesis): ?>
                    <tr>
                        <td><?= $archived_thesis['thesis_id'] ?></td>
                        <td><?= $archived_thesis['thesis_title'] ?> </td>
                        <td><?= $archived_thesis['curriculum_name'] ?></td>
                        <td><?= $archived_thesis['department_name'] ?></td>
                        <td>
                            <a href="thesises/view/<?= $archived_thesis['thesis_id'] ?>/<?= $archived_thesis['thesis_title'] ?>"
                               class="btn btn-default" role="button">Vaatan lähemalt</a></td>
                    </tr>
                <? endforeach ?>
                </tbody>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="thesises_doing">
            <? if (empty($thesises)): ?>
                <div class="alert alert-info"><? __('Hetkel lõputööde andmebaas on tühi.') ?></div>
            <? else: ?>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-9">Teema</th>
                    <th class="col-md-2">Staatus</th>
                    <th class="col-md-2">Tegevused</th>
                </tr>
                </thead>
                <tbody class="lookup">
                <? foreach ($my_thesises as $my_thesis): ?>
                    <tr>
                        <td><?= $my_thesis['thesis_id'] ?></td>
                        <td><?= $my_thesis['thesis_title'] ?> </td>
                        <td><?php

                            if ($my_thesis['thesis_title_confirmed_at'] != NULL && $my_thesis['thesis_defended_at'] == NULL) {
                                echo "Kinnitatud";
                            } elseif ($my_thesis['thesis_defended_at'] != NULL) {
                                echo "Kaitstud";
                            } else {
                                echo "Kinnitamisel";
                            }
                            ?> </td>
                        <td><a href="thesises/view/<?= $my_thesis['thesis_id'] ?>/<?= $my_thesis['thesis_title'] ?>"
                               class="btn btn-default" role="button">Vaatan lähemalt</a></td>
                    </tr>
                <? endforeach ?>
                <tbody>
                <? endif ?>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#table1').tableFilter();


            if (location.hash) {
                $('a[href=' + location.hash + ']').tab('show');
            }
            $(document.body).on("click", "a[data-toggle]", function (event) {
                location.hash = this.getAttribute("href");
            });
        });
        $(window).on('popstate', function () {
            var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
            $('a[href=' + anchor + ']').tab('show');


        });

        // table search filter
        (function ($) {

            $('#search').keyup(function () {
                var find = new RegExp($(this).val(), 'i');
                $('.lookup tr').hide();
                $('.lookup tr').filter(function () {
                    return find.test($(this).text());
                }).show();
            })
        }(jQuery));

    </script>
</div>
