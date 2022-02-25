<?php
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php"); 
}
include('inc/header.php');
?>
<title>Aplikacija za upravljanje projektima</title>
<link href="css/style.css" rel="stylesheet" type="text/css" >  
<?php include('inc/container.php');?>
<div class="container">  
	<h3><?php if($_SESSION["userid"]) { echo $_SESSION["name"]; } ?> | <a href="logout.php">Izlogujte se</a> </h3><br>
	<ul class="nav nav-tabs">
	    <?php if($_SESSION["role"] == 'Administrator') { ?> 
			<li class="active"><a href="admin.php">Administrator</a></li>
		<?php } ?>

		<?php if($_SESSION["role"] == 'Menadzer') { ?>
			<li class="active"><a href="clients.php">Klijenti</a></li>
			<li><a href="projects.php">Projekti</a></li> 
		<?php } ?>
		
		<?php if($_SESSION["role"] == 'Zaposleni') { ?>
			<li class="active"><a href="tasks.php">Tasks</a></li>		
		<?php } ?>
	
	</ul>
</div>
 <?php include('inc/footer.php');?>
