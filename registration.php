<?php 
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($user->signedIn()) {
	if($_SESSION["role"] == 'Menadzer') {
		header("Location: clients.php");
	} else if($_SESSION["role"] == 'Zaposleni') {
		header("Location: tasks.php");
	}
	else if($_SESSION["role"] == 'Administrator') {
		header("Location: admin.php");

		//echo "<script>window.location('admin.php')"
	} //administrator
}

$signinMessage = '';
if(!empty($_POST["login"]) && !empty($_POST["first_name"]) && !empty($_POST["last_name"])
&& !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["role"])) {
	$user->first_name = $_POST["first_name"];
	$user->last_name = $_POST["last_name"];	
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];	
	$user->role = $_POST["role"];
	if($user->register()) {
		if($_SESSION["role"] == 'Menadzer') {
			header("Location: clients.php");
		} else if($_SESSION["role"] == 'Zaposleni') {
			header("Location: tasks.php");
		}
	} 
} else {
	$signinMessage = 'Popunite sva polja.';
}
include('inc/header.php');
?>
<div class="container-fluid">
<?php include('inc/container.php');?>
<title>Aplikacija za upravljanje projektima</title>
<div class="content" style="background-image: url(https://www.pngmagic.com/product_images/website-background-image-size-psd-vector-photo.jpg); background-size: cover; "> 
	<div class="container-fluid">
		<h2 id = "naslov" style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white">Kreiranje naloga</h2>			
        <div class="col-md-6">                    
		<div>
			<div style="padding: top 30px" class="panel-body" >
				<?php if ($signinMessage != '') { ?>
					<div id="signin-alert" class="alert alert-danger col-sm-12"><?php echo $signinMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="border" role="form" method="POST" action="">   
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> <!-- pomocu bootstrap-a ubacen je logo za korisnicko ime -->
						<input type="text" class="form-control" id="first_name" name="first_name" value="<?php if(!empty($_POST["first_name"])) { echo $_POST["first_name"]; } ?>" 
						placeholder="Ime" style="background:white; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" required>                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> <!-- pomocu bootstrap-a ubacen je logo za lozinku -->
						<input type="text" class="form-control" id="last_name" name="last_name" value="<?php if(!empty($_POST["last_name"])) { echo $_POST["last_name"]; } ?>"
						placeholder="Prezime" style="background:white; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> <!-- pomocu bootstrap-a ubacen je logo za lozinku -->
						<input type="text" class="form-control" id="email" name="email" value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>"
						placeholder="E-mail" style="background:white; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> <!-- pomocu bootstrap-a ubacen je logo za lozinku -->
						<input type="password" class="form-control" id="password" name="password" value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>"
						placeholder="Sifra" style="background:white; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" required>
					</div>
					<select id="role" name="role"  class="inputtabela">
					    <option value="Administrator">Administrator</option>
					    <option value="Menadzer">Menadzer</option>
                        <option value="Zaposleni" selected="selected">Zaposleni</option>
                    </select>
					<div style="margin-top: 10px">
					    <a href="index.php" style="color: white;">Niste prijavljeni? Napravite nalog ovde!</a>
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