<?php
require "../Kobling/kob.php";
if (isset($_POST['btn-opprett'])) {
    $tittel = $_POST['tittel'];
    $sted = $_POST['sted'];
    $beskrivelse = $_POST['arrangement-tekst'];
    $dato = $_POST['dato'];
    $tid = $_POST['tid'];
    $plasser = $_POST['plasser'];
    $pnr = $_POST['pnr'];
    
    
    
    $sql = $conn->prepare("INSERT INTO arrangement (Tittel, Sted, Beskrivelse, Dato, Tid, Plasser, Ferdig, Pnr)
                           VALUES (?, ?, ?, ?, ?, ?, 0, ?)");
    		 $sql->bind_param("sssssss", $tittel, $sted, $beskrivelse, $dato, $tid, $plasser, $pnr);      
    if ($sql->execute() === TRUE) {
        $sql1 = $conn->prepare("SELECT Anr FROM arrangement WHERE Tittel = ? AND Sted = ? AND Beskrivelse = ? AND Dato = ? AND Tid = ? AND Pnr = ?");
    	$sql1->bind_param("ssssss", $tittel, $sted, $beskrivelse, $dato, $tid, $pnr);
    	$sql1->execute();
    	$result1 = $sql1->get_result();
    	if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
    		    $anr = $row["Anr"];
    		}
    	}
        header("location: ../Arrangement.php?arrangement=$anr");
        require("../Logger/Logger.php");
        $log = new Logger("../Logger/Logg.txt");
        $log->setTimestamp("d.m.Y H.i.s ");
        $log->putLog("Bruker: ".$pnr." lagde arrangement: ".$anr);
    
    } else {
        $conn->error;
    }

}

?>
