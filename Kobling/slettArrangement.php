<?php 
        
        $anr = $_GET["arrangement"];
        require "../Kobling/kob.php";
        $sql = $conn->prepare("SELECT * FROM arrangement a, innlegg i, kommentar k WHERE a.Anr = ? AND a.Anr = i.Anr AND i.InnleggNr = k.InnleggNr");
		$sql->bind_param("s", $anr);
		$sql->execute();
		$result = $sql->get_result();
			 if ($result->num_rows > 0) {
					 while($row = $result->fetch_assoc()) {
					    $iNr = $row["InnleggNr"];
					 }
				 }
				 
        $sql1 = $conn->prepare("DELETE FROM kommentar WHERE KommentarNr = ?");
        $sql1->bind_param("s", $iNr);
        $sql2 = $conn->prepare("DELETE FROM innlegg WHERE Anr = ?");
        $sql2->bind_param("s", $anr);
        $sql3 = $conn->prepare("DELETE FROM arrangement WHERE Anr = ?");
        $sql3->bind_param("s", $anr);
        
        if ($sql1->execute() === TRUE && $sql2->execute() === TRUE && $sql3->execute() === TRUE) {
            
            header("location: ../Feed.php?status=1");
            require("../Logger/Logger.php");
            $log = new Logger("../Logger/Logg.txt");
            $log->setTimestamp("d.m.Y H.i.s ");
            $log->putLog("Bruker: ".$_SESSION['id']." slettet Arrangement: ".$anr);
            
        } else {
            echo $conn->error;
        }
?>