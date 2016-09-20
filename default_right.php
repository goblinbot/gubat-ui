


<script>
$(document).ready(function(){

    function navigate() {
        $('#loadtext').html("<span class='Ye'>LOADING... &#x231B;</span> PLEASE STAND BY.");

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

    /* // standaard functies voor navigeren // */
    $(".fnc").click(function(){
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
    <img src="_images/loops/crypto.gif"/>
    <!--
    <img src="_images/loops/tick.gif"/>
    <img src="_images/transfer_halftime.gif"/>

    -->
</div>

<div id="row2">
    <div class="bar">
        <div class="bar_left" style="width:70%;">
            HIMAWARI\DATA ... <span class="Cy">SCAN $root-</span><span class="Ye">&MAATI_local&</span><span class="Cy">\LAZARUS_INVESTMENTS\MA4..\*</span>
        </div>
        <div class="bar_right" style="width:20%;"><span class="fnc Ye" id="end">&#9762; END.</span> PROGRAM</div>
    </div>


    <h3 id="loadtext" style="margin-left: 16px;">LOADING... <span class="Ye">COMPLETE</span>. PLEASE SELECT DATA STREAM.</h3>

    <div id="grid">

        <div class="item twin s1">
            <div class="imgfolder" id="status">
                <p><span>&#x1F464; PERSONNEL/STATUS SCREEN</span></p>
            </div>
        </div>

        <div class="item twin s2">
            <div class="imgfolder" id="bulletin">
                <p><span>&#x1F30C; CORP BULLETIN</span></p>
            </div>
        </div>

    </div>

    <div id="grid" style="margin-top:4rem;">

      <div class="item twin s2">
          <div class="imgfolder" id="scoreboard">
              <p><span>&#x2694; SCOREBOARD</span></p>
          </div>
      </div>

      <div class="item twin s3">
          <div class="imgfolder" id="default_right">
              <p class="Gy"><span>&#10012; $\\:userfiles\*</span></p>
          </div>
      </div>

    </div>



    </div>

</div>
