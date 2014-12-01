<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=BASE_URL?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<title><?=PROJECT_NAME?></title>

	<!-- Bootstrap core CSS -->
	<link href="assets/components/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<style>
		body {
			min-height: 2000px !important;
			padding-top: 70px;
		}
	</style>
    <link rel="stylesheet" href="assets/css/application.css"/>
    <link rel="stylesheet" href="assets/components/chosen/chosen.css"/>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
    <script src="assets/components/jquery/1.10.2/jquery-1.10.2.min.js"></script>
    
    <script src="assets/components/bootstrap/3.3.0/js/bootstrap.min.js"></script>


</head>

<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><?=PROJECT_NAME?></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <?= $controller == 'groups' ? 'class="active"' : ''?>><a href="groups"><?__('Grupid')?></a></li>
                <li <?= $controller == 'thesises' ? 'class="active"' : ''?> class="dropdown">
                    <a href="thesises" class="dropdown-toggle" onclick="location.href='thesises'" data-toggle="dropdown"><?__('Lõputööd')?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="thesises/archive">Arhiiv</a></li>
                    </ul>
                </li>
			</ul>
            <ul class="nav navbar-nav">
                <li <?= $controller == 'tests' ? 'class="active"' : ''?>><a href="tests"><?__('Testid')?></a></li>
                <li <?= $controller == 'timetable' ? 'class="active"' : ''?>><a href="timetable"><?__('Tunniplaan')?></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li <?= $controller == 'journal_student' ? 'class="active"' : ''?>><a href="journal/student"><?__('Päevik')?></a></li>
            </ul>
			<ul class="nav navbar-nav navbar-right">
                <li><a href="<?=BASE_URL?><?= $auth->logged_in == true? 'logout' : 'login'?>"><?= $auth->logged_in == true? 'Logout' : 'Login'?></a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>

<div class="container">

	<!-- Main component for a primary marketing message or call to action -->
	<? if( !file_exists("views/$controller/{$controller}_$action.php")) error_out('The view <i>views/'. $controller . '/' .  $controller . '_' . $action . '.php</i> does not exist. Create that file.');?>
    <?  @require "views/$controller/{$controller}_$action.php"; ?>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- #getrekt360noscopeteebagshot -->
</body>
</html>
