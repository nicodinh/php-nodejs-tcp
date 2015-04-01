var net = require('net');
 
var proxyPort = 1337;
var tcpServerPort = 30042; 

var proxy = net.createServer(function (socket) {
    var client;
    console.log('Client connected to proxy');
    client = net.connect(tcpServerPort);
    socket.pipe(client).pipe(socket);
 
    socket.on('close', function () {
        console.log('Client disconnected from proxy');
    });
	
	socket.on('data', function (data) {
        console.log(data);
    });
 
    socket.on('error', function (err) {
        console.log('Error: ' + err.soString());
    });
});

proxy.listen(proxyPort);