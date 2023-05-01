<?php
  $sql = $conn->prepare("SELECT * FROM følger WHERE FølgerPnr = ?");
  $sql->bind_param("s", $_SESSION['id']);
  $sql->execute();
  $result = $sql->get_result();
  $i = 0;
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

        $følgeTab[$i] = $row['FulgtPnr'];
        $i++;

      }
  }
?>
