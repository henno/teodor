

        <div class="panel panel-default setup">
            <div class="panel-heading">
                Vali grupp
            </div>
            <div class="panel-body setup-body">
                <form role="form" class="form-horizontal" method="post"

                <div class="col-sm-10">
                    <select id="group_id" name="group_select" class="chosen-select">
                        <? foreach ($groups as $group): ?>
                            <option
                                value="<?= $group['group_id'] ?>" <?= $group['group_name'] == $group['group_name'] ? 'selected="selected"' : '' ?>><?= $group['group_name'] ?></option>
                        <? endforeach ?>
                    </select>

                 <p></p><input type="checkbox" name="group" value="group"> Ei ole seotud ühegi grupiga<br>
                <button class="btn btn-primary pull-right" formaction="user_setup/index_post/" value="index_post">
                    Jätka
                </button></div>
                </form>
            </div>
        </div>


        <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
        <script>
            $('#savecomment').on('click', function () {
                $('#myModal').modal('hide');

            });


            $(function () {
                // Initialize dropdown for adding thesis instructors
                $(".chosen-select").chosen();
                $('.chosen-select-deselect').chosen({allow_single_deselect: true});

            });
            </script>


