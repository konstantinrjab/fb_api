<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:31
 */

class Controller {

	public $model;
	public $view;

	/**
	 * @var PDO
	 */
	public $pdo;

	function __construct($pdo) {
		$this->pdo  = $pdo;
		$this->view = new View();
	}

	public function checkToken() {
		if (empty($_POST['token'])) {
			$data['error'] = 'insert access token';
			$this->view->generate($data, 400);
			exit();
		}

		$token = $_POST['token'];
		$sql   = 'SELECT 1 FROM auth WHERE token = :t AND expire > NOW()';
		$stmt  = $this->pdo->prepare($sql);
		$stmt->execute(array(
			':t' => md5($token),
		));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (empty($row)) {
			$data['error'] = 'invalid token';
			$this->view->generate($data, 403);
			exit();
		}

		return true;
	}
}