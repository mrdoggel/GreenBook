<?php
  session_start();
  require "kob.php";

  if(isset($_GET['kommentar'])) {

    $kommentar = $_GET['kommentar'];
    $innlegg = $_GET['innlegg'];
    $sql = $conn->prepare("DELETE FROM kommentar WHERE KommentarNr = ?");
    $sql->bind_param("s", $kommentar);
    $sql->execute();

    if ($sql->execute() === TRUE) {

        header("location: ../Kommentar.php?iId=$innlegg");
        require("../Logger/Logger.php");
        $log = new Logger("../Logger/Logg.txt");
        $log->setTimestamp("d.m.Y H.i.s ");
        $log->putLog("Bruker: ".$_SESSION['id']." slettet Kommentar: ".$kommentar);

    } else {
      echo "Error deleting record: " . $conn->error;
    }

  }

?>
