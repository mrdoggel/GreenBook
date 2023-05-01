<?php
require "Kobling/kob.php";
$pnr = $_SESSION['id'];
require "finnDineFølgere.php";

if (isset($dineFølgereTab) > 0) {
  for ($i = 0; $i < sizeof($dineFølgereTab) + 1; $i++) {
    $pnr = $dineFølgereTab[$i];
    $sql = $conn->prepare("SELECT * FROM person p, profil pr WHERE p.Pnr = ? AND p.Pnr = pr.Pnr");
    $sql->bind_param("s", $pnr);
    $sql->execute();
    $result = $sql->get_result();
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
                $fornavn = $row["Fornavn"];
                $etternavn = $row["Etternavn"];
                $bilde = $row["Profilbilde"];
                ?>
                <div class="person" onclick="location.href = 'Profil.php?pnr=<?php echo $pnr; ?>'">
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
}
?>
