var socket = io();









/* GLOCK GLOCK GLOCK WATCHING MOTHERFUCKERS DOCK */
function updateClock ( )
 	{
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	/* Pad the minutes and seconds with leading zeros, if required */
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	/* Choose either "AM" or "PM" as appropriate */
  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  	/* Convert the hours component to 12-hour format if needed */
  	/*currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;*/

  	/* Convert an hours component of "0" to "12" */
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	/* Compose the string for display */
  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds/* + " " + timeOfDay*/;


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


$(document).ready(function()
{
   setInterval('updateClock()', 1000);
   setInterval('holiday()'    , 1000);
});
