<?php
    require __DIR__.'/../_include/content.php';
    require __DIR__.'/../_include/config.php';

    session_start();


    /* Huizingfilter */
    $triggers    = array('meme','tp:/','src','<','>','><','.js',';','$');
    $error       = false;
    $status      = "";

    /*BEGIN HONDERD IF STATEMENTS*/

if (isset($_GET['logout'])) {

    session_unset();
    session_destroy();
    unset($_POST["submitKeycode"]);
    unset($_SESSION['login']);
    unset($_SESSION['name']);
    unset($_SESSION['status']);
    unset($_SESSION['orders']);
    header("location: index.php");
    exit();

} else if (isset($_GET['update'])){

$query  =   "SELECT name, agent_pin, status, orders, backup
                        FROM agents
                        WHERE agent_pin LIKE '".$_SESSION['login']."'
                            AND status NOT LIKE 'inactive'
                            AND status NOT LIKE 'MIA'
                            AND status NOT LIKE 'DECEASED'
                        LIMIT 1
            ";
            $result = $UPLINK->query($query);
                $row = mysqli_fetch_array($result);
                    $_SESSION['login']  = mysqli_escape_string($UPLINK, $row['agent_pin']);
                    $_SESSION['user']   = mysqli_escape_string($UPLINK, $row['name']);
                    $_SESSION['status'] = mysqli_escape_string($UPLINK, $row['status']);
                    $_SESSION['orders'] = mysqli_escape_string($UPLINK, $row['orders']);
                    $_SESSION['backup'] = mysqli_escape_string($UPLINK, $row['backup']);
                        session_write_close($loggedin);
                        header("location: index.php");
                            exit();

} else if (!isset($_SESSION['login'])) {
    $loginStatus = "&nbsp;";

    if (isset($_POST["submitKeycode"])) {
        /*escape de keycode voordat we hem gaan gebruiken. $submitKeycode is vanaf nu de waarde waar we op checken. */
        $submitKeycode = mysqli_escape_string($UPLINK,$_POST["submitKeycode"]);
            unset($_POST["submitKeycode"]);

        // TOEVOEGEN : GEEN STRINGS ALLOWED !!!!! ///////////////////////////////////////////////////////////
        if (strlen($submitKeycode) != 5) {
            $loginStatus = "Nice try, meatsack.";
        } else if (!ctype_digit($submitKeycode)) {
            $loginStatus = "Nice try, meatsack.";
        } else {
            $query  =   "SELECT name, agent_pin, status, orders, backup
                        FROM agents
                        WHERE agent_pin LIKE '".$submitKeycode."'
                            AND status NOT LIKE 'inactive'
                            AND status NOT LIKE 'MIA'
                            AND status NOT LIKE 'DECEASED'
                        LIMIT 1
            ";
            $result = $UPLINK->query($query);
            $row = mysqli_fetch_array($result);

            if ($result->num_rows > 0) {

                $_SESSION['login']  = mysqli_escape_string($UPLINK, $row['agent_pin']);
                $_SESSION['user']   = mysqli_escape_string($UPLINK, $row['name']);
                $_SESSION['status'] = mysqli_escape_string($UPLINK, $row['status']);
                $_SESSION['orders'] = mysqli_escape_string($UPLINK, $row['orders']);
                $_SESSION['backup'] = mysqli_escape_string($UPLINK, $row['backup']);
                session_write_close($loggedin);

                    $userN = "Welcome Back";
                    $agentName      = $_SESSION['user'];
                    $agentStatus    = $_SESSION['status'];
                    $agentOrders    = $_SESSION['orders'];
                    $agentBackup    = $_SESSION['backup'];

            } else {
                $loginStatus = "Login failed.";
            }
            $result->close();
        }
    } else {

        $loginStatus = "Login.";
    } /*DEFAULT 2*/

} else if(isset($_SESSION['login'])) {
    $userN = "Welcome Back";

    $agentName      = $_SESSION['user'];
    $agentStatus    = $_SESSION['status'];
    $agentOrders    = $_SESSION['orders'];
    $agentBackup    = $_SESSION['backup'];

    if (isset($_POST['editsubmit'])) {
            if(empty($_POST["editorders"])) {
                $editOrders = "none";
            } else {
                $editOrders = mysqli_escape_string($UPLINK, strtolower($_POST['editorders']));
            }
                if(empty($_POST["editstatus"])) {
                    $editStatus = "unknown";
                } else {
                    $editStatus = mysqli_escape_string($UPLINK, strtolower($_POST['editstatus']));
                }

                $newLen = strlen($editOrders);
                $codLen = strlen($editStatus);
                    if ($newLen > 20) {
                        $error = true;
                    } elseif ($codLen > 10) {
                        $error = true;
                    }

                foreach ($triggers as $trigger) { // looped door de huizingtriggertriggertrigger
                    if (strpos($editOrders,$trigger) !== false) {
                        $error = true;
                    } elseif (strpos($editStatus,$trigger) !== false) {
                        $error = true;
                    }
                }

                if ($error == false && isset($_POST['editstatus'])) {

                    if ($UPLINK->query("UPDATE agents SET orders = '".$editOrders."', status = '".$editStatus."' WHERE name LIKE '".$agentName."' ")) {
                        $UPLINK->close;
                        header("Location: index.php?update");
                        exit();
                    }
                } else {
                    echo "An error has occured.";
                }
    } /* EDIT */

} else {

    $loginStatus = "Login.";
} /*DEFAULT 1*/



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
            if (!isset($_SESSION['login'])) { ?>
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
            <? } else if (isset($_SESSION['login'])) { ?>
                <h3> <?echo $agentName;?>  </h3>
                <table style="margin-bottom:8px;">
                    <tr>
                        <td>status</td>
                        <td><? echo ": <span class='".$agentStatus."'>".$agentStatus."</span>"; ?></td>
                    </tr>
                    <tr>
                        <td>current orders</td>
                        <td><? echo ": ".$agentOrders; ?></td>
                    </tr>
                    <tr>
                        <td>last backup</td>
                        <td><? echo ": <span class='Alt'>".$agentBackup."</span>"; ?></td>
                    </tr>
                </table>

                <h3>edit orders / status.</h3>

                <table>
                    <form method="post" action="index.php">
                        <tr>
                            <th>orders (max. 19)</th>
                            <th colspan="2">status (<? echo $agentStatus;?>)</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" maxlength="19" name="editorders" value="<? echo $agentOrders;?>"/>
                            </td>
                            <td>
                                <select name="editstatus">
                                  <?php
                                    $stat_types = array(
                                      0 => 'online',
                                      1 => 'offline',
                                      2 => 'critical',
                                      3 => 'offworld',
                                      4 => 'unknown',
                                      5 => 'hosting',
                                    );

                                    foreach ($stat_types AS $stats) {

                                        if ($stats == $agentStatus) {
                                          echo "HAHA PIEMELS";
                                          $SELECTED = "SELECTED";
                                        } else {
                                          $SELECTED = "";
                                        }
                                      echo "<option value=\"$stats\" ".$SELECTED." >".$stats." </option>";
                                    }
                                  ?>
                                </select>
                            </td>
                            <td>
                                <input type="submit" name="editsubmit" value="edit"/>
                            </td>
                        </tr>
                    </form>
                </table>

                <p><a class="critical" href="index.php?logout">sign out</a></p>

            <? } else { ?>
                <h1>SOMETHING IS VERY WRONG</h1>
            <? } ?>
        </div>
    </div>
</body>
</html>
