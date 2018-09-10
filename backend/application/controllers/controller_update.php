<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 20:32
 */

class Controller_Update extends Controller {
	function __construct(PDO $pdo) {
		parent::__construct($pdo);
		$this->model = new Model_Update($pdo);
		$this->view  = new View();
		$this->checkToken();
	}

	function action_index() {
		$data['error'] = 'you must specify an action';
		$this->view->generate($data, 400);
	}

	function action_rating() {
		$data = array();
		$status_code = 200;
		if (is_numeric($_POST['user_id']) && is_numeric($_POST['rating'])) {
			$id     = $_POST['user_id'];
			$number = $_POST['rating'];
			$data   = $this->model->update_rating($id, $number);
			if($data){
				$data = 'success';
			} else {
				$status_code = 404;
				$data = 'user not found';
			}
		} else {
			$data['error'] = 'parameters missing/not int';
			$status_code = 400;
		}
		$this->view->generate($data, $status_code);
	}

}