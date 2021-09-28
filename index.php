<?php 
	include_once "db.php";
	if (isset($_GET['id'])) {
		$idi = $_GET['id'];
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Oldi berdi</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="header">
	<h2>Bu mening oldi berdi eslatma daftarcham</h2>
	<form action="search.php" method="POST">
		<input type="text" name="search" placeholder="qidiring...">
		<button class="btn" name="btn">Qidiruv..</button>
	</form>
</div>
	<div class="container">

		<div class="box">
			<img class="img" src="img/1.jpg">			
			<h3><a href="qarzlarim.php?id=<?php echo $idi; ?>">Qarzlarim</a></h3>

		</div>
		<div class="box">
			<img class="img" src="img/2.jpg">
			<h3><a href="qarzdorlar.php?id=<?php echo $idi; ?>">Qarz berganlarim</a></h3>
		</div>
		<div class="box">
			<img class="img" src="img/3.jpg">
			<h3><a href="get.php?id=<?php echo $idi; ?>">Qarz olish</a></h3>
		</div>
		<div class="box">
			<img class="img" src="img/4.jpg">
			<h3><a href="set.php?id=<?php echo $idi; ?>">Qarz berish</a></h3>
		</div>
	</div>
</body>
</html>
