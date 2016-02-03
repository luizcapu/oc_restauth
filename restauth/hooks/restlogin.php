<?php

/**
 * ownCloud - Music app
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author luizcapu <luizcapu@gmail.com>
 * @copyright luizcapu 2014
 */

namespace OCA\RestAuth\Hooks;

use \OCA\RestAuth\lib\Helper;


class RestLogin {
	
	private $userSession;
	private $userManager;
	private $configuration;
	
	public function __construct($userSession, $userManager, Configuration $configuration){
		$this->userSession = $userSession;
		$this->userManager = $userManager;
		$this->configuration = $configuration;
	}

	public function register() {
		$callback = function($user, $password) {
			$this->login($user, $password);
		};
		$this->userSession->listen("\OC\User", "preLogin", $callback);
	}

	private function login($user, $password) {
		if (Helper::loginRequestCode($this->configuration, $user, $password) == 200) {
			if (!$this->userManager->userExists($user)) {
				$this->userManager->createUser($user, $password);
			} else {
				$this->userManager->get($user)->setPassword($password, $password);
			}
			$this->userManager->get($user)->setEnabled(true);				
		}
	}
	
}