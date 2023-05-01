<?php
  session_start();
  require("../Logger/Logger.php");
  $log = new Logger("../Logger/Logg.txt");
  $log->setTimestamp("d.m.Y H.i.s ");
  $log->putLog("Bruker: ".$_SESSION['id']." logget ut");
  session_unset();
  session_destroy();
  header("Location:../Index.php");
?>
