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
      <div id="bildeLink" class="profil-bildenavn-bilder" onmouseover="bildeMouseover()" onmouseout="bildeMouseoverRemove()";>
    <?php
    if (isset($bilde)) {
      ?>
          <label for="fileField">
          <img id="outer-image" class="outer-image" src="<?php echo $bilde; ?>"> </img>
          <div class="profil-bildenavn-bilder-midten">
                <img id="inner-image" class="inner-image" src="Bilder/upload.png"></img>
          </div>
          </label>
          <form id="bildeUpload" action="Kobling/oppdaterProfilbilde2.php" method="post" enctype='multipart/form-data'>
            <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
            <input type="hidden" name="sjekk">
          </form>
      <?php
    } else {
      ?>
        <label for="fileField">
        <img id="outer-image" class="outer-image" src="Bilder/empty.jpg"></img>
        <div class="profil-bildenavn-bilder-midten">
            <img id="inner-image" class="inner-image" src="Bilder/upload.png"></img>
        </div>
        </label>
        <form id="bildeUpload" action="Kobling/oppdaterProfilbilde2.php" method="post" enctype='multipart/form-data'>
            <input type="file" id="fileField" name="Bilde" hidden="true" onchange="submitBilde()">
            <input type="hidden" name="sjekk">
        </form>
      <?php
    }
  ?>
    </div>
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
        
        <p><?php echo _YOUHAVE; ?> <?php 
                    if (isset($dineFølgereTab)) {
                        $antallFølgere = sizeof($dineFølgereTab);
                        echo $antallFølgere; 
                        echo _FOLLOWER."</p>";
                        echo '<button type="button" class="button" id="rediger-button" onclick="location.href =';
                        echo "'SeFølgere.php'";
                        echo '" name="button">'._SEEFOLLOWERS.'</button>';
                    } else {
                        echo 0;
                        echo _FOLLOWER."</p>";
                    }
                  ?> 
        
     
  </div>
  <div class="profil-venner">
    
        <button type="button" class="button" id="rediger-button" onclick="location.href = 'RedigerProfil.php'" name="button"><?php echo _EDITPROFILE; ?></button>
     
  </div>
  
</div>
