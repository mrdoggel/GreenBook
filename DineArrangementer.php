<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	
	<script src = "script.js">
	</script>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Profil.css">
	<link rel="stylesheet" type="text/css" href="Stylesheets/DineArrangementer.css">
</head>
<body>
	<div class="grid-container">
		<?php require "Gjenbruk/head.php" ?>
		<title><?php echo _YOUREVENTS; ?></title>
      <div class="left">
				<div class="">
				</div>
      </div>
			<div class="main">

				<?php require "Gjenbruk/mineArrangement.php"?>

			</div>
      <div class="right">
				<div class="">
				</div>
      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
