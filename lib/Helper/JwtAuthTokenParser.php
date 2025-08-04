<?php
declare(strict_types=1);

namespace OCA\JwtAuth\Helper;

use OCP\ICacheFactory;

class JwtAuthTokenParser {

	/**
	 * @var string
	 */
	private $secret;
	private ICacheFactory $cacheFactory;

	public function __construct(ICacheFactory $cacheFactory, string $secret) {
		$this->cacheFactory = $cacheFactory;
		$this->secret = $secret;
	}

	public function parseValidatedToken(string $token): ?string {		
		$keys = new Firebase\JWT\Key($this->secret, 'HS256');

		try {
			$decoded = Firebase\JWT\JWT::decode($jwt, $keys);
			if (isset($decoded->uid)) {
				return $decoded->uid;
			}
			return null;
		} catch (InvalidArgumentException $e) {
			// provided key/key-array is empty or malformed.
			return null;
		} catch (DomainException $e) {
			// provided algorithm is unsupported OR
			// provided key is invalid OR
			// unknown error thrown in openSSL or libsodium OR
			// libsodium is required but not available.
			return null;
		} catch (SignatureInvalidException $e) {
			// provided JWT signature verification failed.
			return null;
		} catch (BeforeValidException $e) {
			// provided JWT is trying to be used before "nbf" claim OR
			// provided JWT is trying to be used before "iat" claim.
			return null;
		} catch (ExpiredException $e) {
			// provided JWT is trying to be used after "exp" claim.
			return null;
		} catch (UnexpectedValueException $e) {
			// provided JWT is malformed OR
			// provided JWT is missing an algorithm / using an unsupported algorithm OR
			// provided JWT algorithm does not match provided key OR
			// provided key ID in key/key-array is empty or invalid.
			return null;
		}
	}

}
