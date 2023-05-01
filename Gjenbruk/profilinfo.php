<?php

require "Kobling/kob.php";
$pnr = $_GET['pnr'];
require "Gjenbruk/finnDineFølgere.php";
$følger = false;
$sql = $conn->prepare("SELECT * FROM person p, profil pr WHERE p.Pnr = ? AND p.Pnr = pr.Pnr");
$sql->bind_param("s", $pnr);
$sql->execute();
$result = $sql->get_result();
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
         $fornavn = $row["Fornavn"];
         $etternavn = $row["Etternavn"];
         $bio = $row['Bio'];
         $bilde = $row["Profilbilde"];
       }
     }
require "Gjenbruk/sjekkFølger.php";
?>

<div class = "profil-info">
  <div class="profil-bildenavn">
    <?php
    if (isset($bilde)) {
      ?>
      <img onclick="location.href='Profil.php?pnr=<?php echo $pnr; ?>'" src="<?php echo $bilde; ?>"> </img>
      <?php
    } else {
      ?>
      <img onclick="location.href='Profil.php?pnr=<?php echo $pnr; ?>'" src="Bilder/empty.jpg"></img>
      <?php
    }
  ?>

    <h2><?php echo $fornavn." ".$etternavn ?></h2>
  </div>
  <div class="profil-bio">
    <?php
      if (isset($bio)) {
      echo $bio;
    } else {
      echo "Bio.";
    }
    ?>
  </div>
  <div class="profil-venner">
        
        <p><?php echo $fornavn._HAS; ?>      <?php 
                                        if (isset($dineFølgereTab)) {
                                            $antallFølgere = sizeof($dineFølgereTab);
                                            echo $antallFølgere; 
                                        } else {
                                            echo 0;
                                        }
                                        ?> <?php echo _FOLLOWER; ?></p>
     
  </div>
  <div class="profil-venner">
    <?php
      if(!$følger) {
    ?>
        <a href="Kobling/følg.php?pnr=<?php echo $pnr; ?>"><?php echo _FOLLOW; ?></a>
    <?php
      } else {
    ?>
        <a href="Kobling/ikkeFølg.php?pnr=<?php echo $pnr; ?>"><?php echo _UNFOLLOW; ?></a>
    <?php
      }
    ?>
    
  </div>
</div>
