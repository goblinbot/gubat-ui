<script>
$(document).ready(function(){

    $(".fnc").click(function(){
        keuze = $(this).attr('id');
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
});
</script>

<div id="loading">
  <img src="_images/loops/crypto.gif"/>
  <!--
    <img src="_images/transfer_halftime.gif"/>
  -->
</div>

<div id="row2">
    <div class="bar">
        <div class="bar_left" style="width:70%;">HIMAWARI\DATA ... <span class="Ye">!! &ERR_ !!</span></div>
        <div class="bar_right" style="width:20%;"><span class="fnc Ye" id="default_right">SOFT_RESET.</span> PROGRAM</div>
    </div>

    <div id='grid'>
        <div class='item full s1'>
            <h3>UPDATE FAILED</h3>
            <p>Could not initialize installation : halted by <span class="Cy">node(Absolution)</span></p>
            <br/><br/>
            <p>/// admin note: ///</p>
            <p>" Please don't make me scrap you for <span class='Ye'>parts</span>.
                <br/>Installing v4.72 and beyond will severely damage my sanity.
                <br/>Not exaggerating here - it will. "
            </p>
            <p> updates in queue (0) | succes (0) | failed (<span class='blinktext'>113</span>)</p>

        </div>
    </div>

</div>
