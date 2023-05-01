<?php
  session_start();
  require "kob.php";

    if(isset($_POST['button'])) {
        $anr= $_POST['Aid'];
        $tittel= $_POST['Tittel'];
        $sted = $_POST['Sted'];
        $beskrivelse = $_POST['Beskrivelse'];
        $dato = $_POST['Dato'];
        $tid = $_POST['Tid'];
        $plasser = $_POST['Plasser'];
        
        $sql = $conn->prepare("UPDATE arrangement SET Tittel = ?, Sted = ?, Beskrivelse = ?, Dato = ?, Tid = ?, Plasser = ? WHERE Anr = ?");
        $sql->bind_param("sssssss", $tittel, $sted, $beskrivelse, $dato,  $tid, $plasser, $anr);
        $sql->execute();
        if ($sql->execute() === TRUE) {
    
            header("location: ../Arrangement.php?arrangement=$anr&Oppdatert");
    
        } else {
                echo $conn->error;
        }
    
    }


?>
