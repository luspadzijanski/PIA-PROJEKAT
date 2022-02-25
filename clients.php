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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/client.js"></script>		
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
<link href="css/style.css" rel="stylesheet" type="text/css" >  
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
					<button type="button" id="addClient" class="btn btn-info" title="Add Client"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="clientListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Ime</th>					
					<th>Websajt</th>					
					<th>Industija</th>
					<th>Kontakt</th>										
					<th></th>
					<th></th>	
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="clientModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="clientForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i>Uredi projekat</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label for="name" class="control-label">Ime</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="ime" required>			
						</div>
						<div class="form-group">
							<label for="website" class="control-label">Websajt</label>							
							<input type="text" class="form-control" id="website" name="website" placeholder="websajt">							
						</div>	   	
						<div class="form-group">
							<label for="industry" class="control-label">Industija</label>							
							<input type="text" class="form-control"  id="industry" name="industry" placeholder="industrija" required>							
						</div>	
						<div class="form-group">
							<label for="description" class="control-label">Opis</label>							
							<textarea class="form-control" rows="2" id="description" name="description"></textarea>							
						</div>	
						<div class="form-group">
							<label for="phone" class="control-label">Telefon</label>							
							<input type="text" class="form-control" id="phone" name="phone" placeholder="telefon">			
						</div>			
						<div class="form-group">
							<label for="address" class="control-label">Adresa</label>							
							<textarea class="form-control" rows="2" id="address" name="address"></textarea>							
						</div>
						<div class="form-group">
							<label for="country" class="control-label">Drzava</label>							
							<input type="text" class="form-control" id="country" name="country" placeholder="drzava">							
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
	
	<div id="clientDetails" class="modal fade">
    	<div class="modal-dialog">    		
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i>Uredi projekat</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="control-label">Ime</label>
						<span id="cname"></span>	
					</div>
					<div class="form-group">
						<label for="website" class="control-label">Vebsajt</label>				
						<span id="cwebsite"></span>							
					</div>	   	
					<div class="form-group">
						<label for="industry" class="control-label">Industrija</label>							
						<span id="cindustry"></span>								
					</div>	
					<div class="form-group">
						<label for="description" class="control-label">Opis</label>							
						<span id="cdescription"></span>								
					</div>	
					<div class="form-group">
						<label for="phone" class="control-label">Kontakt</label>							
						<span id="cphone"></span>					
					</div>			
					<div class="form-group">
						<label for="address" class="control-label">Adresa</label>							
						<span id="caddress"></span>							
					</div>
					<div class="form-group">
						<label for="country" class="control-label">Drzava</label>							
						<span id="ccountry"></span>								
					</div>
				</div>    				
			</div>    		
    	</div>
    </div>
	
</div>

