<?php
ob_start();
$locale = "";
$language = "";
$project = "";

if (isset($_GET['locale'])) {
	if (file_exists("locale/locale-".$_GET['locale'].".php")) {
		$locale = $_GET['locale'];
		include "locale/locale-".$_GET['locale'].".php";
	} else {
		$locale = "en";
		include "locale/locale-en.php";
	}
} else {
	if (isset($_COOKIE['locale'])) {
		if (file_exists("locale/locale-".$_COOKIE['locale'].".php")) {
			$locale = $_COOKIE['locale'];
			include "locale/locale-".$_COOKIE['locale'].".php";
		} else {
			$locale = "en";
			include "locale/locale-en.php";
		}
	} else {
		$locale = "en";
		include "locale/locale-en.php";
	}
}

if (isset($_GET['language'])) {
	$language = $_GET['language'];
} else {
	if (isset($_COOKIE['language'])) {
		$language = $_COOKIE['language'];
	} else {
		$language = "id";
	}
}

if (isset($_GET['project'])) {
	$language = $_GET['project'];
} else {
	if (isset($_COOKIE['project'])) {
		$language = $_COOKIE['project'];
	} else {
		$language = "wikipedia";
	}
}
ob_end_clean();
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="img/favicon.png">
	
	<title>Raun</title>
	
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&amp;subset=Latin">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/style.css" rel="stylesheet">
	
	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#about" data-toggle="modal" data-target="#about" style="min-width:6em; height:50px;">Raun<span id="stat"></span></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="#help" data-toggle="modal" data-target="#help"><span class="glyphicon glyphicon-question-sign"></span> <?php echo $message['help']; ?></a></li>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-wrench"></span>
 <?php echo $message['settings']; ?> <b class="caret"></b></a>
						<div class="dropdown-menu keep-open">
								<table id="settings-menu">
									<tr style="vertical-align:top;">
										<td>
										<button id="pause" class="btn btn-warning"><span class="glyphicon glyphicon-pause"></span> <?php echo $message['settings_pause']; ?></button>
										<hr>
										<?php echo $message['settings_show']; ?>:
										<div class="checkbox">
											<label>
											<input type="checkbox" id="show_bot" class="config" value="true">
												<span class="label label-info"><?php echo $message['settings_bot_edits']; ?></span>
											</label>
										</div>
										<div class="checkbox">
											<label>
											<input type="checkbox" id="show_anon" class="config" value="true">
												<span class="label label-danger"><?php echo $message['settings_anon_edits']; ?></span>
											</label>
										</div>
										<div class="checkbox">
											<label>
											<input type="checkbox" id="show_minor" class="config" value="true">
												<span class="label label-primary"><?php echo $message['settings_minor_edits']; ?></span>
											</label>
										</div>
										<div class="checkbox">
											<label>
											<input type="checkbox" id="show_redirect" class="config" value="true">
												<span class="label label-warning"><?php echo $message['settings_redirects']; ?></span>
											</label>
										</div>
										<div class="checkbox">
											<label>
											<input type="checkbox" id="show_new" class="config" value="true">
												<span class="label label-success"><?php echo $message['settings_new_pages']; ?></span>
											</label>
										</div>
										<div class="checkbox">
											<label>
											<input type="checkbox" id="show_editor" class="config" value="true">
												<span class="label label-default"><?php echo $message['settings_editor_edits']; ?></span>
											</label>
										</div>
										<div class="checkbox">
											<label>
											<input type="checkbox" id="show_admin" class="config" value="true">
												<span class="label label-info"><?php echo $message['settings_admin_edits']; ?></span>
											</label>
										</div>
									</td>
										<td>
										<form id="tool_config" role="form" method="get">
										<?php echo $message['settings_tool']; ?>:
											<div class="form-group">
											<label for="locale"><?php echo $message['language']; ?></label>
											<input type="text" class="form-control config_right" name="locale" id="locale" placeholder="<?php echo $message['language']; ?>" value="<?php echo $locale; ?>">
											</div>
										<hr>
										<?php echo $message['settings_wiki']; ?>:
											<div class="form-group">
											<label for="language"><?php echo $message['language']; ?></label>
											<input type="text" class="form-control config_right" name="language" id="language" placeholder="<?php echo $message['language']; ?>" value="id">
											</div>
											<div class="form-group">
											<label for="project"><?php echo $message['project']; ?></label>
											<input type="text" class="form-control config_right" name="project" id="project" placeholder="<?php echo $message['project']; ?>" value="wikipedia">
											</div>
											<button type="submit" class="btn-primary btn"><?php echo $message['save']; ?></button>
										</form>
										</td>
									</tr>
								</table>
								
						</div>
					</li>
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li style="padding:12.5px 7px;"><iframe src="http://ghbtns.com/github-btn.html?user=kenrick95&repo=Raun&type=watch&count=true"
  allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe></li>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats"></span>
 <?php echo $message['stat']; ?> <b class="caret"></b></a>
						<div class="dropdown-menu keep-open">
							<div style="padding:0 1em;">
							<div title="<?php echo $message['time_utc']; ?>" style="text-align:center;">
								<span class="glyphicon glyphicon-time"></span> <span id="tz"></span>
							</div>
							<div id="w_stat">
								 <img src='img/loading.gif' style='width:16px; height:16px;'>
							</div>
							</div>
						</div>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
			
		</div>
	</div>
	
	<div class="container">
	
		<div class="main">
			<div id="def">
				<p class="lead"><b>ra&middot;un</b> <i><?php echo $message['def_i']; ?></i> <?php echo $message['def_def']; ?></p>
			</div>
			<div class="table-responsive">
				<table class="table" id="main-table">
					<thead>
						<tr>
							<th colspan="2" class="col-lg-1 col-md-1 col-sm-1 col-xs-1" nowrap><?php echo $message['main_time_utc']; ?></th>
							<th class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><?php echo $message['main_page']; ?></th>
							<th class="col-lg-1 col-md-1 col-sm-1 col-xs-5"><?php echo $message['main_user']; ?></th>
							<th class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><?php echo $message['main_info']; ?></th>
						</tr>
					</thead>
					<tbody id="main-table-body">
					
					</tbody>
				</table>
			</div>
		</div>
	
	</div><!-- /.container -->
	
	<!-- Modal -->
	<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="helpLabel"><?php echo $message['help']; ?></h4>
				</div>
				<div class="modal-body">
					<p class="lead"><b>ra&middot;un</b> <i><?php echo $message['def_i']; ?></i> <?php echo $message['def_def']; ?></p>
					<p><?php echo $message['help_p1']; ?></p>
					<p><?php echo $message['help_p2']; ?></p>
					<p><?php echo $message['help_p3']; ?></p>
					<p><?php echo $message['help_legend']; ?></p>
						<table class="table">
							<thead>
								<tr>
									<th><?php echo $message['color']; ?></th>
									<th><?php echo $message['ns']; ?></th>
									<th><?php echo $message['color']; ?></th>
									<th><?php echo $message['ns']; ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="ns-0">&#32;</td>
									<td><?php echo $message['ns0']; ?></td>
									<td class="ns-1">&#32;</td>
									<td><?php echo $message['ns1']; ?></td>
								</tr>
								<tr>
									<td class="ns-2">&#32;</td>
									<td><?php echo $message['ns2']; ?></td>
									<td class="ns-3">&#32;</td>
									<td><?php echo $message['ns3']; ?></td>
								</tr>
								<tr>
									<td class="ns-4">&#32;</td>
									<td><?php echo $message['ns4']; ?></td>
									<td class="ns-5">&#32;</td>
									<td><?php echo $message['ns5']; ?></td>
								</tr>
								<tr>
									<td class="ns-6">&#32;</td>
									<td><?php echo $message['ns6']; ?></td>
									<td class="ns-7">&#32;</td>
									<td><?php echo $message['ns7']; ?></td>
								</tr>
								<tr>
									<td class="ns-8">&#32;</td>
									<td><?php echo $message['ns8']; ?></td>
									<td class="ns-9">&#32;</td>
									<td><?php echo $message['ns9']; ?></td>
								</tr>
								<tr>
									<td class="ns-10">&#32;</td>
									<td><?php echo $message['ns10']; ?></td>
									<td class="ns-11">&#32;</td>
									<td><?php echo $message['ns11']; ?></td>
								</tr>
								<tr>
									<td class="ns-12">&#32;</td>
									<td><?php echo $message['ns12']; ?></td>
									<td class="ns-13">&#32;</td>
									<td><?php echo $message['ns13']; ?></td>
								</tr>
								<tr>
									<td class="ns-14">&#32;</td>
									<td><?php echo $message['ns14']; ?></td>
									<td class="ns-15">&#32;</td>
									<td><?php echo $message['ns15']; ?></td>
								</tr>
								<tr>
									<td class="ns-100">&#32;</td>
									<td><?php echo $message['ns100']; ?></td>
									<td class="ns-101">&#32;</td>
									<td><?php echo $message['ns101']; ?></td>
								</tr>
							</tbody>
						</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $message['close']; ?></button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- Modal -->
	<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="aboutLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="aboutLabel"><?php echo $message['about']; ?></h4>
				</div>
				<div class="modal-body">
					<p class="lead"><b>ra&middot;un</b> <i><?php echo $message['def_i']; ?></i> <?php echo $message['def_def']; ?></p>
					<p><?php echo $message['about_tool']; ?></p>
					<p><span class="label label-info"><?php echo $message['information']; ?></span> <?php echo $message['about_cookie']; ?></p>
					<p><?php echo $message['credit']; ?>:
					</p>
						<ul>
							<li><a href="http://ivan.lanin.org/ronda">Ronda</a> (<?php echo $message['about_by']; ?> Ivan Lanin)</li>
							<li>Twitter Bootstrap 3.0</li>
							<li>jQuery 1.10.2</li>
							<li>Wikipedia API</li>
						</ul>
					<p><?php echo $message['about_license']; ?></p>
					<p><?php echo $message['about_github']; ?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $message['close']; ?></button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script>
		var locale_obj = <?php echo json_encode($message, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
	</script>
	<script src="js/default.js"></script>
</body>
</html>
