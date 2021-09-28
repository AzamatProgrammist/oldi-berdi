<?php
	ob_start();
	include "db.php";
	if (isset($_GET['id'])) {
		$user_id = $_GET['id'];
	}
	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$summasi = $_POST['summasi'];
		$berganVaqtim = $_POST['berganVaqtim'];
		$qaytarishMuttatim = $_POST['qaytarishMuttatim'];
		$selects = $_POST['select'];
		$user_id = $_POST['user_id'];
		$result = $crud->getQarz($name, $summasi, $berganVaqtim, $qaytarishMuttatim, $selects, $user_id);
		if ($result) {
			header("Location: index.php?id=$user_id");
			ob_end_flush();
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Oldi berdi</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<div id="header">
		<form action="search.php" method="POST">
			<input type="text" name="search" placeholder="qidiring...">
			<button class="btn" name="btn">Qidiruv..</button>
		</form>
	</div>
</head>
<body>
	<div class="container">
		<div class="form">
			<form action="" method="POST" enctype="multipart/form-data">
				<h3 class="centir">Qarz oldim</h3>
				<label>Kimdan/Nimadan</label>
				<input type="text" name="name">
				<label>Qarz miqdori(so'mda)</label>
				<input type="text" name="summasi">
				<label>Qarz bo'lgan kunim</label>
				<input type="date" name="berganVaqtim">
				<label>To'lash muddatim</label>
				<input type="date" name="qaytarishMuttatim">
				<select name="select">
					<option value="0">To'lanmadi</option>
					<option value="1">To'landi</option>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				</select>	
				
				<button class="btn" name="btn">Qo'shish</button>
			</form>
		</div>
	</div>
</body>
</html>
