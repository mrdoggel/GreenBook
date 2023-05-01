<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="head">
    <div class="logo">
        <?php 
        if (isset($_GET['lang'])) {
            $_SESSION['lang'] = $_GET['lang'];
        }
        if (isset($_SESSION['lang'])) {
            require "Lang/lang_".$_SESSION['lang'].".php";
        } else {
            require "Lang/lang_no.php";
        }
        if ($_SESSION['id'] == 17) {
        ?>    
        
            <h1 onclick="location.href = 'Admin.php'">GreenBook</h1>
            
        <?php    
        } else {
        ?>
        
            <h1 onclick="location.href = 'Feed.php?status=1'">GreenBook</h1>
            
        <?php
        }
        ?>
    </div>
    <div class="search">
      <form method="post" action="Søk.php">
      <input type="text" name="søk" placeholder="<?php echo _SEARCHFIELD; ?>" required>
      <button name="søkeknapp" class="button"><?php echo _SEARCH; ?></button>
      </form>
    </div>
    <div class="header-bilde">
      <?php
      require 'Kobling/kob.php';
      $id = $_SESSION['id'];

      $sql = $conn->prepare("SELECT * FROM profil WHERE Pnr = ?");
      $sql->bind_param("s", $id);
      $sql->execute();
      $result = $sql->get_result();
      $rowcount = '0';
         if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
               $bilde = $row['Profilbilde'];
               $bio = $row['Bio'];
           }
         }
        ?>
        
        <?php
        if (isset($bilde)) {
          ?>
          <img onclick="location.href='Profil.php?pnr=<?php echo $id; ?>'" src="<?php echo $bilde; ?>"> </img>
          <?php
        } else {
          ?>
          <img onclick="location.href='Profil.php?pnr=<?php echo $id; ?>'" src="Bilder/empty.jpg"></img>
          <?php
        }
        echo "<div class='headernavn'><a href='Profil.php?pnr=".$_SESSION['id']."'>".$_SESSION['fornavn']." ".$_SESSION['etternavn']."</a></div>";
      ?>

    </div>
        <div class="dropdown">
          <button onclick="myFunction()" class="dropbtn"><i class="fa fa-chevron-down"></button></i>
              <div id="myDropdown" class="dropdown-content">
                <a href="Profil.php?pnr=<?php echo $id; ?>"><?php echo _PROFILE; ?></a>
                <?php if ($_SESSION['id'] == 17) {
            ?>    
        
                <a href="Admin.php">AdminFeed</a>
            
            <?php    
            } else {
            ?>
        
                <a href="Feed.php?status=1">Feed</a>
            
            <?php
            }
            ?>
                
                <a href="Innboks.php"><?php echo _INBOX; ?></a>
                <a href="DineArrangementer.php"><?php echo _YOUREVENTS; ?></a>
                <a href="OpprettArrangement.php"><?php echo _CREATEEVENT; ?></a>
                <a href="Kobling/logout.php"><?php echo _LOGOUT; ?></a>
              </div>
        </div>
  </div>
