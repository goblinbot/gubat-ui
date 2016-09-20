<?php
    require_once('_include/config.php');

    $stat_types = array(
      0 => array('range_kills','Top Gunner','Ranged kills'),
      1 => array('melee_kills','Huge Guts','Melee kils'),
      2 => array('misc_kills','Always prepared','Misc. Kills'),
      3 => array('non_lethals','Professional','Non-lethal takedowns'),
      4 => array('blood_donated','Reverse-Vampire','Liters of blood donated'),
      5 => array('medbay_visits','Cheated Death','Emergency surgeries had'),
      6 => array('duels_won','Master Duelist','Duel victories'),
      7 => array('angry_nobles','Somehow Alive','Times yelled at by nobles'),
      8 => array('accidents','Accursed','Serious accidents'),
      9 => array('bad_choices','Tactical Genius','Really bad decisions made'),
      10 => array('expl_taken','Firefly','Times caught in explosions'),
      11 => array('pol_inc','Rebellious Nature','Political incidents involved in'),
    );

    $award_icons = array(
      0 => '&#5853;',
    )

?>


<script>
$(document).ready(function(){

    $(".fnc").click(function(){

        keuze = $(this).attr('id');
        $('#loadtext').html("<span class='Ye blinktext'>LOADING... &#x231B;</span> PLEASE STAND BY.");

        $.get(keuze + ".php")
            .done(function(){
              $("#screen #container_outside #container_inside #right").empty();
                $("#screen #container_outside #container_inside #right").load(keuze + ".php");
            })
            .fail(function(){
              $("#screen #container_outside #container_inside #right").empty();
                $("#screen #container_outside #container_inside #right").load("404_R.php");
            });

    });

    $(".fncSB").click(function(){
        keuze = $(this).attr('id');
        $('#loadtext').html("<span class='Ye blinktext'>LOADING AGENT STATS. &#x231B;</span> PLEASE STAND BY.");

        $.get("scoreboard.php")
          .done(function(){
            $("#screen #container_outside #container_inside #right").empty();
              $("#screen #container_outside #container_inside #right").load("scoreboard.php?agent=" + keuze );
          })
    });

});
</script>

<div id="loading">
  <!--<img src="_images/transfer_halftime.gif"/>-->
  <!--<img src="_images/loops/tick.gif"/>-->
  <img src="_images/loops/crypto.gif"/>
</div>

<div id="row2">
    <div class="bar">
        <div class="bar_left" style="width:70%;">
            HIMAWARI\DATA ... <span class="Cy">SCAN $root-</span><span class="Ye">&MAATI_local&</span><span class="Cy">\LAZARUS_INVESTMENTS\MA4..\*</span>
        </div>


        <?
        if ($_GET["agent"]) {
          echo '<div class="bar_right" style="width:10%;">
                  <p class="refresh fncSB Ye" id="'.$_GET["agent"].'">REFRESH &#8635;</p>
                </div>';
        } else { /* geen agent aangeklikt */
          echo '<div class="bar_right" style="width:10%;">
                  <p class="refresh fnc Ye" id="scoreboard">REFRESH &#8635;</p>
                </div>';
        } ?>

    </div>


    <p> ..$\\ <span class="fnc Ye" id="default_right">ROOT_RETURN();</span> <span style="font-size:75%;">\\ returns to root</span>
      <? if ($_GET["agent"]) { ?>&nbsp; <span class="fnc Ye" id="scoreboard">>>SCOREBOARD_RETURN</span> <? } ?>
    </p>

    <h3 id="loadtext" style="margin-left: 16px;">[<span class="Ye">808</span>] SCOREBOARD</h3>
    <br/>
    <div class="bar">ANIM 808 - GUBAT BANTAY <span class="Ye">LEADERBOARDS</span>, JUDGED PROUDLY && UNFAIRLY BY YOURS TRULY, <span class="Ye">node(Providence)</span></div>


