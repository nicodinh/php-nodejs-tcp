<?php
namespace socketTCP;

abstract class Constant {
	const SERVER_ERROR_CLONE = "Unable to clone";
	const SERVER_ERROR_WAKEUP = "Unable to unserialize";
	const APP_PARAMETER_USAGE = "Example Usage -type ipv4 -ip 127.0.0.1 -port 1337\nor -type ipv6 -ip FE80:0000:0000:0000:0202:B3FF:FE1E:8329 -port 1337\n";

}