<?php
    require_once('_include/config.php');

    /* max ///////// */
    $query = "  SELECT status
                FROM agents
                WHERE status NOT LIKE 'inactive'
                AND status NOT LIKE 'MIA'
                AND status NOT LIKE 'deceased'
    ";
    $result = $UPLINK->query($query);

        $max_users = mysqli_num_rows($result);
        $active_users = mysqli_num_rows($result);
        while ($row = mysqli_fetch_array($result)) {
            if ($row['status'] == 'offline' || $row['status'] == 'unknown') {
                $active_users = $active_users - 1;
            }
        }

    switch ($active_users) {
        case 0:
        case 1:
        case 2:
            $activity = 'Rd';
            break;
        case 3:
        case 4:
            $activity = 'Or';
            break;
        default:
            $activity = 'Ye';
    }
?>

<script>

var navigateInterval = false;
$(document).ready(function(){

  /*if (!navigateInterval) {
      navigateInterval = setInterval(function(){
      keuze = 'status';

      clearInterval(navigateInterval);
      navigate();
    }, 60000);*/

    /*$(".fnc").one("click", function (){ */

    function navigate(){
        $('#loadtext').html("&nbsp;[ <span class='Ye'>808 'GUBAT BANTAY'</span>  ] :: <span class='blinktext'>LOADING... &#x231B;</span>");
        $.get(keuze + ".php")
          .done(function(){
            $("#screen #container_outside #container_inside #right").empty();
              $("#screen #container_outside #container_inside #right").load(keuze + ".php");
          })
          .fail(function(){
            $("#screen #container_outside #container_inside #right").empty();
              $("#screen #container_outside #container_inside #right").load("404_R.php");
          });
    };

    /* // standaard functies voor navigeren // ==   $(".fnc").click(function(){  */
    $(".fnc").one("click", function (){
        keuze = $(this).attr('id');
        navigate();
    });

    $(".imgfolder").click(function(){
        keuze = $(this).attr('id');
        navigate();
    });

});
</script>

<div id="loading">
  <!--<img src="_images/loops/crypto.gif"/>-->
    <img src="_images/transfer_halftime.gif"/>
</div>

<div id="row3">
    <div class="bar">
        <div class="bar_left" style="width:70%;">
            HIMAWARI\DATA ... <span class="Cy">SCAN $root-</span><span class="Ye">&MAATI_local&</span><span class="Cy">\LAZARUS_INVESTMENTS\personel\ACTIVE.mdm</span>
        </div>
        <div class="bar_right" style="width:20%;"><span class="fnc Ye" id="status">&#8635; RESET.</span> WINDOW</div>
    </div>

    <!--<img class="toprightico" src="/_images/loops/6.gif"/>-->

    <p> ..$\\ <span class="fnc Ye" id="default_right">ROOT_RETURN();</span> <span style="font-size:75%;">\\ returns to root</span></p>

    <h2 id="loadtext">&nbsp;[ <span class="Ye">808 'GUBAT BANTAY'</span> ACTIVE USERS : <span class="<?echo$activity;?>"><?echo$active_users;?></span> / <span class="Ye"><?echo$max_users;?></span> ]</h2>
</div>

<div id="row2">

<?php
    $blockNumber    = 0;
    $volgorde       = 0;
    $newline        = 0;

    $query =    "SELECT name, rank, status, orders, backup
                FROM agents
                WHERE status NOT LIKE 'inactive'
                    AND status NOT LIKE 'MIA'
                    AND status NOT LIKE 'deceased'
                ORDER BY agent_id ASC
    ";
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

            /* item blocks maken */
            echo    '<div class="item triplet s' . $volgorde . ' container-border">
                <h3>' . $row['name'] . '</h3>
                <p>Rank: ' . $row['rank'] . '</p>
                    <table class="statustable">
                        <tr>
                            <td>STATUS</td>
                            <td> :</td>
                            <td><span class=' . $row['status'] . '>' . $row['status'] . '</span></td>
                        </tr>
                        <tr>
                            <td>CUR. ORDERS</td>
                            <td> :</td>
                            <td>' . $row['orders'] . '</td>
                        </tr>
                        <tr>
                            <td>LAST BACKUP</td>
                            <td> :</td>
                            <td>' . $row['backup'] . '</td>
                        </tr>
                    </table>
                </div>
            ';

            if ($newline == 1) {
            /* Maakt nieuwe rij aan NA blocknumber 3 is geprint. */
                echo '</div><div id="grid">';
            /*  hier reset bloknummer naar 0, en word ge ++'d naar 1 bij volgende result. Ook newline moet gereset. */
                $newline        = 0;
                $blocknumber    = 0;
            }

        } /*einde block loop*/

        echo    '<div class="item triplet s4 container-border">
            <h3>DECEASED // MIA</h3>
            <div class="imgfolder smallfolder" id="rip"></div>
        </div>';

    } else {
        echo '<div id="grid"><h3>WARNING: UPLINK IS DOWN. CALL SYSADMIN MAATI - ASAP</h3>';
    }
    echo '</div>'; /* sluit laatste GRID af */
    $result->close();

?>

</div>

<?
$UPLINK->close();
?>
