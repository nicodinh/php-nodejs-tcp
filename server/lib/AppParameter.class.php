<?php
namespace socketTCP;

class AppParameter {

	static private function testInt($int) {
		$bool = false;
		if (is_int($int))
			$bool = ctype_digit($int);
		else 
			$bool = true;
		return $bool;
	}
	
	static private function testIp($ip, $parameter) {
		$bool = false;
		if (in_array('ipv4', $parameter)) {
			if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false || strncmp($ip, 'localhost', 9) == 0) {
				$bool = true;
			}
		}
		else if (in_array('ipv6', $parameter)) {
			if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
				$bool = true;
			}
		}
		return $bool;
	}
	
	static public function getOptionParameter($parameter) {
        $arrayOptionsParams = null;
        $array = array_shift($parameter);
		if (count($parameter) == 6 &&
			in_array('-type', $parameter) &&
			in_array('-ip', $parameter) &&
			in_array('-port', $parameter)) {
			for ($i = 0; $i < count($parameter); $i++) {
				if (strncmp($parameter[$i], '-type', 5) == 0 && (strncmp($parameter[$i + 1], 'ipv6', 4) == 0 || strncmp($parameter[$i + 1], 'ipv4', 4) == 0)) { 
					$arrayOptionsParams['type'] = $parameter[$i + 1];	
				}
				if (strncmp($parameter[$i], '-ip', 3) == 0 && self::testIp($parameter[$i + 1], $parameter)) {
					$arrayOptionsParams['ip'] = $parameter[$i + 1];	
				}					
				if (strncmp($parameter[$i], '-port', 5) == 0 && self::testInt($parameter[$i + 1])) {
					$arrayOptionsParams['port'] = $parameter[$i + 1];
				}
			}
			if (!array_key_exists('ip', $arrayOptionsParams) && !array_key_exists('ip', $arrayOptionsParams) && !array_key_exists('ip', $arrayOptionsParams)) {
				exit (Constant::APP_PARAMETER_USAGE);
			}
		}
		else {
            exit (Constant::APP_PARAMETER_USAGE);
        }
        return $arrayOptionsParams;
    }
}