<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<script src = "script.js">
	</script>
	<title>OpprettArrangement</title>
	<link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
	<link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Profil.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Innlogging.css">

</head>
<body>
	<script src="script.js">

	</script>
	<div class="grid-container">
		<?php require "Gjenbruk/head.php" ?>
			<div class="left">

			</div>
			<div class="main">
				<div class="input-box">
					<div class="input-box-container">
					<h1><?php echo _CREATEEVENT; ?></h1>
					<div class="profil-bildenavn">


					</div>
						<form method="post" action="Kobling/opprettArrangement.php">
							<input type="text" name="tittel" maxlength="40" placeholder="<?php echo _TITLE; ?>">
							<input type="hidden" name="pnr" value="<?php echo $_SESSION['id']; ?>">
							<input type="text" name="sted" placeholder="<?php echo _WHERE; ?>">
							<input type="date" name="dato">
							<input type="time" name="tid">
							<input type="text" name="plasser" placeholder="<?php echo _XSPOTS; ?>">
							<input type="text" name="arrangement-tekst" id="text-input" placeholder="<?php echo _DESCRIBE; ?>"></textarea>
							<button class="button" id="rediger-button" type="submit" name="btn-opprett"><?php echo _CREATEEVENT; ?></button>
							</form>
						</div>
					</div>
					</div>


		</div>
		<div class="right">
			<div class="">

			</div>
		</div>

		<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
