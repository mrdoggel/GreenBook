
<?php
require "Kobling/kob.php";
if(isset($_GET["iId"])) {
  $innleggNr = $_GET["iId"];
}
else {
  $innleggNr = $_POST['innleggId'];
}

$sql = $conn->prepare("SELECT * FROM person p, innlegg i WHERE i.InnleggNr = ? AND i.Pnr = p.Pnr");
$sql->bind_param("s", $innleggNr);
$sql->execute();
$result = $sql->get_result();
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
         $pnr = $row['Pnr'];
         $fornavn = $row["Fornavn"];
         $etternavn = $row["Etternavn"];
         $tekst = $row["Tekst"];
         $bilde = $row["Bilde"];
       }
     }

?>
<div class="arrangement-container-box">
  <h1 class="arr-tittel"><a href="Profil.php?pnr=<?php echo $pnr; ?>"><?php echo $fornavn." ".$etternavn."</a>"._PERSONSPOST."" ?></h1>

  <div class="arrangement-container-box-info">
    <div class="arrangement-bilde">
      <img src="<?php
      if (!is_null($bilde)) {
      echo $bilde;
    } else {
      echo "Bilder/pngegg.png";
    }
      ?>"></img>
    </div>

    <div class="arrangement-container-box-info-tekst">
      <p><?php echo $tekst; ?></p>

    </div>
  </div>
</div>
