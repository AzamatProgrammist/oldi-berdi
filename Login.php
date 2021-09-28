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
		$login = $_POST['login'];
		$parol = $_POST['parol'];
		while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			if (($parol == $row['parol']) && ($login == $row['login'])) {
				$id = $row['id'];
				header("Location: index.php?id=$id");
				ob_end_flush();
			}else{
				$xato = "Login yoki parol xato kiritildi";
			}
		}
		
	}
 ?>
 <div class="Registr">
 	<h3><a href="Registratsiya.php">Registratsiya</a></h3>
 </div>

	<div id="fon">
		<div class="container">
		<div class="Bformasi"><br>
			<form action="" method="POST" enctype="multipart/form-data">
				<h4><?php echo $xato; ?></h4>
				<h3>LOGIN PAROL</h3>
				<p>Tizimga kirish uchun login parolni kiriting</p>
				<label>Login:</label>
					<input type="text" name="login" required><br>
				<label>Password:</label>
					<input type="password" name="parol" required><br>
				<button type="submit" name="btn">Yuborish</button>
			</form>
		</div>
		</div>
	</div>
</div>
</body>
</html>s


