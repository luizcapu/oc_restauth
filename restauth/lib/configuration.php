<?php
/**
 * @author luizcapu <luizcapu@gmail.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCA\RestAuth\lib;

define ('RESTAUTH_HOST_NAME', "hostName");
define ('RESTAUTH_PORT', "port");
define ('RESTAUTH_METHOD', "method");
define ('RESTAUTH_ACTION', "action");
define ('RESTAUTH_USER_PARAM_NAME', "userParamName");
define ('RESTAUTH_PASS_PARAM_NAME', "passParamName");

class Configuration {
	
	private $prefix = "restauth_";
	protected $config = array();

	public function __construct() {
		$this->loadConfiguration();
	}
	
	private function buildKey($entry) {
		return $this->prefix.$entry;
	}
	
	private function loadConfiguration() {
		// TODO load/save from/to database
		$this->config = array(
				$this->buildKey(RESTAUTH_HOST_NAME) => "http://ec2-52-91-121-176.compute-1.amazonaws.com",
				$this->buildKey(RESTAUTH_PORT) => 8080,
				$this->buildKey(RESTAUTH_ACTION) => "auth",
				$this->buildKey(RESTAUTH_METHOD) => "GET",
				$this->buildKey(RESTAUTH_USER_PARAM_NAME) => "username",
				$this->buildKey(RESTAUTH_PASS_PARAM_NAME) => "password",
		);
	}
	
	public function readConfig($entry) {
		return array_key_exists($this->buildKey($entry), $this->config) ? $this->config[$this->buildKey($entry)] : null;
	}
}