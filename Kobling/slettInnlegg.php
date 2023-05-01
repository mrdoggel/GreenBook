<?php
  session_start();
  require "kob.php";

  if(isset($_GET['innlegg'])) {

    $aid = $_GET['arrangement'];
    $innlegg = $_GET['innlegg'];
    $sql = $conn->prepare("DELETE FROM innlegg WHERE InnleggNr = ?");
    $sql->bind_param("s", $innlegg);
    $sql->execute();

    if ($sql->execute() === TRUE) {

        header("location: ../Arrangement.php?arrangement=$aid");
        require("../Logger/Logger.php");
        $log = new Logger("../Logger/Logg.txt");
        $log->setTimestamp("d.m.Y H.i.s ");
        $log->putLog("Bruker: ".$_SESSION['id']." slettet Innlegg: ".$innlegg);

    } else {
      echo "Error deleting record: " . $conn->error;
    }

  }

?>
