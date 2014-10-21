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
<br/>
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
</div><!-- /.row -->