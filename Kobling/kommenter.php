<?php
  require "kob.php";

  if(isset($_POST["button"])) {
    $id = $_POST['id'];
    $iId = $_POST['iId'];
    $tekst = $_POST['tekst'];
    $sql = $conn->prepare("INSERT INTO kommentar (Tekst, Pnr, InnleggNr) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $tekst, $id, $iId);
    if ($sql->execute() === TRUE) {
        $sql1 = $conn->prepare("SELECT KommentarNr FROM kommentar WHERE Tekst = ? AND Pnr = ? AND InnleggNr = ?");
		    $sql1->bind_param("sss", $tekst, $id, $iId);
		    $sql1->execute();
		    $result1 = $sql1->get_result();
			if ($result1->num_rows > 0) {
				while($row = $result1->fetch_assoc()) {
				    $kId = $row["KommentarNr"];
				}
			}
        header("Location: ../Kommentar.php?iId=$iId");
        require("../Logger/Logger.php");
        $log = new Logger("../Logger/Logg.txt");
        $log->setTimestamp("d.m.Y H.i.s ");
        $log->putLog("Bruker: ".$id." la ut Kommentar: ".$kId);
    }
  }
?>
