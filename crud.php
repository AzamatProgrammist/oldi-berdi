<?php
	class crud{
		private $db;

		public function __construct($conn){
			$this->db = $conn;
		}

		public function getQarz($name, $summasi, $berganVaqtim, $qaytarishMuttatim, $selects, $user_id){
			$sql = "INSERT INTO qarzoldim(name, summasi, berganVaqtim, qaytarishMuttatim, selects, user_id) VALUES(:name, :summasi, :berganVaqtim, :qaytarishMuttatim, :selects, :user_id)";
			$stmt = $this->db->prepare($sql);

			$stmt->bindparam(':name',$name);
 			$stmt->bindparam(':summasi',$summasi);
 			$stmt->bindparam(':berganVaqtim',$berganVaqtim);
 			$stmt->bindparam(':qaytarishMuttatim',$qaytarishMuttatim);
 			$stmt->bindparam(':selects',$selects);
 			$stmt->bindparam(':user_id',$user_id);

 			$result = $stmt->execute();
	 		return $result;

		}

		public function qarzlarim($user_id){
			$sql = "SELECT * FROM `qarzoldim` WHERE `user_id` = $user_id";
	 		$result = $this->db->query($sql);
			return $result;
		}

		public function setQarz($name, $summasi, $olganVaqt, $qaytarishMuddati, $selects, $user_id){
			$sql = "INSERT INTO qarzdorlik(name, summasi, olganVaqt, qaytarishMuddati, selects, user_id) VALUES(:name, :summasi, :olganVaqt, :qaytarishMuddati, :selects, :user_id)";
			$stmt = $this->db->prepare($sql);

			$stmt->bindparam(':name', $name);
			$stmt->bindparam(':summasi', $summasi);
			$stmt->bindparam(':olganVaqt', $olganVaqt);
			$stmt->bindparam(':qaytarishMuddati', $qaytarishMuddati);
			$stmt->bindparam(':selects', $selects);
			$stmt->bindparam(':user_id', $user_id);

			$result = $stmt->execute();
			return $result;
		}

		public function qarzdorlik($user_id, $sum, $page){
			$sql = "SELECT * FROM qarzdorlik WHERE `user_id` = $user_id LIMIT $sum, $page";
	 		$result = $this->db->query($sql);
	 		return $result;
		}
		public function qarzdorlikCount($user_id){
			$sql = "SELECT * FROM qarzdorlik WHERE `user_id` = $user_id";
	 		$result = $this->db->query($sql);
	 		return $result;
		}

		public function Update($id){
			$sql = "SELECT * FROM qarzdorlik WHERE `id` = $id";
			$stmt = $this->db->prepare($sql);

			$stmt->bindparam(':id', $id);
			$result = $stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		public function SetUpdate($id, $name, $summasi, $olganVaqt, $qaytarishMuddati, $selects){
				try{
				$sql = "UPDATE `qarzdorlik` SET `name` = :name, `summasi` = :summasi, `olganVaqt` = :olganVaqt, `qaytarishMuddati` = :qaytarishMuddati, `selects` = :selects WHERE id = :id";
				$stmt = $this->db->prepare($sql);
				$stmt->bindparam(':id', $id);
				$stmt->bindparam(':name', $name);
				$stmt->bindparam(':summasi', $summasi);
				$stmt->bindparam(':olganVaqt', $olganVaqt);
				$stmt->bindparam(':qaytarishMuddati', $qaytarishMuddati);
				$stmt->bindparam(':selects', $selects);
				$result = $stmt->execute();
				return $result;
			} catch (PDOExeption $e){
				echo $e->getMessage();
			}
		}
		public function Search($search){
			$sql = "SELECT * FROM qarzdorlik WHERE name LIKE '%$search%' OR summasi LIKE '%$search%' OR olganVaqt LIKE '%$search%' OR qaytarishMuddati LIKE '%$search%'";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
	 		return $stmt;
		}
		
		public function Searches($search){
			$sql = "SELECT * FROM qarzoldim WHERE name LIKE '%$search%' OR summasi LIKE '%$search%' OR berganVaqtim LIKE '%$search%' OR qaytarishMuttatim LIKE '%$search%' ";
			$stmt2 = $this->db->prepare($sql);
			$stmt2->execute();
	 		return $stmt2;
		}
		public function Delete($id) {
			$sql = "DELETE FROM qarzdorlik WHERE id = :id";
	 		$stmt = $this->db->prepare($sql);
	 		$stmt->bindparam(':id',$id);
	 		$result = $stmt->execute();
	 		return $result;
		}

		public function InsertRegistr($name, $fam, $login, $parol, $phone){
			$sql = "INSERT INTO user(name, fam, login, parol, phone) VALUES (:name, :fam, :login, :parol, :phone)";
			$stmt = $this->db->prepare($sql);

			$stmt->bindparam(':name',$name);
			$stmt->bindparam(':fam',$fam);
			$stmt->bindparam(':login',$login);
			$stmt->bindparam(':parol',$parol);
			$stmt->bindparam(':phone',$phone);
			$result = $stmt->execute();
			return $result;
		}

		public function SelectUser(){
			$sql = "SELECT * FROM user";
			$results = $this->db->query($sql);
	 		return $results;
		}
	}


 ?>



