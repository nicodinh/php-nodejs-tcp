var net = require('net');
var readline = require('readline');

var rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

var client = new net.Socket();

client.connect(1337, '127.0.0.1', function() {
	console.log('Connected');
	
	rl.on('line', function (cmd) {
	  console.log('You just typed: '+cmd);
	  client.write(cmd+'\r\n');	   
	});
	
});
 
client.on('data', function(data) {
	console.log('Received: ' + data);
});
 
client.on('close', function() {
	console.log('Connection closed');
	rl.close();
	client.destroy();
}); 



