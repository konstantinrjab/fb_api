<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:30
 */

class Model {
	public function __construct( PDO $pdo ) {
		$this->pdo = $pdo;
	}

	public function get_data() {
	}
}