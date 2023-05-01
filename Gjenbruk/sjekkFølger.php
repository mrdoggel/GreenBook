<?php

$følger = false;
$sql = $conn->prepare("SELECT * FROM følger WHERE FølgerPnr = ? AND FulgtPnr = ?");
$sql->bind_param("ss", $_SESSION['id'], $pnr);
$sql->execute();
$result = $sql->get_result();
   if ($result->num_rows > 0) {
       $følger = true;
     }
?>
