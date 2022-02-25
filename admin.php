<?php
require_once 'config/Database.php';
require_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('inc/header.php');
?>
<title>Aplikacija za upravljanje projektima</title>
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
		</div>
		<table id="" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Ime</th>
					<th>Prezime</th>								
					<th>E-mail</th>									
					<th>Instrukcije</th>									
				</tr>
			</thead>
            <?php 
            $sqlQuery = "SELECT * FROM $user->userTable WHERE role!='Administrator'";

            $stmt = $user->conn->prepare($sqlQuery);
            $stmt->execute();
			$result = $stmt->get_result();
            while($row=$result->fetch_assoc()){
                echo "
                <td>    ".$row['first_name']." </td>
                <td>    ". $row['last_name']." </td>
                <td>    ".$row['email']." </td>


     <td><input type='button' class='btn btn-warning' id='".$row['id']."' value='brisi' onclick='brisi(this.id)'></td>
     <td><input type='button' class='btn btn-warning' id='".$row['id']."' value='izmeni' onclick='izmeni(this.id)'></td>
	 </tr>";
            }



        if(isset($_POST['obrisielement'])){
            $idd=mysqli_real_escape_string($user->conn,$_POST['obrisielement']);
            $sqlQuery="DELETE FROM $user->userTable WHERE id=$idd";
            $stmt = $user->conn->prepare($sqlQuery);
            $stmt->execute();
            echo "<script> window.location('admin.php')</script>";
        }

            ?>
		</table>
	</div>
	
	

	
</div>

