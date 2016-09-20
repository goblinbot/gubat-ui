<?php
    require_once('_animate/glitch_text.php');
    require_once('_include/content.php');
?>
<script>
$(document).ready(function(){

    $(".fnc").click(function(){
        keuze = $(this).attr('id');
        $.get(keuze + ".php")
            .done(function(){
              $("#right").empty();
                $("#right").load(keuze + ".php");
            })
            .fail(function(){
              $("#right").empty();
                $("#right").load("404_R.php");
            });
    });

});
</script>

<div id="loading">
    <img src="_images/transfer_halftime.gif"/>
</div>

<div id="row2">
    <div class="bar">
        <div class="bar_left" style="width:60%;"><? echo $topbar404; ?></div>
        <div class="bar_right"><span class="fnc Ye" id="default_right">RESET.</span> PROGRAM</div>
    </div>

    <div class="half4">
        <a href="index.php"> <? echo $ccGLITCH . $aGLITCH . "404 not found." . $GLITCHz; ?> </a>
    </div>
    <div class="half4" style="margin-left:-33%;text-align:right;">
        <p>An employee will find you shortly. <span class="Ye">Trust us</span>.</p>
    </div>
</div>
