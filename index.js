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
  res.status(404).send('<body style="background:#000;"><h1 style="color:#EEE;font-family:sans-serif;font-size:4rem;margin-top:25%;margin-left:33%;">404 NOT F0UND</h1></body>');
  console.log(' !! Outside elements attempting to access non-existant paths and/or information. Deploying whiteCell()')
});

app.get('/', function(req, res){
  res.send('index.html');
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
