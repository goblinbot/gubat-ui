<?php
    require __DIR__.'/../_include/content.php';
    require __DIR__.'/../_include/config.php';

    session_start();

    $status_types = array(
      0 => 'online',
      1 => 'offline',
      2 => 'critical',
      3 => 'offworld',
      4 => 'unknown',
      5 => 'hosting',
    );

    $loginStatus = "This area is restricted.";

    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
            unset($_POST["submitKeycode"]);
            unset($_SESSION['maati']);
                header("location: index.php");
                exit();

    } else if (!isset($_SESSION['maati'])) {

        if (isset($_POST["submitKeycode"])) {
            /*escape de keycode voordat we hem gaan gebruiken. $submitKeycode is vanaf nu de waarde waar we op checken. */
            $submitKey = mysqli_escape_string($UPLINK,$_POST["submitKeycode"]);

            $query  = "SELECT agent_pin FROM agents WHERE agent_id = '4' LIMIT 1";
            $result = $UPLINK->query($query);
                $row = mysqli_fetch_array($result);
                $ChK = $row["agent_pin"];
                    $result->close();

                if ($submitKey == $ChK){
                    $_SESSION['maati'] = $ChK;
                    header("location: index.php");
                } else {
                    $loginStatus = "Get out, insect.";
                }
                $ChK = "";

        }
    } else if (isset($_SESSION['maati'])) {
        $loginStatus = "Welcome back.";
    } else {
        $loginStatus = "Intruder alert.";
    }


?>
<html>

<head>
    <?php echo $metahead; ?>

    <script>
        (function($) {
        $.fn.nodoubletapzoom = function() {
            $(this).bind('touchstart', function preventZoom(e) {
              var t2 = e.timeStamp
                , t1 = $(this).data('lastTouch') || t2
                , dt = t2 - t1
                , fingers = e.originalEvent.touches.length;
              $(this).data('lastTouch', t2);
              if (!dt || dt > 500 || fingers > 1) return; // not double-tap

              e.preventDefault(); // double tap - prevent the zoom
              // also synthesize click events we just swallowed up
              $(this).trigger('click').trigger('click');
            });
        };
        });
        $(document).ready(function(){
            $(".CODECYAN").trigger('click');
        });
    </script>
</head>

