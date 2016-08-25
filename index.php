<?php
  $content = '';
  $isleft = TRUE;
  

  $time = file_get_contents("time");
  if ((time() - $time) >= 90) {
    $json = file_get_contents("http://api.truckersmp.com/v2/servers");
    file_put_contents("status.json", $json);
    file_put_contents("time", time());
  }

  $json = file_get_contents("status.json");
  $status = json_decode($json, TRUE);
  
  if ($status['error'] != "false") {
	  $content .= '
	  		   <div class="field full">
            	<p>The TruckersMP API server seems to be having issues.</p>
          	</div>';
  } else {
    $maxplayers = "";
    $players = "";
    
	  foreach ($status['response'] as $row) {
      $serveronlinebar = "";
      
      $maxplayers = $maxplayers + $row['maxplayers'];
      $players = $players + $row['players'];
      
		  $content .= '<div class="field ';
      
		  if ($isleft == TRUE) {
			  $content .= 'left';
			  $isleft = FALSE;
		  } else {
			  $content .= 'right';
			  $isleft = TRUE;
		  }
      
      
      $onlinepercent = ($row['players'] / $row['maxplayers']) * 100;
      $onlinepercent = round($onlinepercent);
      
      $serveronlinebar .= '<div class="bar">';
      
      for ($i = 1; $i <= $onlinepercent; $i++) {
        $serveronlinebar .= '<div class="red"></div>';
      }
      for ($k = $onlinepercent + 1; $k <= 100; $k++) {
        $serveronlinebar .= '<div class="green"></div>';
      }
      $serveronlinebar .= '</div>';
      
      if ($row['online'] == 'true') {
        $onlinemsg = '<span class="online">ONLINE!</span>';
      } else {
        $onlinemsg = '<span class="offline">Offline!</span>';
      }
      
		  $content .= '">
		  	<h2>' . $row['game'] . ': ' . $row['name'] . '</h2>
      <p><span class="bold">Short Name: </span>' . $row['shortname'] . '</p>
      <p><span class="bold">Game: </span>' . $row['game'] . '
      <p><span class="bold">Status: </span>' . $onlinemsg . '</p>
      <p><span class="bold">Players: </span>' . $row['players'] . '/' . $row['maxplayers'] . ' (' . $onlinepercent . '%) online</p>
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
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <meta name="keywords" content="HumaneWolf, Portfolio, developer, webdev">
    <meta name="author" content="HumaneWolf or Kristian">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>TruckersMP Server Status</title>

    <style>
      .online {
        color: #008A00;
      }
      
      .offline {
        color: #FF0000;
      }
      
      .bar {
        display: block;
        margin-left: 20px;
        margin-right: 20px;
        margin-bottom: 50px;
      }
      
      .legend {
        max-height: 0px;
        overflow: hidden;
        position: absolute;
        margin-top: -25px;
        
        transition: linear 0.5s;
        -moz-transition: linear 0.5s;
        -ie-transition: linear 0.5s;
        -o-transition: linear 0.5s;
        -webkit-transition: linear 0.5s;
      }
      
      .bar:hover ~ .legend, .bar:focus ~ .legend {
        max-height: 900px;
      }
      
      .red {
        background-color: rgba(255, 0, 0, 0.5);
        height: 20px;
        width: 1%;
        display: inline-block;
        float: left;
        margin: 0;
      }
      
      .green {
        background-color: rgba(0, 138, 0, 0.5);
        height: 20px;
        width: 1%;
        display: inline-block;
        float: left;
        margin: 0;
      }
    </style>
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