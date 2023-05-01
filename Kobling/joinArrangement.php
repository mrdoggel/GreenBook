<?php
  session_start();
  require "kob.php";

  if(isset($_GET["arrangement"])) {
    $anr = $_GET['arrangement'];
    $pnr = $_SESSION['id'];
    $sql1 = $conn->prepare("INSERT INTO påmelding (Pnr, Anr) VALUES (?, ?)");
    $sql1->bind_param("ss", $pnr, $anr);
    $sql2 = $conn->prepare("UPDATE arrangement SET Plasser = Plasser - 1 WHERE Anr = ?");
    $sql2->bind_param("s", $anr);
    
    if ($sql1->execute() === TRUE && $sql2->execute() === TRUE) {
        header("Location: ../Arrangement.php?arrangement=$anr");
        require("../Logger/Logger.php");
        $log = new Logger("../Logger/Logg.txt");
        $log->setTimestamp("d.m.Y H.i.s ");
        $log->putLog("Bruker: ".$pnr." meldte seg på Arrangement: ".$anr);
    }
  }
?>
