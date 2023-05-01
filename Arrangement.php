<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title><?php echo _EVENT2; ?></title>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Profil.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/ArrangementSide.css">
</head>
<body>
	<script src="script.js">
	</script>

	<?php

		require "Kobling/kob.php";

		$aid = $_GET['arrangement'];
		$sql = $conn->prepare("SELECT * FROM arrangement a, person p WHERE a.Anr = ? AND a.Pnr = p.Pnr");
		$sql->bind_param("s", $aid);
		$sql->execute();
		$result = $sql->get_result();
		$påmeldt = false;
			 if ($result->num_rows > 0) {
					 while($row = $result->fetch_assoc()) {
						 $id = $row["Anr"];
						 $pnr = $row["Pnr"];
						 $tittel = $row["Tittel"];
						 $sted = $row["Sted"];
						 $beskrivelse = $row["Beskrivelse"];
						 $tid = $row["Tid"];
						 $dato = $row["Dato"];
						 $plasser = $row["Plasser"];
						 $fornavn = $row["Fornavn"];
						 $etternavn = $row["Etternavn"];
						 $profilbilde = $row["Bilde"];
					 }
				 }

	?>

	<div class="grid-container">
		<?php require "Gjenbruk/head.php" ?>
      <div class="left">
        <div class = "profil-info">
					<div class="profil-bildenavn">
					    <div id="bildeLink" class="profil-bildenavn-bilder" onmouseover="bildeMouseover()" onmouseout="bildeMouseoverRemove()";>
					        <?php if (isset($profilbilde)) {
					        ?>
					        <label for="fileField">
                            <img id="outer-image" class="outer-image" src="<?php echo $profilbilde; ?>" style="border-radius: 50%;">
                            <div class="profil-bildenavn-bilder-midten">
                                <img id="inner-image" class="inner-image" src="Bilder/upload.png"></img>
                            </div>
                            </label>
                            <form id="bildeUpload" action="Kobling/oppdaterArrangementbilde2.php" method="post" enctype='multipart/form-data'>
                                <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
                                <input type="hidden" name="anr" value="<?php echo $aid ?>">
                            </form>
                            <?php
					        } else {
					        ?>
					        <label for="fileField">
                            <img id="outer-image" class="outer-image" src="Bilder/pngegg.png" style="border-radius: 50%;">
                            <div class="profil-bildenavn-bilder-midten">
                                <img id="inner-image" class="inner-image" src="Bilder/darkupload.png"></img>
                            </div>
                            </label>
                            <form id="bildeUpload" action="Kobling/oppdaterArrangementbilde2.php" method="post" enctype='multipart/form-data'>
                                <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
                                <input type="hidden" name="anr" value="<?php echo $aid ?>">
                            </form>  
                            <?php
					        }
					        ?>
						</div>
						
						<h2><?php echo _ORGANIZER; ?><br><a href="Profil.php?pnr=<?php echo $pnr; ?>"><?php echo $fornavn." ".$etternavn; ?></h2></a>
					</div>
					<div class="profil-bio">
						<?php echo _DATE; ?>
						<?php echo $dato; ?>
						<br>
						<?php echo _TIME; ?>
						<?php echo $tid; ?>
            <br>
						<?php echo _PLACE; ?>
            <?php echo $sted; ?>
						<br>
						<?php echo _SPOTS; ?>
						<?php echo $plasser; ?>
					</div>
					<div class="profil-bio">
						<?php
							if($pnr == $_SESSION['id'] || $_SESSION['id'] == 17) {
						?>
            	<button type="button" class="button" id="rediger-button" onclick="location.href = 'RedigerArrangement.php?arrangement=<?php echo $aid; ?>'" name="button"><?php echo _EDITEVENT; ?></button><br>
            	<button type="button" class="button" id="rediger-button" onclick="location.href = 'Kobling/slettArrangement.php?arrangement=<?php echo $aid; ?>'" name="button"><?php echo _DELETEEVENT; ?></button>
						<?php
					} else {
						require "Gjenbruk/sjekkPåmeldt.php";
						if ($plasser > 0) {
						if (!$påmeldt) {
						?>
						<button type="button" class="button" id="rediger-button" onclick="location.href = 'Kobling/joinArrangement.php?arrangement=<?php echo $aid; ?>'" name="button"><?php echo _REGISTER1; ?></button>
						<?php
					} else {
						?>
						<button type="button" class="button" id="rediger-button" onclick="location.href = 'Kobling/unjoinArrangement.php?arrangement=<?php echo $aid; ?>'" name="button"><?php echo _UNREGISTER; ?></button>
						<?php
					}
				} else {
					echo "Arrangement fullt";
				}
					}
						?>
				  </div>

				</div>
      </div>
			<div class="main">
        <div class="overskrift-box">
          <h1><?php echo $tittel; ?></h1>
        </div>
        <div class="nytt-innlegg">
          <form action="Kobling/leggUt.php" method="post" enctype="multipart/form-data">
            <div class="innlegg-tekst">
              <textarea name="innlegg-tekst" rows="8" cols="80" maxlength="650" placeholder="<?php echo _WRITESOMETHING; ?>"></textarea>
            </div>
						<input type="file" name="Bilde" value="">
						<input type="hidden" name="id" value="<?php echo $id ?>" />
						<input type="hidden" name="aid" value="<?php echo $aid ?>" />
            <div class="innlegg-knapp">
              <button class="btn-innlegg" type="submit" name="button"><?php echo _POST; ?></button>

            </div>
          </form>
        </div>
				<?php require "Gjenbruk/innlegg.php"; ?>
			</div>
			<div class="right">
			  <div class="påmeldte-box">
			    <div class="påmeldte-box-container">
			      <h2><?php echo _REGISTERED; ?></h2>
			      <div class="påmeldte-box-påmeldte">
      				<?php require "Gjenbruk/påmeldte.php"; ?>
						</div>
					</div>
				</div>
			</div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
