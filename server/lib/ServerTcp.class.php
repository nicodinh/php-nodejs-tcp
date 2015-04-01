<?php
namespace socketTCP;

class ServerTCP {

	private $_ip = '';
	private $_port = 0;
	private $_sock;
	private $_clients = array();
	
	public function __construct($ip, $port, $sock) {
		$this->_ip = $ip;
		$this->_port = $port;	
		$this->_sock = $sock;
	}
	
	public function getIp() {
		return $this->_ip;
	}	
	
	public function getPort() {
		return $this->_port;
	}	
	
	public function getInfo() {
		return 'Connected to : ' . $this->getIp() . ':' . $this->getPort();
	}
	
	public function __clone() {
		trigger_error(Constant::SERVER_ERROR_CLONE, E_USER_ERROR);
	}
	
	public function __wakeup() {
		trigger_error(Constant::SERVER_ERROR_WAKEUP, E_USER_ERROR);
	}
	
	public function getSock() {
		return $this->_sock;
	}

	public function bind($ip, $port) {
		$result = socket_bind($this->_sock, $ip, $port);
		if ($result === false) {
			echo socket_strerror(socket_last_error($this->_sock));
		}
		return $this;
	}
	
	public function listen() {
		$result = socket_listen($this->_sock, 5);
		if ($result === false) {
			echo socket_strerror(socket_last_error($this->_sock));
		}
		return $this;
	}

	public function accept() {
		$sock = socket_accept($this->_sock);
		if ($sock === false) {
			echo socket_strerror(socket_last_error($this->_sock));
		}
		return new ServerTCP('', 0, $sock);	
	}	
	
	public function write($buffer) {
		$result = socket_write($this->_sock, $buffer);
		if ($result === false) {
			echo socket_strerror(socket_last_error($this->_sock));
		}
		return $result;
	}	
	
	public function read() {
		$data = socket_read($this->_sock, 2048, PHP_NORMAL_READ);
		if ($data === false) {
			echo socket_strerror(socket_last_error($this->_sock));
		}
		return $data;
	}	
	
	public function close()
	{
		socket_close($this->_sock);
		return $this;
	}
}
