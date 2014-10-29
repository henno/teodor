<h3><?__('Lõputööd')?></h3>
<div class="row">
    <div class="col-md-6">
        <span class="lead">Laadi üles:</span>


        <div class="pull-right">

            <div class="btn-group btn-group-lg">
                <button type="button" class="btn btn-default" id="thesis-draft">Eelkaitsmine </button>
                <button type="button" class="btn btn-default">Lõputöö</button>
                <button type="button" class="btn btn-default">Lisamaterjalid</button>
            </div>
        </div>
        <form id="uploadForm" method="post" enctype="multipart/form-data">
            <?php var_dump($_FILES) ?>
            <input type="file" name="input_upload" id="input_upload" class="file-upload"/>
            <input type="text" id="file-name" class="text-upload" readonly/>
        </form>
        <script>
            $('#thesis-draft').click(function (event) {
                $('#input_upload').click();
            });

            //capture selected filename
            $('#input_upload').change(function (click) {
                //  $('#file-name').val(this.value);
                $('form#uploadForm').submit();
            });
        </script>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Kinnita</button>
      </span>
            <input type="text" class="form-control" placeholder="Juhendaja nimi">
        </div>
        <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Lõputöö teema">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Kinnita</button>
      </span>
        </div>
        <!-- /input-group -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<? if (empty($thesises)): ?>
    <div class="alert alert-info"><?__('Hetkel lõputööde andmebaas on tühi.') ?></div>
    <? else: ?>
<ul class="list-group">
    <? foreach ($thesises as $thesis): ?>
        <li class="list-group-item">
            <a href="thesises/view/<?= $thesis['thesis_id'] ?>/<?= $thesis['thesis_title'] ?>"><?= $thesis['thesis_title'] ?></a>
        </li>
    <? endforeach ?>
</ul>

<?php if ($auth->is_admin): ?>
    <h3>Add new thesis</h3>

    <form method="post" id="form">
        <form id="form" method="post">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="data[thesis_name]" placeholder=""/></td>
                </tr>
            </table>

            <button class="btn btn-primary" type="submit">Add</button>
        </form>
    <?php endif; ?>
        <? endif ?>