<?php
namespace OCA\JwtAuth\AppInfo;

use \OCP\AppFramework\App;

class Application extends App {

	public function __construct(array $urlParams = array()) {
		parent::__construct('jwtauth', $urlParams);

		$container = $this->getContainer();

		$container->registerService('jwtAuthTokenParser', function ($c) {
			$cacheFactory = $c->get(\OCP\ICacheFactory::class);
			$config = $c->query(\OCP\IConfig::class);

			return new \OCA\JwtAuth\Helper\JwtAuthTokenParser(
				$cacheFactory,
				$config->getSystemConfig()->getValue('jwtauth')['SharedSecret'],
			);
		});

		$container->registerService('urlGenerator', function ($c) {
			$config = $c->query(\OCP\IConfig::class);

			return new \OCA\JwtAuth\Helper\UrlGenerator(
				$config->getSystemConfig()->getValue('jwtauth')['AutoLoginTriggerUri'],
				$config->getSystemConfig()->getValue('jwtauth')['LogoutConfirmationUri'],
			);
		});

		$container->registerService('loginPageInterceptor', function ($c) {
			return new \OCA\JwtAuth\Helper\LoginPageInterceptor(
				$c->query('urlGenerator'),
				$c->query(\OC\User\Session::class),
			);
		});
	}

}
