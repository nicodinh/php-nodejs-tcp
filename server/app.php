#!/usr/bin/env php
<?php
namespace socketTCP;

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();

require_once(dirname(__FILE__).'/lib/ServerTcp.class.php');
require_once(dirname(__FILE__).'/lib/ServerTcpFactory.class.php');
require_once(dirname(__FILE__).'/lib/Constant.class.php');
require_once(dirname(__FILE__).'/lib/AppParameter.class.php');

$arg = AppParameter::getOptionParameter($argv);
$factory = new ServerTCPFactory();
$socket = $factory->createServer($arg);

printf('%s' . PHP_EOL, $socket->getInfo());

do {
	if (($client = $socket->accept()) === false) {
        break;
    }
	$client->write("Hello from server PHP\n");
	do {
		printf("%s", $client->read());
	} while (42);	
	$client->close();
} while (42);
$socket->close();