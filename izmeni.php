<?php
require_once 'config/Database.php';
require_once 'class/User.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

include('inc/header.php');
?>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />

<script src="js/tasks.js"></script>	
<script src="js/general.js"></script>
<script src="js/helper.js"></script>

<style>
td.details-control {
    background: url('images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('images/details_close.png') no-repeat center center;
}
</style>


<style>
td.details-control {
    background: url('images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('images/details_close.png') no-repeat center center;
}
</style>
<?php include('inc/container.php');?>
<div class="container">  
	<?php include('top_menus.php'); ?>
	
	<div> 	
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
                </div>




<?php 
$id=$_GET['id'];
 $sql="SELECT * FROM $user->userTable WHERE id='$id' ";
 $stmt = $user->conn->prepare($sql);
 $stmt->execute();
 $result = $stmt->get_result();
 $res=$result->fetch_assoc();


?>
<body>
    <div style='margin:10%;'>
    <form action="" method="post">
        <div style='margin:5% 35%;'>
    <input type="email" name="email" id="" value="<?php  echo $res['email']?>">
    <small>E-mail</small>
    </div>
    <div style='margin:5% 35%;'>
    <input type="text" name="ime" id="" value=" <?php  echo $res['first_name']?>">
    <small>Ime</small>
    </div>
    <div style='margin:5% 35%;'>
    <input type="text" name="prezime" id="" value=" <?php  echo $res['last_name']?>">      
    <small>Prezime</small>  
    </div>
    <input type="submit" style='margin:5% 35%;' name='primeni'>
</div>
</form>

<?php
if(isset($_POST['primeni']))
{
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $email=$_POST['email'];
    $id=$_GET['id'];
    $sql="UPDATE $user->userTable SET email='$email',first_name='$ime',last_name='$prezime' WHERE id='$id'";
    $stmt = $user->conn->prepare($sql);
    $stmt->execute();
}
?>
                
                </div>
		</div>
</html>