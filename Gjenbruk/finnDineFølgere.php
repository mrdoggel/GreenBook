<?php
  $sql = $conn->prepare("SELECT * FROM følger WHERE FulgtPnr = ?");
  $sql->bind_param("s", $pnr);
  $sql->execute();
  $result = $sql->get_result();
  $i = 0;
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

        $dineFølgereTab[$i] = $row['FølgerPnr'];
        $i++;

      }
  }
?>
