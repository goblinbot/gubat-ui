<?php
// SQL:CONFIG data inladen.
if (isset($UPLINK)) {
  $config_query = "SELECT brightness, defaultcolor, spaceships, web_status, MALF
                  FROM config
                  LIMIT 1";
  $gubat_defaults = mysqli_fetch_array($UPLINK->query($config_query));
}

// HEAD //
$metahead = '<title>&#x1F30C; Himawari 4.51</title>
                <link rel="shortcut icon" href="/_image/favicon.ico" type="image/x-icon">
                <link rel="icon" href="/_image/favicon.ico" type="image/x-icon">
		            <link rel="stylesheet" type="text/css" href="/_animate/keyframes.css" />
                <link rel="stylesheet" type="text/css" href="/_animate/orbit.css" />
                <link rel="stylesheet" type="text/css" href="/_include/style.css" />';

if ($gubat_defaults["brightness"] == 1)         {$metahead .= '<link rel="stylesheet" type="text/css" href="/_include/light85.css" />';
} else if ($gubat_defaults["brightness"] == 2)  {$metahead .= '<link rel="stylesheet" type="text/css" href="/_include/light75.css" />';}
if ($gubat_defaults["MALF"] > 0)                {$metahead .= '<link rel="stylesheet" type="text/css" href="/_animate/glitch3.css" />';}

$metahead .= '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" name="viewport" />
                <script type="text/javascript" src="/_include/jquery-1.11.2.min.js"></script>
                <script type="text/javascript" src="/_include/functions.js"></script>
				<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
            ';
// EIND HEAD //
////////////////////////////////////////////
// KUVAKEI POLYMORPHICS LOGO //
$logo_poly = '<div id="orbit">
                <h1 class="noselect">
                    <em>KUVAKEI</em>
                    <em>&nbsp;</em>
                    <em>P</em>
                    <em class="planet left">O</em>
                    <em>LYM</em>
                    <em class="planet right">O</em>
                    <em>RPHICS</em>
                  </h1>
            </div>';

?>
