<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 06.02.2018
 * Time: 22:32
 */

class Auth {
	/**
	 * @var string
	 */
	public $token;
	public $expire;
	public $pdo;

	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function login($login, $passwd) {
		$sql  = 'SELECT * FROM auth WHERE login = :lg AND password = :psw';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array(
			':lg'  => $login,
			':psw' => $passwd
		));
		$result = $stmt->fetch();

		if (!empty($result)) {
			$this->remember($login, $passwd);

			return true;
		} else {
			return false;
		}
	}

	public function remember($login, $passwd) {
		$date         = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Europe/Kiev'));
		$this->expire = $date->add(new DateInterval('PT6H'));

		$this->generateToken();

		$sql  = 'UPDATE auth SET token = :token, expire = :expire WHERE (login = :lg  AND password = :psw)';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array(
			':lg'     => $login,
			':psw'    => $passwd,
			':token'  => md5($this->token),
			':expire' => $this->expire->format('Y-m-d H:i:s')
		));
	}

	private function generateToken() {
		$this->token = md5(uniqid('', true));
	}
}