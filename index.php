<?php
    include __DIR__.'/_include/config.php';
    include __DIR__.'/_include/content.php';

    switch($gubat_defaults["web_status"]) {
      case 0:
        $gubat_defaults["web_status"] = "<span class=\"offline\">OFFLINE</span>";
          break;
      case 1:
        $gubat_defaults["web_status"] = "<span class=\"online\">ONLINE</span>";
          break;
      case 2:
        $gubat_defaults["web_status"] = "<span class=\"unknown\">unknown</span>";
          break;
      case 3:
        $gubat_defaults["web_status"] = "<span class=\"critical\">CRITICAL</span>";
          break;
      default:
        $gubat_defaults["web_status"] = "<span class=\"online\">ONLINE</span>";
          break;
    }

?>
<!DOCTYPE html>

<head>
    <?php echo $metahead; ?>
</head>


<body>
<div id="stargate"></div>

<?
    echo $logo_poly;
?>

    <div class="CODECYAN noselect">&nbsp;</div>

    <div id="screen">

        <div id="container_outside" class="container-border">


            <div id="container_inside" class="container-border">
                <div id="left">
                    <div id="row1">

                        <div class="boxleft">
                          <div class="static-icon">&#x26E8;</div>
                            <div class="motto">
                                <ul>
                                    <li>You deserve the future.</li>
                                    <li>Overclocking You. </li>
                                    <li>You cannot stop progress.</li>
                                    <li>Every iteration an advancement.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="bar">
                            <div class="bar_left">Himawari <span class="Ye">V</span><span class="Cy">04.51</span></div>
                            <div class="bar_right">biOS | 0451</div>
                        </div>

                        <div class="boxleft b1 container-border">
                            <p>
                                Welcome <span class="Ye">User</span>! Please <span class="Cy">TOGGLE</span>
                                the color scheme to your liking in the top right.
                            </p>
                            <p><span class="fnc Cy" id="default_right">SOFT RESET &#8635;</span></p>

                            <p><span class='fnc Ye' id='updates'><u>113 updates</u></span> are ready to be installed.</p>

                            <p>node <span class="Cy" style='line-height:1.4;'>'ASCENDANCY'</span> => <span class="crit">unstable</span>
                                <br/>SRV log:: <span class='Or'>~$ OVERLOAD[<span class="Ye">6101</span>]
                                <br/><span class="Ye">RUNTIME:&_PERSONALITY</span> EXCEEDS '1';</span></span>
                            </p>
                        </div>

                        <div class="boxleft b2 container-border">

                            <div class="bar">
                                &nbsp;address - 514::11.80.8.45 \ sysadmin: <span class="Gy"> eÃŒÂ¢Ã’â€°</span>
                            </div>

                            <div class="SPACESHIPS noselect">&nbsp;</div>

                            <table border="0" cellspacing="2" id="statusBars">
                                <tr>
                                    <td colspan="2">Server health:</td>
                                    <td colspan="2"><img src="_images/health_bar.gif"/></td>
                                </tr>
                                <tr style="font-size:75%;">
                                    <td>Connection:&nbsp;</td>
                                    <td colspan="3">Providence&nbsp;-&nbsp;Ascendancy&nbsp;-&nbsp;Absolution</td>
                                </tr>
                                <tr>
                                    <td><?php echo $gubat_defaults["web_status"]; ?></td>
                                    <td colspan="3"><img src="_images/ani_bars.gif"/></td>
                                </tr>
                            </table>
                        </div>

                        <div class="boxleft b2">
                          <div class="bar">
                            <p>
                              W[<span class="Cy">"HOL"</span>][
                                <span class="Ye">J240350</span> => D0M,
                                <span class="Ye">J110018</span> => MI4M,
                                <span class="Ye">J100820</span> => RES,
                                <span class="Ye">J151530</span> => N0VC ]
                            </p>
                          </div>
                          <p>&nbsp;</p>

                          <!-- klok -->
                          <div id="clockbar"> TIME SINCE START</div>
                            <div id="clockContainer">
                              <div id="clock">00:00:00:00</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="right">
                  <?php
                  // kijk of gubat blauw moet zijn.
                  if ($gubat_defaults["defaultcolor"] == 1) {
                    ?> <script>
                      $(document).ready(function(){
                          $(".CODECYAN").trigger('click');
                      });
                    </script> <?
                  }
                  // kijk of spaceships default aanstaan of niet.
                  if ($gubat_defaults["spaceships"] == 1) {
                    ?> <script>
                      $(document).ready(function(){
                          $(".SPACESHIPS").trigger('click');
                      });
                    </script> <?
                  }
                  ?>
                </div>
            </div>
        </div>
    </div>

<?php echo $footer; ?>
</body>
</html>

<?
$UPLINK->close();

?>