<body>
    <div id="container_adm" class="adm-border">

            <div class="CODECYAN noselect bottom_bar" style="top:10px; left:10px;">&nbsp;</div>

        <div id="row_adm">
            <div class="boxleft">
                <div class="motto">
                    <ul>

                    </ul>
                </div>
            </div>

            <div class="bar" style="height:16px;">
                <div class="bar_left">Himawari <span class="Ye">V</span><span class="Cy">04.51</span></div>
                <div class="bar_right">biOS | 0451</div>
            </div>

            <?php
            if (!isset($_SESSION['maati'])) {
              $xContent = "";
              ?>

              <div id="grid" style="margin: 0px 0px 8px 8px;">

                      <div class="center">

                          <p class="error"><? echo $loginStatus; ?></p>

                          <table id="admkeypad" class="noselect" cellspacing="6">
                              <tr>
                                  <th colspan="3">
                                      <form id="keypad_login" action="index.php" method="post">
                                          <textarea id="writekeys" name="submitKeycode" rows="1" cols="6" maximum="5" readonly="readonly" class="noselect"></textarea>
                                      </form>
                                  </th>
                              </tr>
                              <tr>
                                  <td class="container-border">1</td>
                                  <td class="container-border">2</td>
                                  <td class="container-border">3</td>
                              </tr>
                              <tr>
                                  <td class="container-border">4</td>
                                  <td class="container-border">5</td>
                                  <td class="container-border">6</td>
                              </tr>
                              <tr>
                                  <td class="container-border">7</td>
                                  <td class="container-border">8</td>
                                  <td class="container-border">9</td>
                              </tr>
                              <tr>
                                  <td class="delete container-border">C</td>
                                  <td class="container-border">0</td>
                                  <td class="submit container-border">&#5127;</td>
                              </tr>
                          </table>

                      </div>

              </div>
              <?
              /* SYSADM HOMEPAGINA */
              } else if (isset($_SESSION['maati']) && (!isset($_GET["page"]))) {

                $xContent = "<p>".$loginStatus."</p>";
                  $xContent .= "<div id=\"grid\" style=\"flex-direction: column\">

                    <a href=\"index.php?page=status\">
                      <div class=\"item adm-border center adm_box\">
                        <h2>&#x1F464; SQUAD STATUS</h2>
                      </div>
                    </a>

                    <a href=\"index.php\">
                      <div class=\"item adm-border center adm_box\">
                        <h2>&#10012; BULLETIN</h2>
                      </div>
                    </a>

                    <a href=\"index.php?page=config\">
                      <div class=\"item adm-border center adm_box\">
                        <h2>&#x2692; CONFIG</h2>
                      </div>
                    </a>

                    <a href=\"index.php\">
                      <div class=\"item adm-border center adm_box\">
                        <h2>&#x2694; SCORES</h2>
                      </div>
                    </a>";

              /* STATUS PAGINA */////////////////////////////////////////////////////////////////
              } else if (isset($_SESSION['maati']) && ($_GET["page"] == "status")) {

                /* Huizingfilter */
                $triggers    = array('meme','tp:/','src','<','>','><','.js','$');
                $error       = false;

                /* link terug */
                $xContent = "<a href=\"index.php\"><p class=\"hosting center\">&#x25C0; Return to main</p></a>";

                if (isset($_POST['editsubmit'])) {

                  $_POST["editname"] = str_replace("'","&#39;",$_POST["editname"]);

                  $i = 0;

                  if(empty($_POST["editorders"])) { $edit[$i] = "none"; } else { $edit[$i] = mysqli_escape_string($UPLINK, strtolower($_POST['editorders'])); } $i++;
                  if(empty($_POST["editstatus"])) { $edit[$i] = "unknown"; } else { $edit[$i] = mysqli_escape_string($UPLINK, strtolower($_POST['editstatus'])); } $i++;
                  if(empty($_POST["editname"])) { $error = true; } else { $edit[$i] = mysqli_escape_string($UPLINK, strtolower($_POST['editname'])); } $i++;
                  if((empty($_POST["editcode"])) || (strlen($_POST["editcode"]) < 5) || (strlen($_POST["editcode"]) > 5)) { $error = true; } else { $edit[$i] = mysqli_escape_string($UPLINK, strtolower($_POST['editcode'])); } $i++;
                  if(empty($_POST["editrank"])) { $error = true; } else { $edit[$i] = mysqli_escape_string($UPLINK, strtolower($_POST['editrank'])); } $i++;
                  if(empty($_POST["editbackup"])) { $edit[$i] = "24H+"; } else { $edit[$i] = mysqli_escape_string($UPLINK, strtolower($_POST['editbackup'])); }  $i++;
                  if(empty($_POST["editid"])) { $error = true; } else { $edit[$i] = mysqli_escape_string($UPLINK, strtolower($_POST['editid'])); }

                    $i = 0;
                    foreach ($triggers as $trigger) { // looped door de huizingtriggertriggertrigger
                      foreach ($edit AS $inputarray) {
                        if (strpos($inputarray,$trigger) !== false ) {
                          $error = true;
                          $xEdit = "An error has occured.";
                        }
                        $i++;
                      }
                    }

                    if ($error == false) {

                      if ($UPLINK->query("
                        UPDATE agents
                          SET
                            orders      = '".$edit[0]."',
                            status      = '".$edit[1]."',
                            name        = '".strtoupper($edit[2])."',
                            agent_pin   = '".$edit[3]."',
                            rank        = '".strtoupper($edit[4])."',
                            backup      = '".strtoupper($edit[5])."'
                        WHERE name LIKE '".$edit[2]."' ")) {
                          $xEdit = "Succesfully updated agent : ". $edit[2];
                        } else {
                          $xEdit = "Query error. Consult Maati.";
                        }

                    } else {
                        $xEdit = "An error has occured.";
                    }
                } else {
                  $xEdit = "Nothing";
                }

                echo $xEdit;

                /* SELECTEREN VAN DE VELDEN */////////////////////////////////////////////////////////////////
                $query ="SELECT *
                    FROM agents
                    WHERE status NOT LIKE 'inactive'
                    AND status NOT LIKE 'deceased'
                    AND status NOT LIKE 'MIA'
                    ORDER BY agent_id ASC
                ";
                $result = $UPLINK->query($query);

                if ($result->num_rows > 0) {

                  while ($row = mysqli_fetch_array($result)) { // rijen printen
                    $xContent .=  "<span class='adm_status'>
                                    <table>
                                      <form method='post' action='index.php?page=status'>";
                    $xContent .=   "<tr>
                                        <th>NAME</th>
                                        <th>SEC CODE</th>
                                        <th>BACKUP</th>
                                    </tr>
                                    <tr>
                                        <td><input type='text' maxlength='28' name='editname' value='" . $row['name'] . "'></td>
                                        <td><input type='text' maxlength='5'  name='editcode' value='" . $row['agent_pin'] . "'></td>
                                        <td><input type='text' maxlength='10' name='editbackup' value='" . $row['backup'] . "'></td>
                                    </tr>
                                    <tr>
                                        <th>STATUS</th>
                                        <th>ORDERS</th>
                                        <th>RANK</th>
                                    </tr>
                                    <tr>
                                        <td>
                                        <select name='editstatus'>";

                              foreach ($status_types AS $stats) {

                                  if ($row['status'] == $stats) {
                                    $SELECTED = "SELECTED";
                                  } else {
                                    $SELECTED = "";
                                  }
                                $xContent .= "<option value=".$stats." ".$SELECTED." >".$stats." </option>";
                              }


                    $xContent .=    "</select></td>
                                        <td><input type='text' maxlength='16' name='editorders' value='" . $row['orders'] . "'></td>
                                        <td><input type='text' maxlength='16' name='editrank' value='" . $row['rank'] . "'></td>
                                    </tr>
                                    <tr style='padding-bottom:8px;'>
                                        <td><input type='submit' name='editsubmit' value='edit'/></td>
                                            <input type='hidden' name='editid' value='" . $row['agent_id'] . "'>
                                    </tr>
                                ";
                    $xContent .=  "</form></table></span>";
                  }

               $result->close();
              } else {
                  $xContent .= "Absolution is simply refusing to give up personnel files.";
              }

            /* CONFIG PAGINA */////////////////////////////////////////////////////////////////
            } else if (isset($_SESSION['maati']) && ($_GET["page"] == "config")) {


              if (isset($_POST["edit"])) {

                $xContent = "<a href=\"index.php?page=config\"><p class=\"hosting center\">&#x25C0; Return to config.</p></a>";

                $edit["L"] = mysqli_escape_string($UPLINK,$_POST['light']);
                $edit["C"] = mysqli_escape_string($UPLINK,$_POST['defaultcolor']);
                $edit["S"] = mysqli_escape_string($UPLINK,$_POST['spaceships']);

                $query = "UPDATE config SET defaultcolor = '".$edit["C"]."', brightness = '".$edit["L"]."', spaceships = '".$edit["S"]."' ";
                $results = $UPLINK->query($query);

                $xcontent .= "<h2>CONFIG succesfully updated.</h2>";

              }

                $xContent = "<a href=\"index.php\"><p class=\"hosting center\">&#x25C0; Return to main</p></a>";

                $query = "SELECT brightness, defaultcolor, spaceships, MALF
                          FROM config
                          LIMIT 1";

                $results = mysqli_fetch_array($UPLINK->query($query));
                  switch($results["brightness"]){
                    case 0: default: $conf["light"] = "Dark"; break;
                    case 1: $conf["light"] = "Medium"; break;
                    case 2: $conf["light"] = "Light"; break;
                  }
                  switch($results["defaultcolor"]){
                    case 0: default: $conf["color"] = "<span class=\"Ye\"> Gubat Yellow </span>"; break;
                    case 1: $conf["color"] = "<span class=\"Cy\"> Hologram Cyan </span>"; break;
                  }
                  switch($results["spaceships"]){
                    case 0: default: $conf["space"] = "Off"; break;
                    case 1: $conf["space"] = "On"; break;
                  }
                    if ($results["MALF"] > 0 ) {
                      $conf["malf"] = "<Span class='blinktext'>MAATI IS WATCHING YOU<br/>MAATI IS WATCHING YOU MAATI IS WATCHING YOU <br/>MAATI IS WATCHING YOU MAATI IS WATCHING YOU MAATI IS WATCHING YOU<br/>MAATI IS WATCHING YOU MAATI IS WATCHING YOU MAATI IS WATCHING YOU MAATI IS WATCHING YOU<br/>MAATI IS WATCHING YOU MAATI IS WATCHING YOU MAATI IS WATCHING YOU<br/>MAATI IS WATCHING YOU MAATI IS WATCHING YOU<br/>MAATI IS WATCHING YOU</span><br/>";
                    } else { $conf["malf"] = "System is online."; }

                  $xContent .= "<h3>CURRENT SETTINGS:</h3>
                    <p>
                      Brightness &nbsp;&nbsp;&nbsp; - ".$conf["light"]."<br/>
                      Color Scheme &nbsp; - ".$conf["color"]."<br/>
                      SpaceshipsMode - ".$conf["space"]."<br/><br/>
                      ".$conf["malf"]."
                    </p>
                  ";

                  $xContent .= "<form method='post' action='index.php?page=config&update=true'>
                    <table cellspacing=\"6px\">

                      <tr>
                        <th>Brightness</th>
                        <td>
                          <select name='light' style=\"max-width: 200px;\">
                            <option value='0'>Dark (default)</option>
                            <option value='1'>Medium</option>
                            <option value='2'>Light</option>
                          </select>
                        </td>
                      </tr>

                      <tr>
                        <th>Default Color</th>
                        <td>
                          <select name='defaultcolor' style=\"max-width: 200px;\">
                            <option value='0'>Yellow (default)</option>
                            <option value='1'>Cyan</option>
                          </select>
                        </td>
                      </tr>

                      <tr>
                        <th>Spaceship mode</th>
                        <td>
                          <select name='spaceships' style=\"max-width: 200px;\">
                            <option value='0'>No (default)</option>
                            <option value='1'>Yes</option>
                          </select>
                        </td>
                      </tr>

                      <tr>
                      <td colspan=\"2\"><input type=\"submit\" name=\"edit\" value=\"SAVE SETTINGS\" /></td>
                      </tr>

                    </table>
                  </form>";

            } else {
             /* NIKS IS VALID */
             $xContent = "<a href=\"index.php\"><p class=\"hosting center\">&#x25C0; Return to main</p></a>";
             $xContent .= '<h1>SOMETHING IS VERY WRONG</h1>';
            }

            if (isset($_SESSION['maati'])) {
             /* logout button */
             $xContent .= "<h4><a class=\"critical\" href=\"index.php?logout\">&#10060; sign out</a></h4>";

             echo $xContent;
            }



            ?>
        </div>
    </div>
</body>
</html>
