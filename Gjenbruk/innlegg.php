<?php

  require "Kobling/kob.php";

  $sql = $conn->prepare("SELECT * FROM innlegg i, person p, profil pr WHERE i.Anr = ? AND i.Pnr = p.Pnr AND i.Pnr = pr.Pnr");
  $sql->bind_param("s", $aid);
  $sql->execute();
  $result = $sql->get_result();
  $rowcount = '0';
     if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
           $pid = $row['Pnr'];
           $innleggId = $row["InnleggNr"];
           $tekst = $row["Tekst"];
           //$dato = $row["Tid"]; dato postet?
           $fornavn = $row["Fornavn"];
           $etternavn = $row["Etternavn"];
           $bilde = $row["Bilde"];

           echo '<div class="arrangement-container">';
             echo '<div class="arrangement-container-box">';
               echo '<h1 class="arr-tittel">';
               echo '<a href="Profil.php?pnr=';
               echo $pid;
               echo '">';
               echo $fornavn." ".$etternavn."</a>"._PERSONSPOST;
               echo '</h1>';
               echo '<div class="arrangement-container-box-info">';
                 echo '<div class="arrangement-bilde">';
                   echo '<img src="';
                   echo $bilde;
                   echo '"></div>';
                 echo '<div class="arrangement-container-box-info-tekst">';
                   echo '<p>';
                   echo $tekst;
                   echo '</p>';
                   echo '<form method="POST" action="Kommentar.php">';
                   echo '<input type="hidden" name="innleggId" value="';
                   echo $innleggId;
                   echo '" />';
                   echo '<button class ="button-se-kommentar" type="submit" name="" value="">'._SEECOMMENTS.'</button>';
                   echo '</form>';
                   if($pid == $_SESSION['id'] || $_SESSION['id'] == 17) {
                     echo '<br><a href="Kobling/slettInnlegg.php?innlegg=';
                     echo $innleggId;
                     echo '&arrangement=';
                     echo $aid;
                     echo '">'._DELETEPOST.'</a>';
                   }
                   echo '
                 </div>
               </div>
             </div>
           </div>';

         }
       }

?>
