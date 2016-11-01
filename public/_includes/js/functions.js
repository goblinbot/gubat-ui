var socket      = io();
var Jita_status = 0;
var CoCyan      = 0;
var selector    = "";

function colorToggle(){
  if (CoCyan == 0) {
      $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', '/_includes/css/codeY.css') );
      CoCyan = 1;
  } else {
      $('link[rel=stylesheet][href~="/_includes/css/codeY.css"]').remove();
      CoCyan = 0;
  }
}


/* toggle kleurenschemas */
$(".CODECYAN").click(function(){
  colorToggle();
});


/* CLOCK CLOCK CLOCK WATCHING MOTHERFUCKERS DOCK */
function updateClock ()
 	{
 	var currentTime = new Date ( );
  	var currentHours   = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	/* Pad the minutes and seconds with leading zeros, if required */
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	/* Convert an hours component of "0" to "12" */
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	/* Compose the string for display */
  	var currentTimeString ="[&nbsp;" + currentHours + ":" + currentMinutes + ":" + currentSeconds + "&nbsp;]";


   	$("#clock").html(currentTimeString);

 }

/* DAY COUNTER */
function holiday() {
  today = new Date();

  BigDay = new Date("December 25, 2020");
  msPerDay = 24 * 60 * 60 * 1000 ;
  timeLeft = (BigDay.getTime() - today.getTime());
  e_daysLeft = timeLeft / msPerDay;
  daysLeft = Math.floor(e_daysLeft);

  $("#countdownDays").html(daysLeft);
}

function navigate(selector) {

  $.get(selector + ".html")
      .done(function(){
        $("#right").empty();
          $("#right").load(selector);
      })
      .fail(function(){
        $("#right").empty();
          $("#right").load("404.html");
      });


  var selector = selector+".html";
  $('#right').load(selector);
}

function spaceships() {

  if(Jita_status == 0){

    $('#stargate').html("&nbsp;[ <span class='Ye blinktext'>LOADING...</span> ]");
    $('#stargate').load("/_includes/misc/gate.html");
    Jita_status = 1;

  } else if (Jita_status == 1) {
    $('#stargate').hide();
    Jita_status = 2;
  } else {
    $('#stargate').show();
    Jita_status = 1;
  }

}

$(document).ready(function()
{
   setInterval('updateClock()', 1000);
   setInterval('holiday()'    , 1000);

});
