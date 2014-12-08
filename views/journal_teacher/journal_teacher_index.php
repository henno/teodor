<h3><? __('Õpetaja päevik') ?></h3>

<ul class="nav nav-pills">
    <li class="active"><a href="#">Päevik</a></li>
    <li><a href="#">Tunniplaan</a></li>
    <li><a href="#">Teated</a></li>
    <li><a href="#">Arengukava</a></li>
    <li><a href="#">Koosolekud</a></li>
</ul>
<br>

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
        <td><b><a><input type="image" src="assets/pic/plus.jpg" name="saveForm" class="btTxt submit" id="saveForm" style="height:17px; width:17px"/></a><?= $period_course['group_name']?></b></td>
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

<br>
<table class="table table-bordered">
    <tr>
        <td><b>Õpilase nimi</b></td>
        <td><b>01.10</b></td> <td><b>02.10</b></td> <td><b>03.10</b></td> <td><b>04.10</b></td> <td><b>05.10</b></td><td><b>08.10</b></td>
        <td><b>Perioodi-, aastahinded</b></td>
    </tr>
    <tr>
        <td>Kristi Henno</td>
        <td>5</td> <td>-</td> <td>4</td> <td>4</td> <td>5</td> <td>IT</td>
        <td></td>
    </tr>
    <tr>
        <td>Anneli Loo</td>
        <td>4</td> <td>+</td> <td>5</td> <td>5</td> <td>4</td> <td>IT</td>
        <td></td>
    </tr>

</table>

