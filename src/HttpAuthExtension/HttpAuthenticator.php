<?php

/**
 * This file is part of the HttpAuthExtension package
 *
 * @license  MIT
 * @author   Petr Kessler (https://kesspess.cz)
 * @link     https://github.com/uestla/HttpAuthExtension
 */

namespace HttpAuthExtension;

use Nette;
use Nette\Http;


class HttpAuthenticator
{

	/** @var Http\Response */
	private $response;

	/** @var string */
	private $username;

	/** @var string */
	private $password;

	/** @var string */
	private $title;

    /** @var array */
    private $secure_urls;


	/**
	 * @param  Http\Response $response
	 * @param  string $username
	 * @param  string $password
	 * @param  string $title
	 * @param  array $secure_urls
	 */
	public function __construct(Http\Response $response, $username, $password, $title, array $secure_urls)
	{
		$this->response = $response;
		$this->username = $username;
		$this->password = $password;
		$this->title = $title;
		$this->secure_urls = $secure_urls;
	}


	/** @return void */
	public function run()
	{
		$allowAuth = true;
		if ($this->secure_urls) {
			$allowAuth = false;
			if (in_array($_SERVER['REQUEST_URI'], $this->secure_urls)) {
			$allowAuth = true;
			}
		}
		if ($allowAuth) {
			if (!isset($_SERVER['PHP_AUTH_USER'])
				|| $_SERVER['PHP_AUTH_USER'] !== $this->username || $_SERVER['PHP_AUTH_PW'] !== $this->password) {
				$this->response->setHeader('WWW-Authenticate', 'Basic realm="' . $this->title . '"');
				$this->response->setCode(Http\IResponse::S401_UNAUTHORIZED);
				echo '<h1>Authentication failed.</h1>';
				die();
			}
		}
	}

}
