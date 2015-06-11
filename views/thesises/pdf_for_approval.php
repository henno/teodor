<?php
/**
 * Created by PhpStorm.
 * User: carolin
 * Date: 10.06.2015
 * Time: 14:10
 */

include('assets/components/mpdf/5.7/mpdf.php');

$html .= "
<html>
<head>
<style>
body {font-family: sans-serif;
    font-size: 10pt;
}
td { vertical-align: top;
    border-left: 0.6mm solid #000000;
    border-right: 0.6mm solid #000000;
	align: center;
}
table thead td { background-color: #EEEEEE;
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

<div style='text-align:center;'>HTML Form to PDF - Blog.theonlytutorials.com</div><br>
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
              <?  foreach ($thesises as $thesis): ?>
                    <tr>
                        <td>järjek</td>
                        <td>sammal habe</td>
                        <td>grupinimi</td>
                        <td>lorem ipsum</td>
                        <td>juhendaja</td>
                    </tr>

                </tbody>
            </table>
</body>
</html>
";



$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullwidth');

$mpdf->Output();

?>