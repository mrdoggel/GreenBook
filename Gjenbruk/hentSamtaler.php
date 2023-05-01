<?php
require "Kobling/kob.php";
require "finnFølger.php";
    $pnr = $_SESSION['id'];
    $sql = $conn->prepare("SELECT * FROM melding m WHERE m.Pnr1 = ? OR m.Pnr2 = ? ");
    $sql->bind_param("ss", $pnr, $pnr);
    $sql->execute();
    $result = $sql->get_result();
    $i = 0;
    $pnrTab = array();
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
             $pnr1 = $row["Pnr1"];
             $pnr2 = $row["Pnr2"];
             if ($pnr1 != $pnr) {
               array_push($pnrTab, $pnr1);
             }
             if ($pnr2 != $pnr){
               array_push($pnrTab, $pnr2);
             }
             $pnrTab = array_unique($pnrTab, SORT_NUMERIC);
           }
       }
       for($i = 0; $i < sizeof($pnrTab); $i++) {
       $sql = $conn->prepare("SELECT * FROM person p, profil pr WHERE p.Pnr = ? AND p.Pnr = pr.Pnr GROUP BY p.Fornavn");
       $sql->bind_param("s", $pnrTab[$i]);
       $sql->execute();
       $result = $sql->get_result();

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $fornavn = $row["Fornavn"];
                $etternavn = $row["Etternavn"];
                $bilde = $row["Profilbilde"];

?>
<div class="person" onclick="location.href = 'Melding.php?pnr=<?php echo $pnrTab[$i]; ?>'">
  <?php
  if (isset($bilde)) {
    ?>
    <img width="50px" height="50px" src="<?php echo $bilde; ?>"> </img>
    <?php
  } else {
    ?>
    <img width="50px" height="50px" src="Bilder/empty.jpg"></img>
    <?php
  }
?>
  <p><?php echo $fornavn." ".$etternavn; ?></p>
</div>
<?php
}
}
}
?>
