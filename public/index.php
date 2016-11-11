<?php
require __DIR__ . '/../main.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<meta name="keywords" content="HumaneWolf, Portfolio, developer, webdev">
		<meta name="author" content="HumaneWolf, Kristian">

		<link rel="stylesheet" type="text/css" href="css/style.css">

		<title>TruckersMP Server Status</title>
	</head>
	<body>
		<div class="wrapper">
			
			<div class="content">
				<div class="middle">
					<div class="field full">
						<h1 class="center">TruckersMP Server Status</h1>
						<p class="center"><span class="bold">Players across all servers:</span> <?php echo $players; ?>/<?php echo $maxplayers; ?> (<?php echo $onlinepercent; ?>%) online.</p>
						<?php echo $onlinebar; ?>
						<div class="legend"><p><span class="bold">Legend:</span> <span class="offline">Players online</span> <span class="online">Player slots available</span></p></div>
					</div>
					<?php echo $content; ?>
				</div>
			</div>
			
			<div class="middle">
				<div class="footer">
					<span class="copyright">&copy; HumaneWolf.com, 2014-<?php echo date("Y"); ?>. This website uses cookies to track page statistics and improve the experience.</span>
				</div>
			</div>
		</div>
	</body>
</html>