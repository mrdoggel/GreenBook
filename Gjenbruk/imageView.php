<?php
    require_once "Kobling/kob.php";
    $sql = "SELECT Profilbilde FROM profil WHERE Pnr = $_GET['id']";
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
    echo $row["Profilbilde"];
	  mysqli_close($conn);
?>
