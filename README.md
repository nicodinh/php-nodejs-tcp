# php-nodejs-tcp
php-nodejs-tcp example

./server/app.php -type ipv4 -port 30042 -ip 0.0.0.0

node ./tcpProxy/tcpProxy.js

node ./client/client.js or telnet 0.0.0.0 30042