var express = require('express');
var app     = express();
var http    = require('http').Server(app);
var io      = require('socket.io')(http);
var $       = require('jquery');

var bodyParser = require('body-parser');

var mysql   = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'gse',
  password : '!#GSE_91nOd3!',
  database : 'thijsboerma_maati'
});

/* data vars */
var countClients = 0;

/* INIT */
connection.connect();

app.use(express.static('public'));
app.use(express.static('_includes'));
app.use('_includes', express.static('public'));

app.use(bodyParser.urlencoded({ extended: true }));

var port = process.env.PORT || 5000;
http.listen(port, function(){
  console.log('Activity detected on pathway *:'+ port +'. Stand by for engagement.')
});



/* pathing / routing */
app.get('/', function(req, res){
  res.sendFile('index.html', {"root": __dirname+'/public/'});
});

io.on('connection', function (socket) {

  countClients++;
  console.log('User has entered the network. '+countClients+' active clients.');

  socket.on('initCorpBulletin', function(msg){
    connection.query('SELECT `id`,`title`,`content`,`icon`,`priority` FROM bulletin ORDER BY `id` ASC', function(err, rows, fields) {
      if (!err) {
        socket.emit('loadCorpBulletin', rows);
      } else {
        console.log('Error while performing DB Query :: CORP BULLETIN :: '+ err);
      }
    });
  });

  socket.on('navLimit', function(selector){
    console.log('Deploying ClearSky('+selector+') : navlimit reached.');
    socket.emit('clearSky', selector);
  });

  socket.on('clearSkies', function(){
    console.log('FORCE CLEARSKIES STANDBY ... ');
    io.emit('clearSky','default');
  });

  /*status*/
  socket.on('statuspage', function(msg){
    connection.query('SELECT `agent_id`,`name`,`rank`,`orders`,`backup`,`status` FROM agents WHERE `status` != "deceased" AND `status` != "MIA" AND `status` != "inactive" ORDER BY `agent_id` ASC', function(err, rows, fields) {
      if (!err) {
        socket.emit('statuspage', rows);
      } else {
        console.log('Error while performing DB Query.');
      }
    });
  });
  /* adm status page */
  socket.on('admstatuspage', function(admUSER){
    connection.query('SELECT `agent_id`,`orders`,`backup`,`status` FROM agents WHERE `name` = "'+ admUSER +'" LIMIT 1', function(err, rows, fields) {
      if (!err) {
        socket.emit('admstatuspage', rows);
      } else {
        console.log('Error while performing DB Query in ADM/STATUS.');
      }
    });
  });

  /*MIA*/
  socket.on('showRip', function(msg){
    connection.query('SELECT `name`,`callsign`,`orders`,`rip_timestamp`,`status` FROM agents WHERE `status` = "deceased" OR `status` = "MIA" ORDER BY `agent_id` ASC', function(err, rows, fields) {
      if (!err) {
        socket.emit('showRip', rows);
      } else {
        console.log('Error while performing DB Query.');
      }
    });
  });

  socket.on('LOGLOGIN', function(admUSER){
    console.log('user '+admUSER+' succesfully logged in to SECTOR.ADM');
  });
  socket.on('LOGLOGOUT', function(admUSER){
    console.log('user '+admUSER+' logged out manually from SECTOR.ADM');
  });

  socket.on('auth', function(keycode){
    connection.query('SELECT `agent_id`, `name`, `agent_pin`, `status`, `orders` FROM agents WHERE agent_pin = "'+ keycode +'" AND `status` != "deceased" AND `status` != "MIA" AND `status` != "inactive" LIMIT 1', function(err, rows, fields) {

      if (!err && (rows.length > 0)) {
        // console.log(rows[0].name);
        socket.emit('authTrue', rows);
      } else if (rows.length == 0) {
        console.log('INCORRECT PIN ENTERED: '+ keycode);
        socket.emit('authFalse', rows);
      } else {
        console.log('Error while performing PADLOCK SUBMIT');
        socket.emit('authFalse', rows);
      }
    });
  });

  socket.on('updateORD', function(uid, uorders, ustatus){

    connection.query('UPDATE agents SET `orders` = "'+uorders+'", `status` = "'+ustatus+'" WHERE `agent_id` = "'+uid+'"', function(err, rows, fields) {
      console.log('status updated for agent '+uid);
    });

    connection.query('SELECT `agent_id`,`name`,`rank`,`orders`,`backup`,`status` FROM agents WHERE `agent_id` = "'+uid+'" LIMIT 1 ', function(err, rows, fields) {
      if (!err) {
        console.log(rows);
        io.emit('realtimeUpdate', rows);
      } else {
        console.log('Error while selecting updated global status..');
      }
    });

  });

  socket.on('forceNavigate', function(selector) {
    io.emit('forceNavigate', selector);
  });
  socket.on('globalToggle', function(selector) {
    io.emit('forceToggle', selector);
  });
  socket.on('globalSpace', function() {
    io.emit('forceSpace');
  });

  socket.on('disconnect', function(){
    countClients = (countClients-1);
    console.log(countClients+' active clients.');
  });

});

app.use(function(req, res, next) {
  res.status(404).sendFile("404plainVers.html", {"root": __dirname+'/public/'});
});
