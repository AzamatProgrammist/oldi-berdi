<?php 
	include "db.php";

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
echo $id;
		$result = $crud->Delete($id);

		if ($result) {
			echo "OK";
		}
	}




 ?>