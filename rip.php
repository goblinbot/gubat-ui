<?
    require_once('_include/config.php');
?>
<script>
$(document).ready(function(){

    $(".fnc").click(function(){
        $('#loadtext').html("&nbsp;[ <span class='Ye'>MIA </span>//<span class='Ye'> DECEASED</span> ] :: <span class='blinktext'>LOADING... &#x231B;</span>");
        keuze = $(this).attr('id');
        $.get(keuze + ".php")
            .done(function(){
                $("#screen #container_outside #container_inside #right").load(keuze + ".php");
            })
            .fail(function(){
                $("#screen #container_outside #container_inside #right").load("404_R.php");
            });
    });

});
</script>

<div id="loading">
    <img src="_images/transfer_halftime.gif"/>
</div>


<div id="row2">

    <div class="bar">
        <div class="bar_left" style="width:70%;">
            HIMAWARI\DATA ... <span class="Cy">SCAN $root-</span><span class="Ye">&MAATI_local&</span><span class="Cy">\LAZARUS_INVESTMENTS\personel\MIA.mdm</span>
        </div>
        <div class="bar_right" style="width:20%;"><span class="fnc Ye" id="rip">&#8635; RESET.</span> WINDOW</div>
    </div>
    <p>..$\\ <span class="fnc Ye" id="status">STATUSPAGE_RETURN();</span> <span style="font-size:75%;">\\ returns to status</span></p>

    <h2 id="loadtext">&nbsp;[ <span class="Ye">MIA </span>//<span class="Ye"> DECEASED</span> ]</h2>

<?php
    $blockNumber    = 0;
    $volgorde       = 0;
    $newline        = 0;

    $query =    "SELECT name, callsign, status, orders, rip_timestamp
                FROM agents
                WHERE status LIKE 'deceased'
                OR status LIKE 'MIA'
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
                $status = $row['status'];
                    if (strpos($status, 'deceased') !== false) {
                        $statusCol = '<span class="critical">';
                    } else {
                        $statusCol = '<span class="unknown">';
                    }
                $callsign = $row['callsign'];
                if ($callsign != null) {
                    $callsign = '<span class="Ye">&#39;' . $callsign . '&#39;</span>';
                    $callsign = strtoupper($callsign);
                } else {
                   $callsign = '-';
                }

                $name = $row['name'];
                    if (strpos($name, '&ERR&') !== false) {
                        $name = '<span class="Gy">' . $name . '</span>';
                    }

            /* bepaald de animatie laad volgorde; als deze 4 word zet ie hem terug naar 1 ivm nieuwe rij. */
            if ($volgorde > 3) {$volgorde = 1;}

            /* item blocks maken */
            echo    '<div class="item triplet s' . $volgorde . ' container-border">
                <h3>' . $name . '</h3>
                <p>&nbsp;' . $callsign . '</p>
                    <table class="statustable">
                        <tr>
                            <td>STATUS</td>
                            <td> :</td>
                            <td>' . $statusCol . $status . '</span></td>
                        </tr>
                        <tr>
                            <td>LAST KNOWN ORDERS</td>
                            <td> :</td>
                            <td>' . $row['orders'] . '</td>
                        </tr>
                        <tr>
                            <td>TIMESTAMP</td>
                            <td> :</td>
                            <td>' . $row['rip_timestamp'] . '</td>
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

        echo    '<div class="item twin s4 container-border">
                <h3><span class="Rd blinktext">&ERR:NOTFOUND\</span><span class="Or">NAME</span></h3>
                <p>&#39;DUCK//</p>
                <p>STATUS : <span class="Gy">~$MARKEDFORDELETE</span></p>
                <p>PLEASE CONTACT SYSADM<span class="Or blinktext">QUACK</span>IN</p>
        </div>
        <div class="item twin s4">&nbsp;</div>
        <div class="item twin s4">&nbsp;</div>
        ';

    } else {
        echo '<div id="grid"><h3>WARNING: UPLINK IS DOWN. CALL SYSADMIN MAATI - ASAP</h3>';
    }
    echo '</div>'; /* sluit laatste GRID af */
    $result->close();

?>

</div>
