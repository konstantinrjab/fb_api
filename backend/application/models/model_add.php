<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:45
 */

class Model_Add extends Model {
	public function __construct(PDO $pdo) {
		parent::__construct($pdo);
	}

	public function checkData($member) {
		$error = array();
		if (is_numeric($_POST['user_id']) && $_POST['user_id'] > 0) {
			$member->id = $_POST['user_id'];
		} else {
			$error['error'] = 'Incorrect id';
		}
		if (isset($_POST['name']) && strlen($_POST['name']) > 1) {
			$member->full_name = str_replace('_', ' ', $_POST['name']);
		} else {
			$error['error'] = 'Incorrect name';

//			$error[] = 'Incorrect name';
		}

		return $error;
	}

	public function get_names_lib() {
		$stmt = $this->pdo->query('SELECT * FROM names');
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$names_lib[] = $row;
		};

		return $names_lib;
	}
}