<div id="scoreboard">
  <?php
  /* begin scoreboard
      als een user geselecteerd is, open zijn stats */
  if ($_GET["agent"]) {

/*a.name, s.range_kills, s.melee_kills,
              s.misc_kills, s.non_lethals, s.blood_donated, s.medbay_visits,
              s.duels_won, s.angry_nobles, s.accidents, s.bad_choices*/


    // laat de select query de array uitlezen voor maximaal autisme
    $xSTATS = "a.name";
    foreach ($stat_types AS $stats) {$xSTATS .= ", s.".$stats[0];}

    $query = "SELECT ".$xSTATS."
              FROM stats s
              INNER JOIN agents a
              ON s.agent_id = a.agent_id
              WHERE s.agent_id = '".$_GET["agent"]."' ";
    $result = $UPLINK->query($query);

    echo '<div id="grid">';

    if ($result->num_rows > 0) {
      $userStats = mysqli_fetch_array($result);

      $xContent  = "<h2>&#x2694;&nbsp;".$userStats["name"]." </h2>
                    <p style=\"margin: 0 auto 4px auto;\">Please note that these stats are recorded during specific, small periods of time,
                    and thus are <span class=\"Alt\">not</span> a final representation of an agent's contribution to the corp.</p>";

      $xContent .= "</div><div id=\"grid\" style=\"margin-top: 0px;\">";

      $xContent .= "<div class=\"item triplet s1\" style=\"min-width:200px;\"><span class=\"statsOverview\">";

      // loop door array stat_description heen, print voor elke query result 1
      for ($i = 0; $i < count($userStats); $i++) {
        $xContent .= "<p>".$stat_types[$i][2]."</p>";
      }

      $xContent .=  "</span></div><div class=\"item quad s2\"><span class=\"statsOverview center\">";

      // loop door results heen, print voor elke query result 1
      for ($i = 1; $i < count($userStats); $i++) {
        $xContent .= "<p>".$userStats[$i] ."</p>";
      }

      $xContent .= "</span></div>";

      // scoreboard : awards printen in een blokje.
      $xContent .=
      "<div class=\"item full s3\" style=\"min-width:360px;\">
        <span class=\"statsOverview\">
          <h3>Awards</h3>";

          $query = "SELECT ".$xSTATS."
                    FROM stats s
                    INNER JOIN agents a
                    ON s.agent_id = a.agent_id
                    WHERE s.agent_id = '".$_GET["agent"]."' ";
          $result = $UPLINK->query($query);  






      $xContent .=
      "</span>
      </div>";



    /* einde if result>0*/
    } else {
        $xContent = '<div id="grid"><h3>WARNING: INVALID AGENT SELECTED. CALL SYSADMIN MAATI.</h3>';
    }
    echo $xContent . '</div>';
  $result->close();

  // als geen users geselecteerd, open userblokjes en de top8.
  } else { ?>

    <h4>&#x1F464; INDIVIDUALS</h4>
    <?php
      $blockNumber    = 0;
      $volgorde       = 0;
      $newline        = 0;

      $query =    "SELECT agent_id, name
                    FROM agents
                      WHERE status NOT LIKE 'inactive'
                        AND status NOT LIKE 'MIA'
                        AND status NOT LIKE 'deceased'
                          ORDER BY agent_id ASC ";
      $result = $UPLINK->query($query);

      if ($result->num_rows > 0) {
        /* maakt grids aan per 3*/
        if ($blocknumber == 0 ) {
            echo '<div id="grid">';
        }

        /*begin door blocks te lopen*/
        while ($row = mysqli_fetch_array($result)) {

            $blocknumber++;
            $volgorde++;

            /* NEWLINE word aan het einde gebruikt om een nieuwe rij te printen en blocknummer te resetten naar 1, 2, 3. */
            if ($blocknumber == 3) {
                $newline = 1;
            }

            /* bepaald de animatie laad volgorde; als deze 4 word zet ie hem terug naar 1 ivm nieuwe rij. */
            if ($volgorde > 3) {$volgorde = 1;}

            $voornaam = explode(" ", $row['name']);

            /* item blocks maken */
            echo   '<div id="'. $row['agent_id'] .'"
                    class="item fncSB triplet s' . $volgorde . '">
                    <p style="text-align: center;">' . $row['name'] . '</p>
                    </div>';

            if ($newline == 1) {
            /* Maakt nieuwe rij aan NA blocknumber 3 is geprint. */
              echo '</div><div id="grid">';
            /*  hier reset bloknummer naar 0, en word ge ++'d naar 1 bij volgende result. Ook newline moet gereset. */
              $newline        = 0;
              $blocknumber    = 0;
            }
        } /*einde block loop*/

      $result->close();
      /* einde if result>0*/
    } else {
        echo '<div id="grid"><h3>WARNING: UPLINK IS DOWN. CALL SYSADMIN MAATI - ASAP</h3>';
    }
    echo '</div>'; /* sluit GRID af */
  ?>
  <h4>&#x26E8; CURRENT TOP SCORES</h4>
    <div id="grid">
      <div class="item full s4">
        <?
        $xContent  = "<h3>Leaderboards: loaded</h3>";

        if (isset($UPLINK) && isset ($stat_types)) {
          $i = 0;

          $xContent .= "<table class=\"score_totals\">
          <tr>
            <th>TITLE</th>
            <th>AGENT</th>
            <th colspan=\"2\">SCORE</th>
          </tr>";
          foreach ($stat_types AS $stats) {

            $query = "
              SELECT agents.name, agents.agent_id, stats.".$stats[0]."
              FROM agents, stats
              WHERE agents.agent_id = stats.agent_id
              ORDER BY stats.".$stats[0]." DESC
              LIMIT 1
            ";
            $stats_query_results = mysqli_fetch_array($UPLINK->query($query), MYSQLI_ASSOC);

            /* print de variables in de volgende volgorde: $.TITEL > QUERY:USERNAME > QUERY:SCOREVELD > $.DESCRIP. */
            $xContent .= "<tr>";
              $xContent .= "<td>". $stat_types[$i][1] ."</td>";
              $xContent .= "<td>" . strtolower($stats_query_results["name"]) ."</td>";
              $xContent .= "<td class=\"center\">". $stats_query_results[$stats[0]] ."</td>";
              $xContent .= "<td>". $stat_types[$i][2]. "</td>";
            $xContent .= "</tr>";
            $i++;
          }
          $xContent .= "</table>";

        } else {
          $xContent = "<h4 style=\"margin-left:8px;\">Could not load leaderboards.<br/ >Please check if Maati is not dead or worse.</h4>";
        }

        echo $xContent;

        // debug momentje
        /*echo "<pre>";
        var_dump($statsArray);
        echo "</pre>";*/
        ?>
      </div>
    </div>

    <?
  } // einde ELSE dus bij BLANKE GET ?>
</div> <!-- einde scoreboard -->

</div>
