<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:32
 */

class Controller_Add extends Controller {
	function __construct(PDO $pdo) {
		parent::__construct($pdo);
		$this->model = new Model_Add($pdo);
		$this->view  = new View();
		$this->checkToken();
	}

	function action_index() {
		$this->view->generate('you must specify an action', 400);
	}

	function action_member() {
		$member = new Member;
		$error  = $this->model->checkData($member);
		if (!empty($error)) {
			$this->view->generate($error, 400);
		} else {
			$member->getName();
			$names_lib = $this->model->get_names_lib();
			$member->checkGender($names_lib);
			$member->url   = 'facebook.com/' . $member->id;
			$member->photo = 'https://graph.facebook.com/' . $member->id . '/picture?type=large';
			$member->getStatus();
			if ($member->id) {
				$member->addToDB($this->pdo);
			}
			unset($member);

			$data = 'success';
			$this->view->generate($data, 200);
		}

	}

}