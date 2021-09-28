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
	<a class="header" href="qarzlarim.php?id=<?php echo $user_id; ?>">Qarzlarim</a>
	<form action="search.php" method="POST">
		<input type="text" name="search" placeholder="qidiring...">
		<button class="btn" name="btn">Qidiruv..</button>
	</form>
</div>
<?php 
		$page = 3;
		if (isset($_GET['per'])) {
			$per = $_GET['per'];
		}else{
			$per = 1;
		}
		$sum = ($per-1)*$page;

		$results = $crud->qarzdorlikCount($user_id);
		$result = $crud->qarzdorlik($user_id, $sum, $page);
		$res = $results->fetchAll();
		$count = count($res);
		$pages = ceil($count / $page);

	 ?>
	 <div class="clr">
	 </div>
	 <a class="insert" href="set.php?id=<?php echo $user_id; ?>">Qo'shish</a>
	<div class="container">
		<h2 class="h2Qarz">Qarz Berganlarim</h2>
		<table class="table">
			<thead class="thead">
				<tr>
					<th>Delete</th>
					<th>Name</th>
					<th>Summasi</th>
					<th>Bergan vaqtim</th>
					<th>Qaytarish Muddati</th>
					<th>Xolati</th>
					<th><?php echo $count; ?></th>
					<th>Yangilash</th>
				</tr>
			</thead>
			<tbody class="tbody">
					<?php foreach ($result as $key): ?>
						<?php
						$idi = '';
						$delete = '';
						
						$years = $key['qaytarishMuddati'];
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}
						 		?>
						 			<tr class="yellow">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}

						 		?>
						 			<tr class="blue">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}
						 		?>
						 			<tr class="blue">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}
						 		?>
						 			<tr class="red">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}
						 		?>
						 			<tr class="blue">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}
						 		?>
						 			<tr class="red">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}
						 		?>
						 			<tr class="blue">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 		if ($key['selects'] == 0) {
						 			$rang = "RangBerma";
						 		}elseif($key['selects'] == 1){
						 			$rang = "RangBer";
						 			$idi = $key['selects'];
									$delete = "O'chirilsinmi";
						 		}
						 		?>
						 			<tr class="red">
						 				<td class="<?php echo $rang; ?> insert"><a href="Delete.php?id=<?=$key['id']; ?>"><?php echo $delete; ?></a></td>
										<td class="<?php echo $rang; ?>"><?php echo $key['name']; ?></td>
										<td><?php echo $key['summasi']; ?></td>
										<td><?php echo $key['olganVaqt']; ?></td>
										<td><?php echo $key['qaytarishMuddati']; ?></td>
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
						 	}
						  ?>
				
					<?php endforeach; ?>

			</tbody>
		</table>
		<?php for ($i=1; $i <= $pages; $i++): ?>
			<a href="qarzdorlar.php?per=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php endfor; ?>
	</div>
</body>
</html>