<?php 
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($user->loggedIn()) {
	if($_SESSION["role"] == 'Menadzer') {
		header("Location: clients.php");
	} else if($_SESSION["role"] == 'Zaposleni') {
		header("Location: tasks.php");
	} else if($_SESSION["role"] == 'Administrator') {
		header("Location: Admin.php");		//session problem
	}
}

$loginMessage = '';
if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {	
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];	
	if($user->login()) {
		if($_SESSION["role"] == 'Menadzer') {
			header("Location: clients.php");
		} else if($_SESSION["role"] == 'Zaposleni') {
			header("Location: tasks.php");
		} else if($_SESSION["role"] == 'Administrator') { 
			header("Location: admin.php");
		}

	} else {
		$loginMessage = 'Unesi ste pogresno e-mail ili lozinku. Molimo vas pokusajte ponovo.';
	}
} else {
	$loginMessage = 'Popunite sva polja.';
}
include('inc/header.php');
?>
<div class="container-fluid">
<?php include('inc/container.php');?>
<title>Aplikacija za upravljanje projektima</title>
<div class="content" style="background-image: url(https://www.pngmagic.com/product_images/website-background-image-size-psd-vector-photo.jpg); background-size: cover; "> 
	<div class="container-fluid">
		<h2 id = "naslov" style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white">Aplikacija za upravljanje projektima</h2>			
        <div class="col-md-6">                    
		<div>
			<div class="panel-heading" style="background:#23F5CC;color:black;">
				<div class="panel-title" style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Ulogovanje</div>                        
			</div> 
			<div style="padding: top 30px" class="panel-body" >
				<?php if ($loginMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="border" role="form" method="POST" action="">   
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> <!-- pomocu bootstrap-a ubacen je logo za korisnicko ime -->
						<input type="text" class="form-control" id="email" name="email" value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" 
						placeholder="Unesite e-mail" style="background:white; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" required>                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> <!-- pomocu bootstrap-a ubacen je logo za lozinku -->
						<input type="password" class="form-control" id="password" name="password" value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>"
						placeholder="Lozinka" style="background:white; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" required>
					</div>
					<div style="margin-top: 10px">
					    <a href="registration.php" style="color: white;">Niste prijavljeni? Napravite nalog ovde!</a>
				    </div>	                                				
					<div style="margin-top: 10px" class="form-group">                               
						<div class="col-sm-12 controls">
						  <input type="submit" name="login" value="Potvrdi" style="font-family:'Segoe UI margin-top: 25px', Tahoma, Geneva, Verdana, sans-serif" 
						  class="btn btn-primary btn-lg">						  
						</div>						
					</div>				
				</form>   
			</div>                     
		</div>  
	</div> 
	   
</div>	
<?php include('inc/footer.php');?>   
</div>

