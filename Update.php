<?php 
	ob_start();
	include 'db.php';
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$summasi = $_POST['summasi'];
		$olganVaqt = $_POST['olganVaqt'];
		$qaytarishMuddati = $_POST['muddat'];
		$selects = $_POST['selects'];
		$result = $crud->SetUpdate($id, $name, $summasi, $olganVaqt, $qaytarishMuddati, $selects);
		if ($result) {
			header("Location: index.php");
			ob_end_flush();
		}
	}
	if (isset($_POST['btn'])) {
		$id = $_POST['id'];
		$result = $crud->Update($id);
		if ($result) {
			?>
			<link rel="stylesheet" type="text/css" href="style.css">
			<div class="container">
				<div class="form">
					<form action="" method="POST" enctype="multipart/form-data">
						<h3 class="centir">Qarz berdim</h3>
						<label>Kimga/Nimaga</label>
						<input type="text" name="name" value="<?=$result['name']; ?>">
						<input type="hidden" name="id" value="<?=$result['id']; ?>">
						<label>Qarz miqdori(so'mda)</label>
						<input type="text" name="summasi" value="<?=$result['summasi']; ?>">
						<label>Qarz bergan kunim</label>
						<input type="date" name="olganVaqt" value="<?=$result['olganVaqt']; ?>">
						<label>To'lash muddati</label>
						<input type="date" name="muddat" value="<?=$result['qaytarishMuddati']?>">
						<select name="selects">
							<option value="0">To'lanmadi</option>
							<option value="1">To'landi</option>
						</select>
						<button class="btn" name="update">Qo'shish</button>
					</form>
				</div>
			</div>
			<?php
		}
	}
 ?>