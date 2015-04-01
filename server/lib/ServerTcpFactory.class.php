<?php
namespace socketTCP;

class ServerTCPFactory {
	
	public static function createServer($arg) {
		if (in_array('ipv4', $arg)) {
			$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		}
		else if (in_array('ipv6', $arg)) {
			exit('error');
		}
		if ($sock === false) {
			echo "error";
		}
		$sock = new ServerTCP($arg['ip'], $arg['port'], $sock);
		try {
			$sock->bind($arg['ip'], $arg['port']);
			$sock->listen();
		}
		catch (Exception $e) {
			$sock->close();
			throw $e;
		}
		return $sock;
	}
	
}