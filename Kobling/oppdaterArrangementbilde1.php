<?php
    if (isset($_POST['anr'])) {
        require "../Kobling/kob.php";
        session_start();
        $pnr = $_SESSION['id'];
        $anr = $_POST['anr'];
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
                    
                    $sql = $conn->prepare("UPDATE arrangement SET Bilde = ? WHERE Anr = ?");
                    $sql->bind_param("ss", $filDestinasjon, $anr);
                    if ($sql->execute() === TRUE) {
                        
                        header("location: ../RedigerArrangement.php?arrangement=$anr&Oppdatert");
                        require("../Logger/Logger.php");
                        $log = new Logger("../Logger/Logg.txt");
                        $log->setTimestamp("d.m.Y H.i.s ");
                        $log->putLog("Bruker: ".$pnr." oppdaterte bilde på Arrangement: ".$anr."");
                        
                    } else {
                        header("location: ../RedigerArrangement.php?arrangement=$anr&error=$conn->error");
                    }
                    
                } else {
                    header("location: ../RedigerArrangement.php?arrangement=$anr&error=Filen_din_er_for_stor");
                }
            } else {
                header("location: ../RedigerArrangement.php?arrangement=$anr&error=Et_problem_oppstod");
            }
        } else {
            header("location: ../RedigerArrangement.php?arrangement=$anr&error=Feil_filtype");
        }
    }

?>