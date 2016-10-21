var express = require('express');
var app     = express();
var http    = require('http').Server(app);
var io      = require('socket.io')(http);
var $       = require('jquery');

app.use(express.static('public'));
app.use(express.static('_includes'));
app.use('_includes', express.static('public'));

/* luister naar local port; 3000 */
http.listen(3000, function(){
  console.log('Activity detected on pathway *:3000 . Stand by for engagement.')
});


app.use(function(req, res, next) {
  res.status(404).send('<body style="background:#000;"><h1 style="color:#EEE">404 NOT F0UND</h1></body>');
});

app.get('/', function(req, res){
  res.send('index.html');
});

app.get('404.html', function(req, res){
  console.log('GUBAT NAVIGATIE SUCCESVOL GEPORT, PRAISE THE METAL MOT');
});

io.on('connection', function (socket) {

  console.log('User [  ] has connected.');

  socket.on('disconnect', function(){
    console.log('user [  ] signed out.');
  });

  socket.on('loadedpage', function(msg){
    io.emit('loadedpage', msg);
  });

});
