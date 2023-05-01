<?php session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Profil</title>
	<script src = "script.js">
	</script>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Profil.css">
	<link rel="stylesheet" type="text/css" href="Stylesheets/ArrangementSide.css">
</head>
<body>
	<div class="grid-container">
		<?php
			require "Gjenbruk/head.php";
		?>
      <div class="left">
          
          <?php 
      				if($_GET['pnr'] == $_SESSION['id']) {
      				    
      				    require "Gjenbruk/egenprofilinfo.php";
      				    
      				} else {
      				    
      				    require "Gjenbruk/profilinfo.php";
      				    
      				}
      				?>
          
      </div>
			<div class="main">
			    
			    <?php 
      				if($_GET['pnr'] == $_SESSION['id']) {
      				    
      				    require "Gjenbruk/egenProfilArrangement.php";
      				    
      				} else {
      				    
      				    require "Gjenbruk/profilArrangement.php"; 
      				    
      				}
      				?>

			</div>
			<div class="right">
				<div class="påmeldte-box">
			    <div class="påmeldte-box-container">
			      <h2><?php echo _IFOLLOW; ?></h2>
			      <div class="påmeldte-box-påmeldte">
      				<?php 
      				if($_GET['pnr'] == $_SESSION['id']) {
      				    
      				    require "Gjenbruk/finnEgenProfilFølgere.php"; 
      				    
      				} else {
      				    
      				    require "Gjenbruk/finnProfilFølgere.php";  
      				    
      				}
      				?>
					</div>
					</div>
				</div>
      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
