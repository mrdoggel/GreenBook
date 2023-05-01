<?php
  require "kob.php";

  if(isset($_POST["button"])) {
    $id = $_POST['id'];
    $aid = $_POST['aid'];
    $tekst = $_POST['innlegg-tekst'];

    $fil = $_FILES['Bilde'];
    $filNavn = $_FILES['Bilde']['name'];
    $filTmpNavn = $_FILES['Bilde']['tmp_name'];
    $filStrl = $_FILES['Bilde']['size'];
    $filType = $_FILES['Bilde']['type'];
    $filError = $_FILES['Bilde']['error'];

    $filExt = explode('.', $filNavn);
    $filFaktiskExt = strtolower(end($filExt));

    $lovlig = array('jpg', 'jpeg', 'png');
    if (!is_null($fil)) {
    if (in_array($filFaktiskExt, $lovlig)) {
      if ($filError === 0) {
        if ($filStrl < 1000000) {
          $filNavnNy = uniqid('', true).".".$filFaktiskExt;
          $filDestinasjon = 'Bilder/'.$filNavnNy;
          move_uploaded_file($filTmpNavn, "../".$filDestinasjon);

          $sql = "INSERT INTO innlegg (Tekst, Bilde, Pnr, Anr)
          VALUES ('$tekst', '$filDestinasjon', $id, $aid)";
          if ($conn->query($sql) === TRUE) {
            $sql1 = $conn->prepare("SELECT InnleggNr FROM innlegg WHERE Bilde = ?");
		    $sql1->bind_param("s", $filDestinasjon);
		    $sql1->execute();
		    $result1 = $sql1->get_result();
			if ($result1->num_rows > 0) {
				while($row = $result1->fetch_assoc()) {
				    $iId = $row["InnleggNr"];
				}
			}
            header("Location: ../Arrangement.php?arrangement=$aid");
            require("../Logger/Logger.php");
            $log = new Logger("../Logger/Logg.txt");
            $log->setTimestamp("d.m.Y H.i.s ");
            $log->putLog("Bruker: ".$id." la ut Innlegg: ".$iId);
          }
      } else {
        echo "Filen din er for stor!";
      }
    } else {
      echo "Det oppstod et problem med opplastingen.";
    }
  } else {
    echo "Du kan ikke laste opp filer av denne typen!";
  }
} else {
    $sql = "INSERT INTO innlegg (Tekst, Pnr, Anr)
          VALUES ('$tekst', $id, $aid)";
          if ($conn->query($sql) === TRUE) {
            header("Location: ../Arrangement.php?arrangement=$aid");
          }
}
}
?>
