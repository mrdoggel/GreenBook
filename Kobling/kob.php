<?php

$servername = "greenbook.one.mysql";
$dBusername = "greenbook_onegreenbook";
$dBpassword = "pw.123456";
$dBname ="greenbook_onegreenbook";

$conn = mysqli_connect($servername, $dBusername, $dBpassword, $dBname);

if (!$conn) {
  die("connection failed: ".mysqli_connect_error());
}
