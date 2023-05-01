<?php
  if (isset($_GET['brukerId'])) {
    $brukerId = $_GET['brukerId'];
    $sql = $conn->prepare("SELECT Profilbilde FROM profil WHERE Pnr = ?");
    $sql->bind_param("s", $brukerId);
    $sql->execute();
    $result = $sql->get_result();
    $array = mysqli_fetch_array($result);
    if ($result->num_rows > 0) {

        echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';

    }
  }
  else {
    echo "error";
  }
?>
