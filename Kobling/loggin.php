<?php
$errors = array();

require_once("kob.php");

if (isset($_POST['logginn-knapp'])) {
  $username = mysqli_real_escape_string($conn, $_POST['Epost']);
  $username = strtolower($username);
  $password = mysqli_real_escape_string($conn, $_POST['Passord']);

  if (empty($username)) {
  	array_push($errors, "Epost kreves");
  }
  if (empty($password)) {
  	array_push($errors, "Passord kreves");
  }

  if (count($errors) == 0) {
    $sql = $conn->prepare("SELECT * FROM innlogging i, person p WHERE i.Epost= ? AND i.Epost = p.Epost");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();
  	if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
  	     $_SESSION['fornavn'] = $row['Fornavn'];
         $_SESSION['etternavn'] = $row['Etternavn'];
         $_SESSION['id'] = $row['Pnr'];
         $hash = $row['Passord'];
         if (password_verify($password, $hash)) {
            if ($_SESSION['id'] == 17) {
                
                header('location:Admin.php');
                require("Logger/Logger.php");
  	            $log = new Logger("Logger/Logg.txt");
                $log->setTimestamp("d.m.Y H.i.s ");
                $log->putLog("Bruker: ".$_SESSION['id']." logget inn");
                
            } else {
  	            header('location:Feed.php?logget_inn&status=1');
  	            require("Logger/Logger.php");
  	            $log = new Logger("Logger/Logg.txt");
                $log->setTimestamp("d.m.Y H.i.s ");
                $log->putLog("Bruker: ".$_SESSION['id']." logget inn");
            }
         }
      }
  	}else {
  		array_push($errors, "Feil brukernavn/passord kombinasjon");
  	}
  }
}

?>
