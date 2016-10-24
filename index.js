var express = require('express');
var app     = express();
var http    = require('http').Server(app);
var io      = require('socket.io')(http);
var $       = require('jquery');

var mysql   = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'thijsboerma_maati'
});

  connection.connect();

app.use(express.static('public'));
app.use(express.static('_includes'));
app.use('_includes', express.static('public'));

/* luister naar local port; 3000 */
http.listen(3000, function(){
  console.log('Activity detected on pathway *:3000 . Stand by for engagement.')
});

app.get('/', function(req, res){
  res.send('index.html');
});

io.on('connection', function (socket) {

  console.log('User has connected succesfully.');

  connection.query('SELECT `name`, `status` FROM agents WHERE `status` != "offline" AND `status` != "MIA" AND `status` != "inactive"', function(err, rows, fields) {
    if (!err)
      console.log('wie is de lul?: ', rows);
    else
      console.log('Error while performing Query.');
  });

  socket.on('disconnect', function(){
    console.log('user signed out. Deploying whiteCell()');
  });

  socket.on('loadstatus', function(msg){
    io.emit('loadedpage', msg);
  });

});


app.use(function(req, res, next) {
  res.status(404).send('<body style="background:#000;"><h1 style="color:#EEE;font-family:sans-serif;font-size:4rem;margin-top:25%;margin-left:33%;">404 NOT F0UND</h1></body>');
});
