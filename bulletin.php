<script>
$(document).ready(function(){

    function navigate() {
        $('#loadtext').html("<span class='Ye'>LOADING... &#x231B;</span> PLEASE STAND BY.");

        $.get(keuze + ".php")
            .done(function(){
                $("#screen #container_outside #container_inside #right").load(keuze + ".php");
            })
            .fail(function(){
                $("#screen #container_outside #container_inside #right").load("404_R.php");
            });
    };

    /* // standaard functies voor navigeren // */
    $(".fnc").click(function(){
        keuze = $(this).attr('id');
        navigate();
    });

    $(".page1 .bulletinPage").click(function(){
      $(".page1").hide();
      $(".page2").show();
    });

    $(".page2 .bulletinPage").click(function(){
      $(".page2").hide();
      $(".page1").show();
    });

});
</script>

<div id="loading">
  <img src="_images/loops/circuit.gif"/>
    <!--
      <img src="_images/transfer_halftime.gif"/>
    -->
</div>

<div id="row2">
  <div class="bar">
      <div class="bar_left" style="width:70%;">
          HIMAWARI\DATA ... <span class="Cy">SCAN $root-</span><span class="Ye">&MAATI_local&</span><span class="Cy">\&#x2615;</span>
      </div>
      <div class="bar_right" style="width:20%;"><span class="fnc Alt" id="bulletin">&#8635; REFRESH.</span> BULLETIN</div>
  </div>
  <p> ..$\\ <span class="fnc Ye" id="default_right">ROOT_RETURN();</span> <span style="font-size:75%;">\\ returns to root</span></p>


    <h3 id="loadtext" style="margin: 0 0 0 16px;">LOADING... <span class="Ye">COMPLETE</span>.</h3>


<div class="bulletin grid">

  <h2 class="bulletinTitle">:: Corp Bulletin ::</h2>

  <div class="page1">

    <h2 class="bulletinPage"><span class="Ye">1/2</span> &#x25B6;</h2>

    <div class="buItem">
      <h3>&#x2692; 'BRAIN IN A BOX' IS NOW <span class="Or">ONLINE</span></h3>
      <p>Internal Communications now operate by bluespace beacon. We have taken the liberty of updating <b>bionics && comm. devices</b> during the graveyard shift.</p>
    </div>

    <div class="buItem">
      <h3><span class="critical">&nbsp; &#x26A0; ANIM 807 &nbsp;</span></h3>
      <p>15 agents of ANIM 807 were stationed on what is now our new colony. They have been gifted to Khomar and are to be located. <span class="Alt">This is a high priority.</span>
        Not only is the honour of the 15 lost Karangalan at stake, but also the honour of valued allies.</p>
      <p>suggestion: trace their tracking implants. - Tangkay Subal</p>
    </div>

    <div class="buItem">
      <h3>&#x2694; DOCTRINE UPDATE</h3>
      <ul>
        <li>NEW ARMOR MATERIALS - will be introduced&&used.</li>
        <li>BOARDING TRAINING - Date to be announced. This is possibly a joint op.</li>
      </ul>
    </div>

    <div class="buItem">
      <h3>&#10012; REQUEST FROM: PANDAC CATAMBAY</h3>
      <p>Sir Catambay desires personal contact with 'Drake Agathi'. <br /> Please keep an eye open for said individual and point him/her in the right direction.</p>
    </div>

  </div>

  <div class="page2">

    <h2 class="bulletinPage">&#x25C0; <span class="Ye">2/2</span></h2>

    <div class="buItem">
      <h3>&#10012; SCOREBOARD</h3>
      <p><i>"Idle hands syndrome"</i> is the third highest cause of summary executions, therefor, we proudly announce the scoreboard.</p><p>Beating challenges, impossible odds, showing strong initiative and honorable behaviour will be rewarded with a point system and bragging rights.</p>
    </div>

    <div class="buItem">
      <h3>&#x26A0; ECOFORM SATELITE</h3>
        <p>
          DO NOT ATTEMPT TO ACCESS THE SATELITE.<br/>
          It is potentially armed and pointed towards our direction and has <strong>CLASS 5</strong> digital security, connected to off-world networks. The Eos IT team is currently stuck on this.
        </p>
        <p><span class="Or">Suggestion:</span> Take Vespa class shuttle , board, disable. The Pendzal/Aquila have pilots + EODs.</p>
    </div>

    <div class="buItem">
      <h3>&#10012; REQUEST FROM: MAATI</h3>
      <p>PLEASE bring any high-class Robotic parts you find to Maati AND/OR Tinik.</p>
    </div>

    <div class="buItem">
      <h3>&#10012; AAR: BREACH/CLEAR NEW COLONY</h3>
      <p>Pendzal arrived first, couldn't advance due to heavy gunner. 808 GUBAT arrived, cleared gunner, rescued captives from portal room. Breach//Clear'd rooms with Aquila Personnel + Pendzali EOD. Destroyed a humanoid robot.</p>
      <p>Lesson of the day: obtain more EOD personnel.<br/>Tangkay Subal has made full recovery.</p>
    </div>

  </div>
