<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:45
 */

class Model_Get extends Model {
	public function __construct(PDO $pdo) {
		parent::__construct($pdo);
	}

	public function get_all_members() {
		$stmt = $this->pdo->query('SELECT * FROM members');
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function get_random() {
		$stmt = $this->pdo->query('SELECT * FROM members 
WHERE gender = \'female\' AND status = \'success\'
ORDER BY RAND()
LIMIT 2');
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	public function get_specified() {
		$data = array();
		$user_id = (empty($_POST['user_id']) ? '' : ' AND user_id = '.$_POST['user_id']);
		$status  = (empty($_POST['status']) ? '%' : $_POST['status']);
		$gender  = (empty($_POST['gender']) ? '%' : $_POST['gender']);
//		или рейтинг или имя в нужном порядке
		$order  = (empty($_POST['order']) ? 1 : (string) $_POST['order']);
		$limit  = (empty($_POST['limit']) ? 99999 : (int) $_POST['limit']);
		$offset = (empty($_POST['offset']) ? 0 : (int) $_POST['offset']);

		$sql  = 'SELECT user_id, first_name, last_name, url, photo, gender, status, rating
FROM members WHERE status LIKE :st AND gender LIKE :gn '.$user_id.'
ORDER BY '.$order.' LIMIT :lim OFFSET :of';
		$stmt = $this->pdo->prepare($sql);

//		$stmt->bindValue(':ui', $user_id);
		$stmt->bindValue(':st', $status);
		$stmt->bindValue(':gn', $gender);
		$stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
		$stmt->bindValue(':of', $offset, PDO::PARAM_INT);
		$stmt->execute();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}

		return $data;
	}
}