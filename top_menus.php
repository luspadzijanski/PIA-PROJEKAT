<h3>
	<?php if($_SESSION["userid"]) { echo $_SESSION["name"]; } ?> | <a href="logout.php" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Izlogujte se</a>
</h3>
<br>
<ul class="nav nav-tabs">
	
	<?php if($_SESSION["role"] == 'Menadzer') { ?>
		<li id="clients" class="active"><a href="clients.php">Klijenti</a></li>
		<li id="projects"><a href="projects.php">Projekti</a></li> 
	<?php } ?>
	
	<?php if($_SESSION["role"] == 'Zaposleni') { ?>
		<li class="active"><a href="tasks.php">Zadaci</a></li>		
	<?php } ?>

</ul>