<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Arrangement X</title>
  <link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Søk.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
</head>
<body>
	<script src="script.js">
	</script>
  <div class="grid-container">
    <?php
    require "Gjenbruk/head.php";
    ?>
    <div class="left">
    </div>
    <div class="main">

  <?php
  require "Kobling/kob.php";
  $søkeparameter = $_POST['søk'];
  $sql = $conn->prepare("SELECT pr.Profilbilde, p.Fornavn, p.Etternavn, p.Pnr FROM profil pr, person p WHERE
                        pr.Pnr in (SELECT p.Pnr FROM person p WHERE p.Fornavn LIKE '%$søkeparameter%' OR p.Etternavn LIKE '%$søkeparameter%')
                        AND pr.Pnr = p.Pnr");
  $sql->execute();
  $result = $sql->get_result();
     if ($result->num_rows > 0) {
       echo '<div class="arrangement-container">';
             echo '<div class="arrangement-container-box">';
               echo '<h1 class="arr-tittel">';
               echo _PERSONSEARCH .'"'.$søkeparameter.'"</h1>';
               
         while($row = $result->fetch_assoc()) {
           $pnr = $row["Pnr"];
           $fornavn = $row["Fornavn"];
           $etternavn = $row["Etternavn"];
           $profilbilde = $row["Profilbilde"];

           if (isset($fornavn)) {
                echo '<div class="personer">';
                echo "<a href='Profil.php?pnr=".$pnr."'>";
           if (!is_null($profilbilde)) {
             echo "<img style='border-radius:50%;' width='50px' height='50px' src='".$profilbilde."'>";
           } else {
             echo "<img style='border-radius:50%;' width='50px' height='50px' src='Bilder/empty.jpg'>";
           }
           echo $fornavn." ".$etternavn."</a></div>";
           }
           }
           echo "</div></div>";
         }
         ?>

         <?php
         $sql = $conn->prepare("SELECT * FROM arrangement a WHERE a.Tittel LIKE '%$søkeparameter%'");
         $sql->execute();
         $result = $sql->get_result();
            if ($result->num_rows > 0) {
              echo '<div class="arrangement-container">';
             echo '<div class="arrangement-container-box">';
               echo '<h1 class="arr-tittel">';
               echo _EVENTSEARCH.'"'.$søkeparameter.'"</h1>';
                while($row = $result->fetch_assoc()) {
                  $anr = $row["Anr"];
                  $tittel = $row["Tittel"];
                  $beskrivelse = $row["Beskrivelse"];
                  $dato = $row['Dato'];
                  $tid = $row['Tid'];
                  $sted = $row['Sted'];
                  $bilde = $row["Bilde"];

                  echo '<div class="arrangement-container">';
                    echo '<div class="arrangement-container-box">';
                      echo '<a class="arr-tittel" href="Arrangement.php?arrangement='; echo $anr; echo '"><h1>';
                        echo $tittel;
                      echo '</h1></a>';

                      echo '<div class="arrangement-container-box-info">';
                        echo '<div class="arrangement-bilde">';
                          if (!is_null($bilde)) {
                          echo '<img src="';
                          echo $bilde;
                          echo '">';
                        } else {
                          echo '<img src="Bilder/pngegg.png">';
                        }
                        echo '</div>';

                        echo '<div class="arrangement-container-box-info-tekst">';
                          echo $beskrivelse;
                          echo '<br><br>';
                          echo _TIME;
                          echo " ".$dato." ".$tid;
                          echo '<br><br>';
                          echo _PLACE;
                          echo " ".$sted;
                        echo '</div>';
                      echo '</div>';
                      echo '<div class="arrangement-container-box-admins">';
                      echo "<h3 style='text-decoration:underline;'>"._REGISTERED."</h3>";
                      //skriv ut alle påmeldte
                      $sql2 = $conn->prepare("SELECT * FROM person p, påmelding pm WHERE p.Pnr = pm.Pnr AND pm.Anr = ?");
                      $sql2->bind_param("s", $anr);
                      $sql2->execute();
                      $result2 = $sql2->get_result();
                         if ($result2->num_rows > 0) {
                             while($row2 = $result2->fetch_assoc()) {
                               $pid = $row2['Pnr'];
                               $påmeldte = $row2["Fornavn"];
                               echo '<a href="Profil.php?pnr=';
                               echo $pid;
                               echo '">';
                               echo $påmeldte;
                               echo '</a>';
                               echo "<br>";

                             }
                         }
                         echo '</div>
                              </div>
                            </div>';

                } echo "</div></div>";
            }

        ?>
  </div>
  <div class="right">

  </div>
  <?php require "Gjenbruk/footer.php"; ?>
</div>

</body>
</html>
