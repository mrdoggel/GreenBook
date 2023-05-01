<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Meldinger</title>
	<script src = "script.js">
	</script>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Innboks.css">
</head>
<body>
	<div class="grid-container">
		<?php require "Gjenbruk/head.php" ?>

      <div class="left">

      </div>

			<div class="main">

				<h1><?php echo _ACTIVE; ?></h1>
        <div class="innboks">

          <?php require "Gjenbruk/hentSamtaler.php"; ?>

        </div>


        <h1><?php echo _START; ?></h1>
        <div class="innboks">

          <?php require "Gjenbruk/hentFølger.php"; ?>

        </div>
			</div>

      <div class="right">

      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
