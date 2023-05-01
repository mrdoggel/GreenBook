<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta id="viewport" name="viewport" content ="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Profil</title>
	<script src = "script.js">
	</script>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Melding.css">
</head>
<body>
	<div class="grid-container">
		<?php
    require "Gjenbruk/head.php";
    require "Kobling/kob.php";
    $pnr = $_GET['pnr'];
    $sql = $conn->prepare("SELECT * FROM person p, profil pr WHERE p.Pnr = ? AND p.Pnr = pr.Pnr");
    $sql->bind_param("s", $pnr);
    $sql->execute();
    $result = $sql->get_result();
       if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
           $fornavn = $row['Fornavn'];
           $etternavn = $row['Etternavn'];
           $bilde = $row['Profilbilde'];
        }
      }

    ?>

      <div class="left">

      </div>

			<div class="main">

        <div class="profil">
          <?php if (!is_null($bilde)) { ?>
          <img src="<?php echo $bilde ?>" alt="">
        <?php } else { ?>
          <img src="Bilder/empty.jpg" alt="">
          <?php
        }
        ?>
          <h1><?php echo $fornavn." ".$etternavn; ?></h1>
        </div>
        <div id="scroll" class="melding-container">


          <div class="meldinger">

            <?php require "Gjenbruk/skrivMeldinger.php"; ?>

          </div>


        </div>
        <div class="send-container">
            <form method="post" action="Kobling/sendMelding.php">
              <input type="hidden" name="Person" value="<?php echo $pnr ?>">
              <input type="text" name="Tekst" id="chat" required autofocus></textarea>
            <div class="">
              <button type="submit" name="button" id ="send-btn" >Send</button>
            </form>
          </div>
          <br>
          <br>
          <br>
          <br>
        </div>

			</div>

      <div class="right">

      </div>
			<?php require "Gjenbruk/footer.php"; ?>
	</div>

</body>
</html>
