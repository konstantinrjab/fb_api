<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:45
 */

class Model_Token extends Model {
	public function __construct( PDO $pdo ) {
		parent::__construct( $pdo );
	}
}