<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'class/Clients.php';
include_once 'class/Project.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$client = new Clients($db);

$project = new Project($db);


if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('inc/header.php');
?>
<title>Aplikacija za upravljanje projektima</title>
<link href="css/style.css" rel="stylesheet" type="text/css" >  
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/projects.js"></script>	
<script>
	function removeBlur( ) {

    var el=document.getElementsByClassName('fade in');
    el=el[1];
    el.style='display:none' 

    }
</script>
<script src="js/general.js"></script>
<style>
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
				<div class="col-md-2" align="right">
					<button type="button" id="addProject" class="btn btn-info" title="Add project"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="projectListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Redni br</th>
					<th>Ime projekta</th>					
					<th>Uloga projekta</th>					
					<th>Status</th>
					<th>Menadzer projekta</th>										
					<th>Po satu</th>
					<th>Budzet</th>	
					<th></th>	
					<th></th>	
					<th></th>						
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="projectModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="projetForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Record</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group"
							<label for="project" class="control-label">Ime projekta</label>
							<input type="text" class="form-control" id="project" name="project" placeholder="projekat" required>			
						</div>
						<div class="form-group">
							<label for="website" class="control-label">Klijent</label>
							<select class="form-control" id="client" name="client">
							<?php 
							$result = $client->list();
							while ($clients = $result->fetch_assoc()) { 	
							?>
								<option value="<?php echo $clients['id']; ?>"><?php echo $clients['name']; ?></option>							
							<?php } ?>
							</select>							
						</div>	   	
						<div class="form-group">
							<label for="industry" class="control-label">Menadzer projekta</label>							
							<select class="form-control" id="project_manager" name="project_manager"/>
							<?php 
							$result = $project->managerList();
							while ($manager = $result->fetch_assoc()) { 	
							?>
								<option value="<?php echo $manager['id']; ?>"><?php echo ucfirst($manager['first_name'])." ".ucfirst($manager['last_name']); ?></option>							
							<?php } ?>
							</select>								
						</div>	
						<div class="form-group">
							<label for="description" class="control-label">Status projekta</label>							
							<select class="form-control" id="active" name="active"/>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>	
						<div class="form-group">
							<label for="phone" class="control-label">Hourly Rate</label>							
							<input type="text" class="form-control" id="hourly_rate" name="hourly_rate" placeholder="hourly rate">			
						</div>			
						<div class="form-group">
							<label for="address" class="control-label">Budget</label>							
							<textarea class="form-control" rows="2" id="budget" name="budget"></textarea>							
						</div>
						<div class="form-group">
							<label for="country" class="control-label">Status</label>							
							<select class="form-control" id="project_status" name="project_status"/>
							<?php 
							$result = $project->statusList();
							while ($status = $result->fetch_assoc()) { 	
							?>
								<option value="<?php echo $status['id']; ?>"><?php echo $status['status']; ?></option>							
							<?php } ?>
							</select>							
						</div>
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
						<button type="submit" class="btn btn-info" data-dismiss="modal">Sacuvaj</button>
    					<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>

	<div id="projectDetails" class="modal fade">
    	<div class="modal-dialog">    		
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Project Details</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="control-label">Id:</label>
						<span id="project_id"></span>	
					</div>
					<div class="form-group">
						<label for="name" class="control-label">Uloga projekta:</label>
						<span id="dproject"></span>	
					</div>
					<div class="form-group">
						<label for="website" class="control-label">Projekat:</label>				
						<span id="dclient"></span>							
					</div>	   	
					<div class="form-group">
						<label for="industry" class="control-label">Projekti menadzer:</label>							
						<span id="dmanager"></span>								
					</div>	
					<div class="form-group">
						<label for="description" class="control-label">Status:</label>							
						<span id="dactive"></span>								
					</div>	
					<div class="form-group">
						<label for="phone" class="control-label">Po satu:</label>							
						<span id="dhourly_rate"></span>					
					</div>			
					<div class="form-group">
						<label for="address" class="control-label">Budget:</label>							
						<span id="dbudget"></span>							
					</div>
					<div class="form-group">
						<label for="address" class="control-label">Status projekta:</label>							
						<span id="dstatus"></span>							
					</div>					
				</div>    				
			</div>    		
    	</div>
    </div>
	
</div>

