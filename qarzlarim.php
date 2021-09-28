<?php 
	include_once "db.php";
	if (isset($_GET['id'])) {
		$user_id = $_GET['id'];
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
	<a class="header" href="get.php?id=<?php echo $user_id; ?>">Qarz olish</a>
	<a class="header" href="set.php?id=<?php echo $user_id; ?>">Qarz berish</a>
	<a class="header" href="qarzdorlar.php?id=<?php echo $user_id; ?>">Qarz berganlarim</a>
	<form action="search.php?id=$user_id" method="POST">
		<input type="text" name="search" placeholder="qidiring...">
		<button class="btn" name="btn">Qidiruv..</button>
	</form>
</div>
	<?php 
		$result = $crud->qarzlarim($user_id);
		
	 ?>
	 <a class="insert" href="get.php?id=<?php echo $user_id; ?>">Qo'shish</a>
	<div class="container">
<h2 class="h2Qarz">Qarzlaringni vaqtida to'laa </h2>
		<table class="table">
			<thead class="thead">
				<tr>
					<th>Name</th>
					<th>Summasi</th>
					<th>Olgan vaqtim</th>
					<th>Qaytarish Muddatim</th>
					<th>Xolati</th>
					<th>Rachot</th>
					<th>Yangilash</th>
				</tr>
			</thead>
			<tbody class="tbody">
					<?php foreach ($result as $key): ?>
						
				
						<?php
						$selects = $key['selects'];
						$years = $key['qaytarishMuttatim'];
						$arr = explode("-", $years);
						$yil = $arr['0'];
						$oy = $arr['1'];
						$kun = $arr['2'];

						$date = date("Y-m-d");
						$dates = explode("-", $date);
						$year = $dates['0'];
						$month = $dates['1'];
						$dat = $dates['2'];
						
						 ?>
						 <?php 
						 	if ($yil == $year && $oy == $month && $kun == $dat) {
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="yellow">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Bugun ohirgi kun!"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 	}elseif ($yil == $year && $oy > $month) {
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="blue">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Xali vaqt bor"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 	}elseif ($yil == $year && $oy == $month && $kun > $dat) {
						 		$qoldi = $kun - $dat;
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="blue">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Muddat tugashiga ".$qoldi." kun qoldi!"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 		
						 	}elseif ($yil == $year && $oy == $month && $kun < $dat) {
						 		$qoldi = $dat - $kun;
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="red">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Muddatdan ".$qoldi." kun o'tib ketdi!"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 	}elseif ($yil == $year && $oy > $month) {
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="blue">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Xali vaqt bor"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 	}elseif ($yil == $year && $oy < $month) {
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="red">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Muddat o'tib ketdii"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 	}elseif ($yil > $year) {
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="blue">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Xali vaqt bor"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 	}elseif ($yil < $year) {
						 		if ($selects == 0) {
						 			$rang = "RangBerma";
						 		}elseif($selects == 1){
						 			$rang = "RangBer";
						 		}
						 		?>
						 			<tr class="red">
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['berganVaqtim']; ?></td>
										<td><?php echo $key['qaytarishMuttatim']; ?></td>
										<td><?php echo "Muddat o'tib ketdiikkuuu"; ?></td>
										<td>
											<?php echo $key['selects']; ?>
										</td>
										<td>
											<form action="Update.php" method="POST">
												<input type="hidden" name="id" value="<?php echo $key['id']; ?>">
												<input type="submit" name="btn" class="btn" value="Update">
											</form>
										</td>
									</tr>
						 		<?php
						 	}
						  ?>
				
					<?php endforeach; ?>

			</tbody>
		</table>
	</div>
</body>
</html>