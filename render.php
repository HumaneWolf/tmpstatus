<?php
//Not yet updated. Will be some time.

$content = '';
$isleft = TRUE;

$maxplayers = "";
$players = "";

foreach ($s as $r) {
	$serveronlinebar = "";
	if ($r->online == 'true') {
		$maxplayers = $maxplayers + $r->maxPlayers;
		$players = $players + $r->players;
	}

	$content .= '<div class="field ';

	if ($isleft == TRUE) {
		$content .= 'left';
		$isleft = FALSE;
	} else {
		$content .= 'right';
		$isleft = TRUE;
	}


	$onlinepercent = ($r->players / $r->maxPlayers) * 100;
	$onlinepercent = round($onlinepercent);

	$serveronlinebar .= '<div class="bar">';
	if ($r->online == 'true') {
		for ($i = 1; $i <= $onlinepercent; $i++) {
			$serveronlinebar .= '<div class="red"></div>';
  		}
  		for ($k = $onlinepercent + 1; $k <= 100; $k++) {
			$serveronlinebar .= '<div class="green"></div>';
		}
	} else {
		for ($k = 1; $k <= 100; $k++) {
			$serveronlinebar .= '<div class="black"></div>';
		}
	}
	$serveronlinebar .= '</div>';

	if ($r->queue == 0) {
		$queue = 'None';
	} else {
		$waitTimeModifier = 0.7;
		$sec = floor($r->queue * $waitTimeModifier);
		$min = 0;
		$hrs = 0;
		
		$min = floor($sec / 60);
		$sec = $sec - ($min * 60);
		$hrs = floor($min / 60);
		$min = $min - ($hrs * 60);

		$waitTime = $hrs . ':' . str_pad($min, 2, '0', STR_PAD_LEFT) . ':' . str_pad($sec, 2, '0', STR_PAD_LEFT);

		$queue = $r->queue . ' players in queue (<span class="bold">' . $waitTime . '</span> estimated wait time)';
	}
	
	if ($r->online == true) {
	  $onlinemsg = '<span class="online">ONLINE!</span>';
	} else {
	  $onlinemsg = '<span class="offline">Offline!</span>';
	}
	
	$content .= '">
	<h2>' . $r->game . ': ' . $r->name . ' (<span class="nofocus">' . $r->shortName . '</span>)</h2>
	<p><span class="bold">Game: </span>' . $r->game . '</p>
	<p><span class="bold">Status: </span>' . $onlinemsg . '</p>
	<p><span class="bold">Players: </span>' . $r->players . '/' . $r->maxPlayers . ' (' . $onlinepercent . '%) online</p>
	<p><span class="bold">Queue:</span> ' . $queue . '</p>
	' . $serveronlinebar . '
	<div class="legend"><p><span class="bold">Legend:</span> <span class="offline">Players online</span> <span class="online">Player slots available</span></p></div>
	</div>';
}

$onlinebar = "";
$onlinepercent = ($players / $maxplayers) * 100;
$onlinepercent = round($onlinepercent);
  
$onlinebar .= '<div class="bar">';
  
for ($i = 1; $i <= $onlinepercent; $i++) {
	$onlinebar .= '<div class="red"></div>';
}
for ($k = $onlinepercent + 1; $k <= 100; $k++) {
	$onlinebar .= '<div class="green"></div>';
}
$onlinebar .= '</div>';
