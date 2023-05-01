<?php
  session_start();
  require "kob.php";

  if(isset($_GET['pnr'])) {
    $pnr = $_SESSION['id'];
    $fpnr = $_GET['pnr'];
    $sql = $conn->prepare("DELETE FROM følger WHERE FølgerPnr = ? AND FulgtPnr = ?");
    $sql->bind_param("ss", $pnr, $fpnr);
    $sql->execute();
    if ($sql->execute() === TRUE) {

        header("location: ../Profil.php?pnr=$fpnr");
        require("../Logger/Logger.php");
        $log = new Logger("../Logger/Logg.txt");
        $log->setTimestamp("d.m.Y H.i.s ");
        $log->putLog("Bruker: ".$pnr." sluttet å følge Bruker: ".$fpnr);

    } else {
      echo "Error: " . $conn->error;
    }

  }

?>
