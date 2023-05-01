<?php
$sql = $conn->prepare("SELECT * FROM påmelding WHERE Anr = ?");
$sql->bind_param("s", $aid);
$sql->execute();
$result = $sql->get_result();
$påmeldt = false;
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {

         $påmeldtPnr = $row['Pnr'];
         if ($påmeldtPnr == $_SESSION['id']) {
           $påmeldt = true;
         }
       }
   }
?>
