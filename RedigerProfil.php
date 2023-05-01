<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>RedigerProfil</title>
	<script src = "script.js">
	</script>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Innlogging.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Profil.css">
</head>
<body>
	<div class="grid-container">
    <?php require "Gjenbruk/head.php" ?>
      <div class="left">
      </div>
	    <div class="main">
        <div class="input-box">
			<div class="input-box-container">
            <h1><?php echo _EDITPROFILE; ?></h1>
            <div class="profil-bildenavn";>
                <div id="bildeLink" class="profil-bildenavn-bilder" onmouseover="bildeMouseover()" onmouseout="bildeMouseoverRemove()";>
              <?php
              if (isset($bilde)) {
                ?>
                <label for="fileField">
                <img id="outer-image" class="outer-image" src="<?php echo $bilde; ?>"></img>
                <div class="profil-bildenavn-bilder-midten">
                <img id="inner-image" class="inner-image" src="Bilder/upload.png"></img>
                </div>
                </label>
                <form id="bildeUpload" action="Kobling/oppdaterProfilbilde1.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="sjekk">
                    <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
                </form>
                </div>
                <?php
              } else {
                ?>
                <label for="fileField">
                <img id="outer-image" class="outer-image" src="Bilder/empty.jpg"></img>
                <div class="profil-bildenavn-bilder-midten">
                    <img id="inner-image" class="inner-image" src="Bilder/upload.png"></img>
                </div>
                </label>
                <form id="bildeUpload" action="Kobling/oppdaterProfilbilde1.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="sjekk">
                    <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
                </form>
                </div>
                <?php
              }
                $sql = $conn->prepare("SELECT * FROM person p, profil pr WHERE p.Pnr= ? AND p.Pnr = pr.Pnr");
                $sql->bind_param("s", $_SESSION["id"]);
                $sql->execute();
                $result = $sql->get_result();
  	            if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    
                        $fornavn = $row['Fornavn'];
                        $etternavn = $row['Etternavn'];
                        $email = $row['Epost'];
                        $fdato = $row['Fdato'];
                        $bio = $row['Bio'];
                    
                    }
  	            }
            ?>
            </div>

            <form method="POST" action="Kobling/oppdaterProfil.php">
                <input type="text" name="Fornavn" value="<?php echo $fornavn; ?>">
    			<input type="text" name="Etternavn" value="<?php echo $etternavn; ?>">
    			<input type="email" name="Epost" value="<?php echo $email; ?>">
    			<input type="date" name="Fødselsdato" value="<?php echo $fdato; ?>">
                <input type="text" name="Bio" id="text-input" value="<?php if(isset($bio)) { echo $bio; }?>">
    			<br>
    			<?php echo $_GET['error']; ?>
    			<br>
				<button type="submit" class="button" id="rediger-button" name="button"><?php echo _SAVE; ?></button>
            </form>
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
