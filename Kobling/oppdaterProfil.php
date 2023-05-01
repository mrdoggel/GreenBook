<?php
    session_start();
    require "kob.php";

    if(isset($_POST['button'])) {
        $pnr = $_SESSION['id'];
        $fornavn = $_POST['Fornavn'];
        $etternavn = $_POST['Etternavn'];
        $epost = $_POST['Epost'];
        $fdato = $_POST['Fødselsdato'];
        $bio = $_POST['Bio'];
    
        $sql = $conn->prepare("UPDATE person SET Fornavn = ?, Etternavn = ?, Epost = ?, Fdato = ? WHERE Pnr = ?");
        $sql2 = $conn->prepare("UPDATE profil SET Bio = ? WHERE Pnr = ?");
        $sql->bind_param("sssss", $fornavn, $etternavn, $epost, $fdato, $pnr);
        $sql2->bind_param("ss", $bio, $pnr);
        if ($sql->execute() === TRUE && $sql2->execute() === TRUE) {
    
            header("location: ../Profil.php?pnr=$pnr&Oppdatert");
            require("../Logger/Logger.php");
            $log = new Logger("../Logger/Logg.txt");
            $log->setTimestamp("d.m.Y H.i.s ");
            $log->putLog("Bruker: ".$pnr." oppdaterte personalia");
    
        } else {
                echo $conn->error;
        }
    
    }

?>
