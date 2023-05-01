<?php
$meg = $_SESSION['id'];
$sql = $conn->prepare("SELECT * FROM melding m WHERE m.Pnr1 = ? AND m.Pnr2 = ? OR m.Pnr1 = ? AND m.Pnr2 = ? ORDER BY TimeStamp DESC");
   $sql->bind_param("ssss", $meg, $pnr, $pnr, $meg);
   $sql->execute();
   $result = $sql->get_result();
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $sender = $row['Pnr1'];
            $mottager = $row['Pnr2'];
            $melding = $row['Melding'];
            $timeStamp = $row['TimeStamp'];
            if ($sender == $meg) {
                echo '<div class="melding-sendt"><p>';
                echo $timeStamp."<br> ".$melding;
                echo '</p></div><br>';
            } else {
                echo '<div class="melding-motatt"><p>';
                echo $timeStamp."<br> ".$melding;
                echo '</p></div><br>';
            }
          }
      }
?>
