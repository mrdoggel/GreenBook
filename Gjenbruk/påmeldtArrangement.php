
<?php
//koble til databasen
         require 'Kobling/kob.php';
         $pnr = $_SESSION['id'];
         //Hent ut alle arrangementer med villkår i SQL spørring
         $sql = $conn->prepare("SELECT * FROM arrangement a, påmelding p WHERE p.Pnr = ? AND p.Anr = a.Anr");
         $sql->bind_param("s", $pnr);
         $sql->execute();
         $result = $sql->get_result();
         $rowcount = '0';
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $id = $row["Anr"];
                  $tittel = $row["Tittel"];
                  $sted = $row["Sted"];
                  $beskrivelse = $row["Beskrivelse"];
                  $plasser = $row["Plasser"];
                  $bilde = $row["Bilde"];
                  $dato = $row["Dato"];
                  $tid = $row["Tid"];

                  echo '<div class="arrangement-container">';
                    echo '<div class="arrangement-container-box">';
                      echo '<a class="arr-tittel" href="Arrangement.php?arrangement='; echo $id; echo '"><h1>';
                        echo $tittel;
                      echo '</h1></a>';

                      echo '<div class="arrangement-container-box-info">';
                        echo '<div class="arrangement-bilde">';
                        if (!is_null($bilde)) {
                        echo '<img src="';
                        echo $bilde;
                        echo '">';
                      } else {
                        echo '<img src="Bilder/pngegg.png">';
                      }
                        echo '</div>';

                        echo '<div class="arrangement-container-box-info-tekst">';
                          echo $beskrivelse;
                          echo '<br><br>';
                          echo _TIME;
                          echo " ".$dato." ".$tid;
                          echo '<br><br>';
                          echo _PLACE;
                          echo " ".$sted;
                        echo '</div>';
                      echo '</div>';
                      echo '<div class="arrangement-container-box-admins">';
                      echo "<h3 style='text-decoration:underline;'>"._REGISTERED."</h3>";
                      //skriv ut alle påmeldte
                      $sql2 = $conn->prepare("SELECT * FROM person p, påmelding pm WHERE p.Pnr = pm.Pnr AND pm.Anr = ?");
                      $sql2->bind_param("s", $id);
                      $sql2->execute();
                      $result2 = $sql2->get_result();
                         if ($result2->num_rows > 0) {
                             while($row2 = $result2->fetch_assoc()) {
                               $pid = $row2['Pnr'];
                               $påmeldte = $row2["Fornavn"];
                               echo '<a href="Profil.php?pnr=';
                               echo $pid;
                               echo '">';
                               echo $påmeldte;
                               echo '</a>';
                               echo "<br>";

                             }
                         }
                         echo '</div>
                              </div>
                            </div>';

                }
            }

?>
