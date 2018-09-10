<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:32
 */

class Controller_Get extends Controller {
	function __construct(PDO $pdo) {
		parent::__construct($pdo);
		$this->model = new Model_Get($pdo);
		$this->view  = new View();
		$this->checkToken();
	}

	function action_index() {
		$data = $this->model->get_all_members();

		$this->view->generate($data, 200);
	}

	function action_random() {
		$data = $this->model->get_random();
		$this->view->generate($data, 200);
	}

	function action_specified() {
		$status_code = 200;
		$data        = $this->model->get_specified();

		$this->view->generate($data, $status_code);
	}
}