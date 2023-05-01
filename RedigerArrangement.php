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
  <link rel="stylesheet" type="text/css" href="Stylesheets/Profil.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Innlogging.css">

</head>
<body>
  <?php

		require "Kobling/kob.php";

		$aid = $_GET['arrangement'];
		$sql = $conn->prepare("SELECT * FROM arrangement a WHERE a.Anr = ?");
		$sql->bind_param("s", $aid);
		$sql->execute();
		$result = $sql->get_result();
		$rowcount = '0';
			 if ($result->num_rows > 0) {
					 while($row = $result->fetch_assoc()) {
						 $tittel = $row["Tittel"];
						 $sted = $row["Sted"];
						 $beskrivelse = $row["Beskrivelse"];
						 $dato = $row["Dato"];
                         $tid = $row["Tid"];
						 $plasser = $row["Plasser"];
						 $abilde = $row["Bilde"];
					 }
				 }

	?>
	<div class="grid-container">
    <?php require "Gjenbruk/head.php" ?>
      <div class="left">

      </div>
			<div class="main">
        <div class="input-box">
					<div class="input-box-container">
            <h1><?php echo _EDITEVENT; ?></h1>
            <div class="profil-bildenavn">
                <div id="bildeLink" class="profil-bildenavn-bilder" onmouseover="bildeMouseover()" onmouseout="bildeMouseoverRemove()";>
                    <?php
                    if (!is_null($abilde)) {
                    ?>
                    <label for="fileField">
                    <img id="outer-image" class="outer-image" src="<?php echo $abilde; ?>">
                    <div class="profil-bildenavn-bilder-midten">
                        <img id="inner-image" class="inner-image" src="Bilder/upload.png"></img>
                    </div>
                    </label>
                    <form id="bildeUpload" action="Kobling/oppdaterArrangementbilde1.php" method="post" enctype='multipart/form-data'>
                        <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
                        <input type="hidden" name="anr" value="<?php echo $aid ?>">
                    </form>
                    <?php
                    } else {
                    ?>
                    <label for="fileField">
                    <img id="outer-image" class="outer-image" src="Bilder/pngegg.png">
                    <div class="profil-bildenavn-bilder-midten">
                        <img id="inner-image" class="inner-image" src="Bilder/darkupload.png"></img>
                    </div>
                    </label>
                    <form id="bildeUpload" action="Kobling/oppdaterArrangementbilde1.php" method="post" enctype='multipart/form-data'>
                        <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
                        <input type="hidden" name="anr" value="<?php echo $aid ?>">
                    </form>
                    <?php
                    } 
                    ?>
                </div>
            </div>
            <form method="POST" action="Kobling/oppdaterArrangement.php">
                <input type="hidden" name="Aid" value="<?php echo $aid ?>">
                <input type="text" name ="Plasser" value="<?php echo $plasser; ?>">
                <input type="text" name="Tittel" maxlength="40" value="<?php echo $tittel; ?>">
    		    <input type="text" name="Sted" value="<?php echo $sted; ?>">
    			<input type="date" name="Dato" value="<?php echo $dato; ?>">
                <input type="time" name="Tid" value="<?php echo $tid; ?>">
                <input type="text" name="Beskrivelse" id="text-input" placeholder="" value="<?php echo $beskrivelse; ?>">
    			<br><br><br>
				<button class="button" type="submit" class="button" id="rediger-button" name="button"><?php echo _SAVE; ?></button>
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
