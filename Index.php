<?php 
session_start();
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
if (isset($_SESSION['lang'])) {
    require "Lang/lang_".$_SESSION['lang'].".php";
} else {
    require "Lang/lang_no.php";
}
require "Kobling/loggin.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title><?php echo _LOGINPAGE; ?></title>
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
				<div class="input-box">
          <div class="input-box-con">
            <h1><?php echo _LOGIN; ?></h1>
            <form action="Index.php" method="post">
              <input type="email" name="Epost" placeholder="<?php echo _EMAIL; ?>">
              <input type="password" name="Passord" placeholder="<?php echo _PASSWORD; ?>">

              <br><br>
              <a href="Registrering.php"><p id="regText"><?php echo _REGISTER; ?></p></a>
              <a href="Glemt.php"><p id="regText"><?php echo _FORGOTTEN; ?></p></a>
              <br>
              <button type="submit" name="logginn-knapp" id="logg-inn-btn"><?php echo _LOGIN; ?></button>
            </form><?php  if (count($errors) > 0) : ?>
  					<div class="error">
  						<?php foreach ($errors as $error) : ?>
  	  					<p><?php echo $error ?></p>
  						<?php endforeach ?>
  					</div>
					   <?php  endif ?>
          </div>
				</div>
			</div>
      <div class="right">

      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
