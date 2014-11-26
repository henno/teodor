<h1><? __('Lõputöö') ?> <i><?= $thesis['thesis_title'] ?></i></h1>
<span class="editable" id="y"><?= $thesis['thesis_title'] ?></span>
<span class="editable"><?= $thesis['thesis_description'] ?></span>
<span class="editable"><?= $thesis['thesis_client_info'] ?></span>
<span class="editable"><?= $thesis['author_name'] ?></span>
<span class="editable"><?= $thesis['instructor_name'] ?></span>
<span class="editable"><?= $thesis['thesis_instructor_confirmed_at'] ?></span>
<span class="editable"><?= $thesis['thesis_title_confirmed_at'] ?></span>
<span class="editable"><?= $thesis['thesis_defended_at'] ?></span>
<span class="editable"><?= $thesis['thesis_file_id_draft'] ?></span>
<span class="editable"><?= $thesis['thesis_file_id_final'] ?></span>
<!-- /.row -->
<script>
    $('.editable').mouseover(function () {
        klaabu($(this));
    });

    function klaabu(span) {

        // Save current value to variable
        var oldValue = $(span).html();

        // Write over the value with input containing the same value
        $(span).html('<input type="text" value="' + oldValue + '">');

        // Unbind the mouseover event from span to prevent adding input inside input
        $(span).unbind('mouseover');

        // Unwrap <input> from value and save the input
        $(span).find('input').mouseout(function () {
            var valueToSave = $(this).val();
            var span = $(this).parent();
            span.get(0).innerHTML = '1';
            console.log(span)
            span.mouseover(klaabu(span));
           // console.debug($(this).parent());
        });

    }
</script>