<?php
/**
 * ownCloud - restauth
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author luizcapu <luizcapu@gmail.com>
 * @copyright luizcapu 2016
 */
 
namespace OCA\RestAuth\AppInfo;

use \OCP\AppFramework\App;

use \OCA\RestAuth\Hooks\RestLogin;
use \OCA\RestAuth\lib\Helper;


class Application extends App {

	public function __construct(array $urlParams=array()){
		parent::__construct('restauth', $urlParams);

		$container = $this->getContainer();			
		
		/**
		 * Controllers
		 */
		$container->registerService('RestLogin', function($c) {
			return new RestLogin(
					$c->query('ServerContainer')->getUserSession(),
					$c->query('ServerContainer')->getUserManager(),
					Helper::getConfiguration()
					);
		});
		
		$container->query('RestLogin')->register();
	}
}