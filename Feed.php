<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Feed</title>
	<script src = "script.js">
	</script>
	<link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Feed.css">
</head>
<body>

	<div class="grid-container">
		<?php
		require "Gjenbruk/head.php";
		if($_GET['status'] == 1) {
			$radio1 = "checked";
			$radio2 = "";
			$radio3 = "";
		}
		if($_GET['status'] == 2) {
			$radio1 = "";
			$radio2 = "checked";
			$radio3 = "";
		}
		if($_GET['status'] == 3) {
			$radio1 = "";
			$radio2 = "";
			$radio3 = "checked";
		}
		?>
      <div class="left">
				<div class="radio-box">
						<input type="radio" id="påmeldt" onclick="location.href='Feed.php?status=1'" <?php echo $radio1; ?>>
						<label for="female"><?php echo _RADIO1; ?></label><br>
						<input type="radio" id="påmeldinger" onclick="location.href='Feed.php?status=2'" name="filter" <?php echo $radio2; ?>>
						<label class="radio-button"for="male"><?php echo _RADIO2; ?></label><br>
						<input type="radio" id="gjennomførelser" onclick="location.href='Feed.php?status=3'" name="filter" <?php echo $radio3; ?>>
						<label for="other"><?php echo _RADIO3; ?></label>
				</div>
      </div>
			<div class="main">

				<div class="feed-header">
					<h1><?php echo _EVENT; ?></h1>
				</div>

				<?php
				if($_GET['status'] == 1) {
					require "Gjenbruk/påmeldtArrangement.php";
				}
				if($_GET['status'] == 2) {
					require "Gjenbruk/arrangement.php";
				}
				if($_GET['status'] == 3) {
					require "Gjenbruk/påmeldingArrangement.php";
				}
				?>


			</div>
      <div class="right">

      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>
</body>
</html>
