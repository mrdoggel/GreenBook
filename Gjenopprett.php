<?php 
require "Kobling/gjenopprett.php"; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Gjenopprett passord</title>
	<link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Innlogging.css">
</head>
<?php 
$epost = $_GET['email']; 
require "Kobling/kob.php";
$sql = $conn->prepare("SELECT Pnr FROM innlogging WHERE Epost = ?");
    $sql->bind_param("s", $epost);
    $sql->execute();
    $result = $sql->get_result();
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
               $pnr = $row['Pnr'];
           }
       }
?>
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
                        <h1>Gjenopprett passord</h1>
                        <form action="Gjenopprett.php" method="post">
                          <input type="password" name="passord" placeholder="Nytt passord">
                          <input type="password" name="gpassord" placeholder="Gjenta passord"><br><br>
                          <input type="hidden" name="kunde" value="<?php echo $pnr; ?>">
                          <p><?php echo $tekst; ?></p>
                          <a href="Index.php"><p id="regText">Logg inn</p></a>
                          <a href="Registrering.php"><p id="regText">Registrer deg</p></a>
                          <button type="submit" name="gjenopprett-knapp" id="logg-inn-btn">Send inn</button>
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
