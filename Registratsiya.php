<?php 
	ob_start();
	include "db.php";
	$results = $crud->SelectUser();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>OnlineSavdo.com</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<div id="yashil">

<?php 

	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$fam = $_POST['fam'];
		$login = $_POST['login'];
		$parol = $_POST['password'];
		$phone = $_POST['tel'];
		while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			if (($parol == $row['parol']) || ($tel == $row['phone'])) {
				$num = 1;
			}else{
				$num = 2;
			}
		}
		if ($num == 1) {
			$xato = "Bunday parol yoki tel nomer oldin ro'yhatdan o'tgan";
		}elseif($num == 2){

		$result = $crud->InsertRegistr($name, $fam, $login, $parol, $phone);
		}
		
	}



 ?>


	<div id="fon">
		<div class="container">
		<div class="Bformasi"><br>
			<form action="" method="POST" enctype="multipart/form-data">
				<h4><?php echo $xato; ?></h4>
				<h3>REGISTRATSIYA</h3>
				<p>Ro'yhatdan o'tish uchun hamma qatorni to'ldiring</p>
				<label>First Name:</label>
					<input type="text" name="name" required><br>
				<label>Last Name:</label>
					<input type="text" name="fam" required><br>
				<label>Login:</label>
					<input type="text" name="login" required><br>
					<label>Password:</label>
					<input type="password" name="password" required><br>
				<label>Telefon raqamingiz:</label>
					<input type="number" name="tel" required><br>
				<button type="submit" name="btn">Yuborish</button>
			</form>
		</div>
		</div>
	</div>
</div>
</body>
</html>


