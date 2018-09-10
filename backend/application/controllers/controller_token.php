<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:32
 */

class Controller_Token extends Controller {

	function __construct(PDO $pdo) {
		parent::__construct($pdo);
		$this->model = new Model_Token($pdo);
		$this->view  = new View();
	}

	function action_index() {
		$data = array();
		$status_code = 403;
		if (isset($_POST['login']) && isset($_POST['password'])) {
			$auth   = new Auth($this->pdo);
			$result = $auth->login($_POST['login'], md5($_POST['password']));
			if ( !$result) {
				$data['error'] = 'incorrect login/password';
			} else {
				$status_code = 200;
				$data['token']  = $auth->token;
				$data['expire'] = $auth->expire->format('Y-m-d H:i:s');
			}
		}
		$this->view->generate($data, $status_code);
	}
}