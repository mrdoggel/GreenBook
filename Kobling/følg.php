<?php
  session_start();
  require "kob.php";

  if(isset($_GET['pnr'])) {
    $pnr = $_SESSION['id'];
    $fpnr = $_GET['pnr'];
    $sql = $conn->prepare("INSERT INTO følger (FølgerPnr, FulgtPnr) VALUES (?, ?)");
    $sql->bind_param("ss", $pnr, $fpnr);
    if ($sql->execute() === TRUE) {

        header("location: ../Profil.php?pnr=$fpnr");
        require("../Logger/Logger.php");
        $log = new Logger("../Logger/Logg.txt");
        $log->setTimestamp("d.m.Y H.i.s ");
        $log->putLog("Bruker: ".$pnr." fulgte Bruker: ".$fpnr);

    } else {
      echo "Error: " . $conn->error;
    }

  }

?>
