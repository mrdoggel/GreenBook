<?php
session_start();
if (isset($_SESSION['lang'])) {
    require "Lang/lang_".$_SESSION['lang'].".php";
} else {
    require "Lang/lang_no.php";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title><?php echo _FORGOTTEN2; ?></title>
	<link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Innlogging.css">
</head>
<body>
	<div class="grid-container">
    <div class="head">
      <div class="logo">
        <h1>GreenBook</h1>
      </div>
    </div>
      <div class="left">

      </div>
			<div class="main">
			    <?php require "Kobling/glemt.php"; ?>
    			<div class="input-box">
                    <div class="input-box-con">
                        <h1><?php echo _FORGOTTEN2; ?></h1>
                        <form action="Glemt.php" method="post">
                          <input type="email" name="Epost" placeholder="<?php echo _YOUREMAIL; ?>">
                          <input type="email" name="GjentaEpost" placeholder="<?php echo _REPEATEMAIL; ?>"><br><br>
                          <p><?php echo $tekst; ?></p>
                          <a href="Index.php"><p id="regText"><?php echo _LOGIN; ?></p></a>
                          <a href="Registrering.php"><p id="regText"><?php echo _REGISTER; ?></p></a>
                          <button type="submit" name="glemt-knapp" id="logg-inn-btn"><?php echo _SEND; ?></button>
                        </form>
                    </div>
    			</div>
			</div>
      <div class="right">

      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
