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

use OCA\RestAuth\lib\Configuration;

class Helper {
	
	public static function getConfiguration() {
		return new Configuration();
	}
	
	public static function buildRequestUrl(Configuration $configuration, $user, $password) {
		$result = $configuration->readConfig(RESTAUTH_HOST_NAME);
		
		if ($configuration->readConfig(RESTAUTH_PORT)) {
			$result .= ":".$configuration->readConfig(RESTAUTH_PORT);				
		}

		if ($configuration->readConfig(RESTAUTH_ACTION)) {
			$result .= "/".$configuration->readConfig(RESTAUTH_ACTION);
		}

		if ($configuration->readConfig(RESTAUTH_METHOD) == "GET") {				
			$result .= "?" . $configuration->readConfig(RESTAUTH_USER_PARAM_NAME) . "=" . $user;
			$result .= "&" . $configuration->readConfig(RESTAUTH_PASS_PARAM_NAME) . "=" . $password;
		}
		
		return $result;
	}
	
	public static function loginRequestCode(Configuration $configuration, $user, $password) {
		if ($configuration->readConfig(RESTAUTH_METHOD) != "GET") {
			throw new \Exception("Unkown method " . $configuration->readConfig(RESTAUTH_METHOD));
		}
		
		$service_url = Helper::buildRequestUrl($configuration, $user, $password);
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		$curl_response = curl_exec($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		
		return $httpCode;
	}
	
}