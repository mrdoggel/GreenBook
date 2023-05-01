<?php
    if (isset($_POST['glemt-knapp'])) {
        $robo = 'gjenoppretting@greenbook.one';
        $kunde = $_POST['Epost'];
        $kunde = strtolower($kunde);
        $gjenta = $_POST['GjentaEpost'];
        if ($kunde != $gjenta) {
            
            $tekst = "Epostene stemmer ikke overens.";
            
        } else {

            require "Kobling/kob.php";
            $sql = $conn->prepare("SELECT * FROM innlogging WHERE Epost = ?");
            $sql->bind_param("s", $kunde);
            $sql->execute();
            $result = $sql->get_result();
            if ($result->num_rows > 0) {
               
                require("PHPMailer/PHPMailer.php");
                require("PHPMailer/SMTP.php");
    
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); // enable SMTP
    
                $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "send.one.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "gjenoppretting@greenbook.one";
                $mail->Password = "Gruppe8Alex";
                $mail->SetFrom("gjenoppretting@greenbook.one");
                $mail->Subject = "Passord gjenoppretting";
                $mail->CharSet = "UTF-8";
                $mail->Body = "Trykk på linken nedenfor for å gjenopprette passord<br><a href=greenbook.one/Gjenopprett.php?email=$kunde>Gjenopprett passord</a>";
                $mail->AddAddress("$kunde");
    
                if(!$mail->Send()) {
                    $tekst = "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    $tekst = "Om eposten din er registrert<br>vil du få en mail om få minutter";
                }
            } else {
                $tekst = "Om eposten din er registrert vil du få en<br>mail om få minutter(men det er den ikke)";
            }
            
        }
           
    }


?>
