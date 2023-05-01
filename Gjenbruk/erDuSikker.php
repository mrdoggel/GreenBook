<?php
$anr = $_GET['arrangement'];
$message = "Arrangementet vil bli slettet for alltid, er du sikker?";
echo "<script type='text/javascript'>confirm('$message');</script>";
            if(confirm)
            {
                header("location: ../SlettArrangement.php?arrangement=$anr");
            }
            else
            {
                header("location: ../Arrangement.php?arrangement=$anr");
            }
?>