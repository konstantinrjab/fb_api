<?php
/**
 * Created by PhpStorm.
 * User: daria
 * Date: 1/20/2018
 * Time: 5:29 PM
 */

class Member {
	public $full_name = '';
	public $first_name = '';
	public $last_name = '';
	public $id = 0;
	public $url = '';
	public $photo = '';
	public $gender = '';
	public $status = '';


	public function getName() {
		$arr              = explode(' ', preg_replace('| +|', ' ', $this->full_name));
		$this->first_name = $arr[0];
		if ( !empty($arr[1])) {
			$this->last_name = $arr[1];
		} else {
			$this->last_name = '';
		}
	}

	public function checkGender($names_lib) {
		$first_name = mb_strtolower($this->first_name, 'utf-8');
		$last_name  = mb_strtolower($this->last_name, 'utf-8');
		foreach ($names_lib as $key => $n) {
			if ($first_name == $n['name'] || $last_name == $n['name']) {
				if (empty($this->gender)) {
					$this->gender = $n['gender'];
				} else {
					$this->gender = 'undefined';
				}
			}
		}
	}

	public function getUrl($url) {
		preg_match_all('/(.*)&/U', $url, $matches);
		$this->url = $matches[1][0];
	}

	public function getId() {
		preg_match_all("/\?id=(.*$)/U", $this->url, $matches);
		$this->id = $matches[1][0];
	}

	public function getStatus() {
		if ( !empty($this->id)
		     && !empty($this->first_name)
		     && !empty($this->last_name)
		     && $this->gender === 'male'
		     && $this->gender === 'female') {
			$this->status = 'success';
		} else {
			$this->status = 'fail';
		}
	}

	public function getPhoto() {
		if ( !empty($this->id)) {
			$this->photo = 'https://graph.facebook.com/'.$this->id.'/picture?type=large';
		}
	}

	public function addToDB($pdo) {
		$stmt = $pdo->prepare('INSERT INTO members (user_id, first_name, last_name, photo, url, gender, status) 
VALUES (:id, :fn, :ln, :ph, :url, :gn, :st)
ON DUPLICATE KEY UPDATE user_id = :id, first_name = :fn, last_name = :ln, 
photo = :ph, url = :url, gender = :gn, status = :st');
		$stmt->execute(array(
			':id'  => $this->id,
			':fn'  => $this->first_name,
			':ln'  => $this->last_name,
			':ph'  => $this->photo,
			':url' => $this->url,
			':gn'  => $this->gender,
			':st'  => $this->status,
		));
	}
}