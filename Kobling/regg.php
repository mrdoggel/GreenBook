<?php

// initializing variables
$errors = array();

// connect to the database
require "Kobling/kob.php";

// receive all input values from the form
$fnavn = mysqli_real_escape_string($conn, $_POST['Fornavn']);
$enavn = mysqli_real_escape_string($conn, $_POST['Etternavn']);
$epost = mysqli_real_escape_string($conn, $_POST['Epost']);
$epost = strtolower($epost);
$dato = mysqli_real_escape_string($conn, $_POST['Dato']);
$passord = mysqli_real_escape_string($conn, $_POST['Passord']);
$bpassord = mysqli_real_escape_string($conn, $_POST['Bekreft-passord']);

// REGISTER USER
if (isset($_POST['reg-knapp'])) {

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($fnavn)) { array_push($errors, "Fornavn kreves"); }
    if (empty($enavn)) { array_push($errors, "Etternavn kreves"); }
    if (empty($epost)) { array_push($errors, "Epost kreves"); }
    if (empty($dato)) { array_push($errors, "Dato kreves"); }
    if (empty($passord)) { array_push($errors, "Passord kreves"); }
    if (!preg_match('/([a-z]{1,})/', $passord)) {
        array_push($errors, "Passord må inneholde en liten bokstav.");
    }

    if (!preg_match('/([A-Z]{1,})/', $passord)) {
        array_push($errors, "Passord må inneholde en stor bokstav");
    }

    if (!preg_match('/([\d]{1,})/', $passord)) {
       array_push($errors, "Passord må inneholde et tall");
    }

    if (strlen($passord) < 8) {
        array_push($errors, "Passord må være minst 8 karakterer");
    }
    
    if ($passord != $bpassord) {
	    array_push($errors, "Passordene passer ikke");
    }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM person WHERE Epost='$epost' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['Epost'] === $epost) {
      array_push($errors, "Epost finnes allerede");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$hash = password_hash($passord, PASSWORD_DEFAULT);//encrypt the password before saving in the database
  	$query = "INSERT INTO person (Fornavn, Etternavn, Fdato, Epost) VALUES ('$fnavn', '$enavn', '$dato', '$epost')";
  	$query2 = "INSERT INTO profil (Bio, Profilbilde) VALUES (NULL, NULL);";
  	$query3 = "INSERT INTO innlogging (Epost, Passord) VALUES ('$epost', '$hash')";
    if ($conn->query($query) === TRUE && $conn->query($query2) === TRUE && $conn->query($query3) === TRUE) {
      $_SESSION['fnavn'] = $fnavn;
      $_SESSION['success'] = "Du er nå registrert";
      header('location: cfgimport.com?registrert');
    } else {
      echo "Error: " . $query . "<br>" . $conn->error;
      exit();
      }

  }
}
