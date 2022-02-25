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

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/tasks.js"></script>	
<script>
	function removeBlur( ) {

		var el=document.getElementsByClassName('fade in');
		el=el[1];
		el.style='display:none' 

	}

</script>
<script src="js/general.js"></script>
<style>
td.details-control {
    background: url('images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('images/details_close.png') no-repeat center center;
}
.fade { 
    display:none;
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
				<div class="col-md-2" allign="right">
					<button type="button" id="addTasks" class="btn btn-info removedBlur" title="Dodaj zadatak"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="taskListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Id</th>
					<th>Uloga</th>					
					<th>Zadatak projekta</th>					
					<th>Dostignuce</th>
					<th>Vreme</th>	
					<th>Status</th>										
					<th>Instrukcija</th>									
				</tr>
			</thead>
		</table>
	</div>
	
	
	<div id="hoursModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="hoursForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i>Dodaj zadatak</h4>
    				</div>
    				<div class="modal-body">						
						<div class="form-group">
							<label for="phone" class="control-label">Datum</label>							
							<input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD">			
						</div>
						<div class="form-group">
							<label for="phone" class="control-label">Vreme</label>							
							<input type="text" class="form-control" id="time" name="time" placeholder="Datum...">			
						</div>			
						<div class="form-group">
							<label for="address" class="control-label"></label>							
							<textarea class="form-control" rows="2" id="work" name="work"></textarea>							
						</div>						
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
						<button type="submit" class="btn btn-info" data-dismiss="modal">Sacuvaj</button>
    					<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
	
	
</div>