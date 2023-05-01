<div class="kommentar-container">

  <?php
  require "Kobling/kob.php";

  if(isset($_GET["iId"])) {
    $innleggNr = $_GET["iId"];
  }
  else {
    $innleggNr = $_POST['innleggId'];
  }
  $sql = $conn->prepare("SELECT * FROM person p, kommentar k, profil pr WHERE k.InnleggNr = ? AND k.Pnr = p.Pnr AND k.Pnr = pr.Pnr");
  $sql->bind_param("s", $innleggNr);
  $sql->execute();
  $result = $sql->get_result();
     if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
           $person = $row["Pnr"];
           $kommentarNr = $row["KommentarNr"];
           $fornavn = $row["Fornavn"];
           $etternavn = $row["Etternavn"];
           $tekst = $row["Tekst"];
           $bilde = $row["Profilbilde"];


           echo '<div class="kommentar">
             <div class="kommentar-profil">';
             if (isset($bilde)) {
               echo '<img src="';
               echo $bilde;
               echo '" alt=""></img>';
             } else {
                 echo '<img src="Bilder/empty.jpg"></img>';
             }
               echo '<h2>';
               echo $fornavn." ".$etternavn;
               echo '</h2>
             </div>
             <hr>
             <div class="kommentar-tekst">
               <p>';
               echo $tekst;
               echo '</p><br>';
               if ($person == $_SESSION["id"] || $_SESSION['id'] == 17) {
               echo '<a href="Kobling/slettKommentar.php?kommentar=';
               echo $kommentarNr;
               echo '&innlegg=';
               echo $innleggNr;
               echo '">Slett kommentar</a>';
               } else {
                 
               }
             echo '</div>
           </div>';

         }
       }

  ?>
