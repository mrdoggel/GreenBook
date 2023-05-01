<?php
    if (isset($_POST['sjekk'])) {
        require "../Kobling/kob.php";
        session_start();
        $pnr = $_SESSION['id'];
        $fil = $_FILES['Bilde'];
        $filNavn = $_FILES['Bilde']['name'];
        $filTmpNavn = $_FILES['Bilde']['tmp_name'];
        $filStrl = $_FILES['Bilde']['size'];
        $filType = $_FILES['Bilde']['type'];
        $filError = $_FILES['Bilde']['error'];
        $filExt = explode('.', $filNavn);
        $filFaktiskExt = strtolower(end($filExt));
        $lovlig = array('jpg', 'jpeg', 'png');
        
        if (in_array($filFaktiskExt, $lovlig)) {
            if ($filError === 0) {
                if ($filStrl < 1000000) {
                    
                    $filNavnNy = uniqid('', true).".".$filFaktiskExt;
                    $filDestinasjon = 'Bilder/'.$filNavnNy;
                    move_uploaded_file($filTmpNavn, "../".$filDestinasjon);
                    
                    $sql = $conn->prepare("UPDATE profil SET Profilbilde = ? WHERE Pnr = ?");
                    $sql->bind_param("ss", $filDestinasjon, $pnr);
                    if ($sql->execute() === TRUE) {
                        
                        header("location: ../RedigerProfil.php?Oppdatert");
                        require("../Logger/Logger.php");
                        $log = new Logger("../Logger/Logg.txt");
                        $log->setTimestamp("d.m.Y H.i.s ");
                        $log->putLog("Bruker: ".$pnr." oppdaterte profilbilde");
                        
                    } else {
                        header("location: ../RedigerProfil.php?error=".$conn->error);
                    }
                    
                } else {
                    header("location: ../RedigerProfil.php?error=Filen_din_er_for_stor");
                }
            } else {
                header("location: ../RedigerProfil.php?error=Et_problem_oppstod");
            }
        } else {
            header("location: ../RedigerProfil.php?error=Feil_filtype");
        }
    }

?>