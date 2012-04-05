<?php

define('LOG_FILE', dirname(__FILE__) . '/log.txt');

$log_json = file_get_contents(LOG_FILE);
$logs = json_decode($log_json);
if ( !$logs ) {
	$logs = array();
}

function format_log($log) {
	$log->decoded_message = $log->message;
	if ( $log->format == 'json' ) {
		$log->decoded_message = '<pre>' . print_r(json_decode($log->message), 1) . '</pre>';
	}
}

foreach ( (array) $logs->incidence as $log ) {
	$log = format_log($log);
}

foreach ( (array) $logs->log as $log ) {
	$log = format_log($log);
}

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <!-- end CSS-->
</head>

<body>
	<div id="container">
		<header class="row-fluid">
			<h1 class="span12">Client Side Logs</h1>
		</header>
		<div id="main-container" class="row-fluid">
			<aside class="span2">
				<ul class="nav nav-list">
					<li class="nav-header">Type:</li>
					<li class="active"><a href="#">Error</a></li>
					<li><a href="#">Info</a></li>
					<li><a href="#">Log</a></li>
				</ul>
			</aside>
			<div class="span10">
				<h3>Overview</h3>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th># of Incidents</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $logs->incidence as $log ) : ?>
						<tr>
							<td><?php echo $log->count ?></td>
							<td>
								<?php echo $log->decoded_message ?>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>

				<h3>All entries</h3>
				<table class="table table-bordered table-striped">
					<thead>
						<th class="span2">Time</th>
						<th>Message</th>
					</thead>
					<tbody>
						<?php foreach ( $logs->log as $log ) : ?>
						<tr>
							<td><?php echo $log->time ?></td>
							<td><?php echo $log->decoded_message ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>

				<?php /*
				<div class="pagination">
					<ul>
						<li><a href="#">Prev</a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</div>
				*/ ?>
			</div>
		</div>
	</div> <!--! end of #container -->


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


	<!-- scripts concatenated and minified via ant build script-->
	<script defer src="../jQuery.clientSideLogging.js"></script>
	<script defer src="js/scripts.js"></script>
	<!-- end scripts-->


	<script> // Change UA-XXXXX-X to be your site's ID
		// window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
		// Modernizr.load({
		// 	load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
		// });
	</script>

	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
</body>
</html>
