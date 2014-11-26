<form role="form" class="form-horizontal" method="post" action="thesises/<?= $thesis['thesis_title'] ?>">
    <div class="form-group form-group-lg">
        <label class="col-sm-2 control-label" for="formGroupInputLarge">Sisesta lõputöö pealkiri</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="formGroupInputLarge" name="thesis[thesis_title]" placeholder="Sisesta lõputöö pealkiri">
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        <textarea class="form-control" rows="5" placeholder="Valitud teema lühikirjeldus" name="thesis[thesis_description]"></textarea>
    </div>
    <label class="col-sm-2 control-label" for="formGroupInputLarge" >Tellija</label>
    <div class="col-sm-5">
        <input class="form-control" type="text" id="formGroupInputLarge" placeholder="Tellija nimi" name="thesis[thesis_client_info]">
    </div>
    <div class="pull-right">
        <button class="btn btn-primary" id="thesis_title">Salvesta
        </button>
    </div>
</form>