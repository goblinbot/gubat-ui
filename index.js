var express = require('express');
var app     = express();
var http    = require('http').Server(app);
var io      = require('socket.io')(http);
var $       = require('jquery');

app.use(express.static(__dirname + '/public'));

/* luister naar local port; 3000 */
http.listen(3000, function(){
  console.log('Activity detected on pathway *:3000 . Stand by for engagement.')
});



app.get('/', function(req, res){
  console.log('meme');
  res.send('index.html');
});

app.get('/loaded', function(req, res){
  console.log('GUBAT NAVIGATIE SUCCESVOL GEPORT, PRAISE THE METAL MOT');
  res.send('loaded.html');
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
