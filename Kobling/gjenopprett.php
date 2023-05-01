<?php

    if (isset($_POST['gjenopprett-knapp'])) {
    
        $kunde = $_POST['kunde'];
        $passord = $_POST['passord'];
        $gpassord = $_POST['gpassord'];
        if (!preg_match('/([a-z]{1,})/', $passord)) {
            $tekst =  "Passord må inneholde en liten bokstav.";
        }

        if (!preg_match('/([A-Z]{1,})/', $passord)) {
            $tekst = "Passord må inneholde en stor bokstav";
        }

        if (!preg_match('/([\d]{1,})/', $passord)) {
            $tekst = "Passord må inneholde et tall";
        }

        if (strlen($passord) < 8) {
            $tekst = "Passord må være minst 8 karakterer";
        }
        if ($passord != $gpassord) {
            
            $tekst = "Passordene stemmer ikke overens!";
            
        } else {
            
            require "Kobling/kob.php";
            $hash = password_hash($passord, PASSWORD_DEFAULT);
            $sql = $conn->prepare("UPDATE innlogging SET Passord = ? WHERE Pnr = ?");
            $sql->bind_param("ss", $hash, $kunde);
            if ($sql->execute() === TRUE) {
                
                require("Logger/Logger.php");
                $log = new Logger("Logger/Logg.txt");
                $log->setTimestamp("d.m.Y H.i.s ");
                $log->putLog("Bruker: ".$pnr." gjenopprettet passord");
                header("location: Index.php?passord_endret");
        
            } else {
                
              $tekst = "Error: " . $conn->error;
              
            }
            
        }
    
    }

?>