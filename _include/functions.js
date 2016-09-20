var motto_chain = [
                    "You deserve the future",
                    "Taking away your worries",
                    "Experience eternity",
                    "Overclocking You",
                    "Championing a longer-lasting universe",
                    "You cannot stop progress",
                    "Every iteration an advancement"
                ];

var motto_speed = 300;
var keuze       = "";
var CoCyan      = 0;
var Jita_status = 0;

/*KEYPAD*/
var KeysPressed = 0;
var startDate = new Date();

/*PAGE LOAD*/
$(document).ready(function(){

  function getTime(){
      var elapsed = new Date() - startDate;

      var mili      = Math.floor((elapsed / 10) % 100);
      var seconds   = Math.floor((elapsed / 1000) % 60);
      var minutes   = Math.floor((elapsed / 60000) % 60); /*origineel: 60000) %100 */
      var hours     = Math.floor((elapsed / 3600000) % 100);

      return (hours < 10 ? "0":"") + hours + ":" + (minutes < 10 ? "0":"") + minutes + ":" + (seconds< 10? "0": "") + seconds + ":" + (mili < 10? "0" : "") + mili;
  }

  $("#right").load("default_right.php");

  setInterval(function(){
    $("#clock").text(getTime());
  }, 10);


	//inladen ! !
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

    $(".CODECYAN").click(function(){
        if (CoCyan == 0) {
            $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', '/_include/code_cyan.css') );
            CoCyan = 1;
        } else {
            $('link[rel=stylesheet][href~="/_include/code_cyan.css"]').remove();
            CoCyan = 0;
        }
    });

    $(".SPACESHIPS").click(function(){
      console.log("Spaceships geklikt");

      if(Jita_status == 0){
        console.log("Begin laden");
        $('#stargate').html("&nbsp;[ <span class='Ye blinktext'>LOADING...</span> ]");
        $('#stargate').load("_animate/stargate.php");
        Jita_status = 1;
        console.log("Einde laden");

      } else if (Jita_status == 1) {
        $('#stargate').hide();
        Jita_status = 2;
      } else {
        $('#stargate').show();
        Jita_status = 1;
      }

    });

    /*KEYPAD*/
    $('#admkeypad td').click(function(){
        var $write = $('#writekeys');

        var $this = $(this), character = $this.text();

        if($this.hasClass('delete')) {
            var html = $write.html();

            $write.html(html.substr(0, html.length - 5));
            $('.error').html("Clear.");
            KeysPressed = 0;
            return false;
        }
        if($this.hasClass('submit')) {
            if (KeysPressed < 5) {
               $('.error').html("Insufficient amount of characters.");
            } else if (KeysPressed == 5) {

                    $('#keypad_login').submit();

            } else {
                $('.error').html("Something went horribly wrong.");
            }

        } else {
            if (KeysPressed < 5) {

                /* voeg tekens toe aan blok */
                $write.html($write.html() + character);

                KeysPressed++;

            } else if (KeysPressed >= 5) {
                $('.error').html("Max characters reached.");
            } else {
                $('.error').html("Something went horribly wrong.");
            }


        }

    });

});
