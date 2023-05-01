
<?php

  require "Kobling/kob.php";

  $dinId = $_SESSION["id"];
  $sql = $conn->prepare("SELECT * FROM påmelding pm, person p, profil pr WHERE pm.Anr = ? AND pm.Pnr = p.Pnr AND pm.Pnr = pr.Pnr");
  $sql->bind_param("s", $aid);
  $sql->execute();
  $result = $sql->get_result();
  $rowcount = '0';
     if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
           $pid = $row["Pnr"];
           $fnavn = $row["Fornavn"];
           $enavn = $row["Etternavn"];
           $bilde = $row["Profilbilde"];


           echo '<div class="person">';
             echo '<div class="mini-bilde">';
              echo '<a href="Profil.php?pnr=';
                echo $pid;
                echo '">';
                    if (!is_null($bilde)) {
                  echo '<img style="border-radius:50%;" src="';
                echo $bilde;
               echo '" alt="">';
                    } else {
                        echo '<img style="border-radius:50%;" src="Bilder/empty.jpg">';
                    }
             echo '</div>';
             echo '<div class="person-navn">';
               echo $fnavn." ".$enavn;
             echo '</div>';
           echo '</div>';
           echo '</a>';
         }
       }

?>
