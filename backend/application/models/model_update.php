<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 20:26
 */

class Model_Update extends Model {

	public function __construct( PDO $pdo ) {
		parent::__construct( $pdo );
	}

	public function update_rating( $id, $number ) {
		$stmt = $this->pdo->prepare( 'SELECT user_id FROM members WHERE user_id = :ui' );
		$stmt->execute( array(
			':ui' => $id,
		) );
		$row = $stmt->fetch( PDO::FETCH_ASSOC );

		if ( $row['user_id'] > 0 ) {
			$stmt = $this->pdo->prepare( 'UPDATE members SET rating = :n WHERE user_id = :id' );
			$stmt->execute( array(
				':n'  => $number,
				':id' => $id,
			) );
			return true;
		} else {
			return false;
		}
	}
}