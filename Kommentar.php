<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Kommentarside</title>
	<script src = "script.js">
	</script>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Kommentar.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
</head>
<body>
	<div class="grid-container">
			<?php require "Gjenbruk/head.php" ?>

      <div class="left">

      </div>

			<div class="main">

        <?php require "Gjenbruk/tittel.php"; ?>

        <button type="button" name="button" class="button" onclick="tilBunn()"><?php echo _TOBOTTOM; ?></button>

        <?php require "Gjenbruk/kommentarer.php"; ?>
        
        <button type="button" name="button" class="button" onclick="tilTopp()"><?php echo _TOTOP; ?></button>
        <form action="Kobling/kommenter.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <input type="hidden" name="iId" value="<?php echo $innleggNr; ?>" />
          <textarea name="tekst" rows="8" cols="80"></textarea>
          <button type="submit" name="button" class="button"><?php echo _COMMENT; ?></button>
        </form>
      </div>
			</div>

      <div class="right">

      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
