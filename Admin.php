<?php 
session_start(); 
if ($_SESSION['id'] == 17) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<title>Feed</title>
	<script src = "script.js">
	</script>
	<link rel="stylesheet" type="text/css" href="Stylesheets/Super.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Arrangement.css">
  <link rel="stylesheet" type="text/css" href="Stylesheets/Feed.css">
</head>
<body>

	<div class="grid-container">
		<?php
		require "Gjenbruk/head.php";
		?>
        <div class="left">
				
        </div>
		<div class="main">

            <?php 
            require "Logger/Logger.php";
            $log = new Logger("Logger/Logg.txt");
            echo $log->getLog();
            ?>
            
		
		</div>
        <div class="right">

        </div>
		<?php require "Gjenbruk/footer.php"; ?>
	</div>
</body>
</html>
<?php 
} 
?>
