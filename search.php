<?php
	require_once "db.php";

	if (isset($_POST['btn'])) {
		$search = $_POST['search'];

		$stmt = $crud->Search($search);
		$count = $stmt->rowCount();
		$stmt2 = $crud->Searches($search);
		$count2 = $stmt2->rowCount();
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Search</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 	<div id="header">
	<a class="header" href="get.php">Qarz olish</a>
	<a class="header" href="set.php">Qarz berish</a>
	<a class="header" href="qarzlarim.php">Qarzlarim</a>
	<form action="search.php" method="POST">
		<input type="text" name="search" placeholder="qidiring...">
		<button class="btn" name="btn">Qidiruv..</button>
	</form>
</div>
 	<?php 
 		if ($count>0 || $count2>0) {
 			if ($count>0) {
 				?>
 		<div class="container">
 			<table class="table">
				<thead class="thead">
		<h2 class="h2Qarz">Qarz Berganlarim</h2>
					<tr>
						<th>Delete</th>
						<th>Name</th>
						<th>Summasi</th>
						<th>Bergan vaqtim</th>
						<th>Qaytarish Muddati</th>
						<th>Xolati</th>
						<th>Rachot</th>
						<th>Yangilash</th>
					</tr>
				</thead>
			
			<?php
			
 				while ($key = $stmt->fetch(PDO::FETCH_ASSOC)) {
 				?>
 				<tbody class="tbody">
					
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
 						</tbody>
 		<?php
 						}	
		?>
	 			</table>
	 		</div>
 		<?php			

 			}
 			

 			if ($count2>0) {
 				?>
 		<div class="container">
 			<table class="table">
				<thead class="thead">
		<h2 class="h2Qarz">Qarzlaringni vaqtida to'laa </h2>
					<tr>
						<th>Delete</th>
						<th>Name</th>
						<th>Summasi</th>
						<th>Bergan vaqtim</th>
						<th>Qaytarish Muddati</th>
						<th>Xolati</th>
						<th>Rachot</th>
						<th>Yangilash</th>
					</tr>
				</thead>
			
			<?php
			
 				while ($key = $stmt2->fetch(PDO::FETCH_ASSOC)) {
 				?>
 				<tbody class="tbody">
					
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
 						</tbody>
 		<?php
 						}	
		?>
	 			</table>
	 		</div>
 		<?php			

 			}
 			
 		}
 	?>		
 </body>
 </html>