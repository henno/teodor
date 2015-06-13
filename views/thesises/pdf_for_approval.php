<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        td {
            vertical-align: top;
            border-left: 0.6mm solid #000000;
            border-right: 0.6mm solid #000000;
            align: center;
        }

        table thead td {
            background-color: #EEEEEE;
            text-align: center;
            border: 0.6mm solid #000000;
        }
        td.lastrow {
            background-color: #FFFFFF;
            border: 0mm none #000000;
            border-bottom: 0.6mm solid #000000;
            border-left: 0.6mm solid #000000;
            border-right: 0.6mm solid #000000;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>
<body>

<!--mpdf
<htmlpagefooter name='myfooter'>
<div style='border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; '>
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
<sethtmlpagefooter name='myfooter' value='on' />
mpdf-->

<table border='1' style='width:100%'>
    <thead>
    <tr>
        <th class='col-md-1'>#</th>
        <th class='col-md-5'>Nimi</th>
        <th class='col-md-5'>Õppegrupp</th>
        <th class='col-md-3'>Teema</th>
        <th class='col-md-3'>Juhendaja</th>
    </tr>
    </thead>
    <tbody>
    <? $n = 0;
    foreach ($thesises as $thesis): $n++ ?>
        <tr>
            <td><?= $n ?></td>
            <td><?= $thesis['person_firstname'] ?> <?= $thesis['person_lastname'] ?></td>
            <td><?= $thesis['group_name'] ?></td>
            <td><?= $thesis['thesis_title'] ?></td>
            <td><?= $thesis['instructor_name'] ?></td>
        </tr>
    <? endforeach ?>

    </tbody>
</table>
</body>
</html>