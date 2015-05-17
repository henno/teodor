<h1><? __('Ained') ?></h1>


<ul class="nav nav-pills">
    <li class="active"><a href="#">Aasta</a></li>
    <li><a href="#">1.periood</a></li>
    <li><a href="#">2.periood</a></li>
</ul>
<br>

<div class="row">
    <div class="col-md-3">
        Kokku puudumisi <span class="badge">85</span></div>
    <div class="col-md-3">
        Põhjuseta puudumisi <span class="badge">12</span></div>
    <div class="col-md-3">
        Kokku hilinemisi <span class="badge">10</span></div>
    <div class="col-md-3">
        Põhjuseta hilinemisi <span class="badge">4</span></div>
</div>
<hr>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Päevik</div>

    <!-- Table -->
    <table class="table table-bordered">
        <tr>
            <td><b>Kursuse nimetus</b></td>
            <td><b>Aasta/Perioodi hinded</b></td>
            <td><b>Ainehinded</b></td>
        </tr>
        <tr>
            <td>Eesti keel</td>
            <td>5,5,4,5</td>
            <td>5 , - , 4 , IT </td>
        </tr>
        <tr>
            <td>Matemaatika</td>
            <td>3,3,4,4</td>
            <td>+ ,4 , H, 3</td>
        </tr>

    </table>
</div>

<!-- TEACHER -->

<h1><? __('Õpetaja päevik') ?></h1>

<br>
<select id="period_id" name="period[period_id]" class="chosen-select">
    <? foreach ($periods as $period): ?>
        <option
            value="<?= $period['period_id'] ?>" <?= $period_id == $period['period_id'] ? 'selected="selected"' : '' ?>><?= $period['period_name'] ?></option>
    <? endforeach ?>
</select>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    $(function () {
        $(".chosen-select").chosen({width: "100%"});
        $('.chosen-select-deselect').chosen({allow_single_deselect: true});
        $(".chosen-select").change(function(){
            window.location="<?= BASE_URL ?>journal/teacher?period_id="+ this.value;
            console.log("<?= BASE_URL ?>journal/teacher?period_id="+ this.value);
        });
    });
</script>

<table class="table table-bordered">
    <tr>
        <td><b>Grupi nimi</b></td>
        <td><b>Kursuse nimetus</b></td>
        <td><b>Tunde</b></td>
        <td><b>Õppeaasta</b></td>
        <td><b>Perioodid</b></td>
        <td><b>Kursuse pikkus</b></td>
    </tr>
    <? foreach($period_courses as $period_course): ?>
        <tr class="header">
            <td><b><?= $period_course['group_name']?></b></td>
            <td><?= $period_course['subject_name']?></td>
            <td><?= $period_course['planned_lessons']?></td>
            <td><?= $period_course['year_name']?></td>
            <td><?= $period_course['period_name']?></td>
            <td>80 tundi</td>
        </tr>

    <? endforeach ?>
</table>

<script>
    $('.header').click(function(){
        $(this).next('.subrow').toggle();
    });
</script>

