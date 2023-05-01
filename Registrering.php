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
require "Kobling/regg.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title><?php echo _REGISTRATION; ?></title>
	<link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Innlogging.css">
</head>
<body>
	<?php
	if (empty($_POST['Fornavn'])) {
		$_POST['Fornavn'] = "";
		$_POST['Etternavn'] = "";
		$_POST['Epost'] = "";
		$_POST['Dato'] = "";
		$_POST['Passord'] = "";
		$_POST['Bekreft-passord'] = "";
	}
	?>
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
					<div class="input-box-container">
            <h1><?php echo _REGISTRATION; ?></h1>
            <form action="Registrering.php" method="POST">
              <input type="text" value="<?php echo $fnavn; ?>" name="Fornavn"placeholder="<?php echo _SURNAME; ?>">
    					<input type="text" value="<?php echo $enavn; ?>" name="Etternavn" placeholder="<?php echo _LASTNAME; ?>">
    					<input type="email" value="<?php echo $epost; ?>" name="Epost" placeholder="<?php echo _EMAIL; ?>">
    					<input type="date" value="<?php echo $dato; ?>" name="Dato">
    					<input type="password" name="Passord" placeholder="<?php echo _PASSWORD; ?>">
    					<input type="password" name="Bekreft-passord" placeholder="<?php echo _CONFIRM; ?>">
    					<br><br>

							<a href="Index.php"><p id="regText"><?php echo _ALREADYUSER; ?></p></a>
							<br>
							<button type="submit" name="reg-knapp" class="button"><?php echo _REGISTER; ?></button>
            </form>
						<?php  if (count($errors) > 0) : ?>
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
