<?php
session_start();
require "kob.php";

if(isset($_POST["button"])) {
  $senderen = $_SESSION['id'];
  $mottageren = $_POST['Person'];
  $meldingen = $_POST['Tekst'];
  $timestampen = date("Y-m-d H:i:s");
  $sql = "INSERT INTO melding (Pnr1, Pnr2, Melding, TimeStamp)
  VALUES ('$senderen', '$mottageren', '$meldingen', '$timestampen')";
  if ($conn->query($sql) === TRUE) {
    header("Location: ../Melding.php?pnr=$mottageren");
    require("../Logger/Logger.php");
    $log = new Logger("../Logger/Logg.txt");
    $log->setTimestamp("d.m.Y H.i.s ");
    $log->putLog("Bruker: ".$senderen." sendte melding til Bruker: ".$mottageren);
  }
  else {
    echo $conn->error;
  }
}
