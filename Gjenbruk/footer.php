<footer class="foot">
    <div class="footer">
        <div class="leftfoot">
            <?php 
                if (isset($_GET['status'])) {
                    $status = "&status=".$_GET['status'];
                } else {
                    $status = "";
                }
                if (isset($_GET['pnr'])) {
                    $pnr = "&pnr=".$_GET['pnr'];
                } else {
                    $pnr = "";
                }
                if (isset($_GET['arrangement'])) {
                    $arrangement = "&arrangement=".$_GET['arrangement'];
                }
                if (isset($_GET['email'])) {
                    $email = "&email=".$_GET['email'];
                } else {
                    $email = "";
                }
            if (isset($_SESSION['lang']) && $_SESSION['lang'] == "eng") {
            ?>
                
                <div class="leftfootbilde"><a href="<?php echo $_SERVER['PHP_SELF'].'?lang=no'.$status.$pnr.$arrangement.$email; ?>"><img src="Bilder/norge.png"></img></div>
                <div class="leftfoottekst"><p>Norsk</p></a></div>
            <?php
            } else { 
            ?>
                <div class="leftfootbilde"><a href="<?php echo $_SERVER['PHP_SELF'].'?lang=eng'.$status.$pnr.$arrangement.$email; ?>"><img src="Bilder/uk.png"></img></div>
                <div class="leftfoottekst"><p>English</p></a></div>
            <?php
            }
            ?>
        </div>
    	<div class="centerfoot">GreenBook © 2020</div>
    	<div class="rightfoot"><a href="Villkår.html"><?php echo _POLICY; ?></a></div>
	</div>
</footer>