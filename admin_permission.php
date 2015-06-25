<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$permissionId = $_GET['id'];

//Check if selected permission level exists
if(!permissionIdExists($permissionId)){
	header("Location: admin_permissions.php"); die();	
}

$permissionDetails = fetchPermissionDetails($permissionId); //Fetch information specific to permission level

//Forms posted
if(!empty($_POST)){
	
	//Delete selected permission level
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deletePermission($deletions)){
		$successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
	}
	else
	{
		//Update permission level name
		if($permissionDetails['name'] != $_POST['name']) {
			$permission = trim($_POST['name']);
			
			//Validate new name
			if (permissionNameExists($permission)){
				$errors[] = lang("ACCOUNT_PERMISSIONNAME_IN_USE", array($permission));
			}
			elseif (minMaxRange(1, 50, $permission)){
				$errors[] = lang("ACCOUNT_PERMISSION_CHAR_LIMIT", array(1, 50));	
			}
			else {
				if (updatePermissionName($permissionId, $permission)){
					$successes[] = lang("PERMISSION_NAME_UPDATE", array($permission));
				}
				else {
					$errors[] = lang("SQL_ERROR");
				}
			}
		}
		
		//Remove access to pages
		if(!empty($_POST['removePermission'])){
			$remove = $_POST['removePermission'];
			if ($deletion_count = removePermission($permissionId, $remove)) {
				$successes[] = lang("PERMISSION_REMOVE_USERS", array($deletion_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		//Add access to pages
		if(!empty($_POST['addPermission'])){
			$add = $_POST['addPermission'];
			if ($addition_count = addPermission($permissionId, $add)) {
				$successes[] = lang("PERMISSION_ADD_USERS", array($addition_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		//Remove access to pages
		if(!empty($_POST['removePage'])){
			$remove = $_POST['removePage'];
			if ($deletion_count = removePage($remove, $permissionId)) {
				$successes[] = lang("PERMISSION_REMOVE_PAGES", array($deletion_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		//Add access to pages
		if(!empty($_POST['addPage'])){
			$add = $_POST['addPage'];
			if ($addition_count = addPage($add, $permissionId)) {
				$successes[] = lang("PERMISSION_ADD_PAGES", array($addition_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
			$permissionDetails = fetchPermissionDetails($permissionId);
	}
}

$pagePermissions = fetchPermissionPages($permissionId); //Retrieve list of accessible pages
$permissionUsers = fetchPermissionUsers($permissionId); //Retrieve list of users with membership
$userData = fetchAllUsers(); //Fetch all users
$pageData = fetchAllPages(); //Fetch all pages

require_once("models/header.php");

?>

<body>

    <div id="wrapper">

<?php include("navigation.php");?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">The <img src="img/evarilos.png"/> benchmarking platform</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
		<h3>Permission configuration</h3>
		<div class="panel panel-default">
                   <div class="panel-body">
			<?php echo resultBlock($errors,$successes); ?>
			<form class="form-horizontal" name='adminPermission' action=" <?php $_SERVER['PHP_SELF']?>?id=<?=$permissionId?> " method="post">
                            <fieldset>
				<div class="form-group">
                                    <h4 class="control-label col-sm-2">Permission info</h4>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">ID:</label>
					<div  class="col-sm-10">
					<label class="form-control"><?=$permissionDetails['id']?></label>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Name:</label>
					<div  class="col-sm-10">
						<input class="form-control" type='text' name='name' value="<?=$permissionDetails['name']?>" />
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Delete:</label>
					<div  class="col-sm-10">
						<div class="checkbox"><label>
		                                    	<input type="checkbox" name="delete[<?=$permissionDetails['id']?>]" id="delete[<?=$permissionDetails['id']?>]" value="<?=$permissionDetails['id']?>">Delete this permission
						</label></div>
					</div>
                                </div>

				</br></br></br>
				<div class="form-group">
                                    <h4 class="control-label col-sm-2">Permission membership</h4>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Remove members:</label>
					<div  class="col-sm-10">
				<?php
				//List of permission levels user is apart of
				foreach ($userData as $v1) {
					if(isset($permissionUsers[$v1['id']])){
						echo "<div class=\"checkbox\"><label>";
						echo "<input type='checkbox' name='removePermission[".$v1['id']."]' id='removePermission[".$v1['id']."]' value='".$v1['id']."'> ".$v1['display_name'];
						echo "</label></div>";
					}
				}
				?>

					</div>
                                </div>


				<div class="form-group">
					<label class="control-label col-sm-2">Add members:</label>
					<div  class="col-sm-10">
				<?php
				//List of permission levels user is not apart of
				foreach ($userData as $v1) {
					if(!isset($permissionUsers[$v1['id']])){
						echo "<div class=\"checkbox\"><label>";
						echo "<input type='checkbox' name='addPermission[".$v1['id']."]' id='addPermission[".$v1['id']."]' value='".$v1['id']."'> ".$v1['display_name'];
						echo "</label></div>";
					}
				}
				?>
					</div>
                                </div>



				</br></br></br>
				<div class="form-group">
                                    <h4 class="control-label col-sm-2">Permission Access</h4>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Public Access:</label>
					<div  class="col-sm-10">
				<?php
					//List public pages
					foreach ($pageData as $v1) {
						if($v1['private'] != 1){
							echo "<div class=\"checkbox\"><label>".$v1['page']."</label></div>";
						}
					}
				?>

					</div>
                                </div>


				<div class="form-group">
					<label class="control-label col-sm-2">Remove Access:</label>
					<div  class="col-sm-10">
				<?php
					//List pages accessible to permission level
					foreach ($pageData as $v1) {
						if(isset($pagePermissions[$v1['id']]) AND $v1['private'] == 1){
							echo "<div class=\"checkbox\"><label>";
							echo "<input type='checkbox' name='removePage[".$v1['id']."]' id='removePage[".$v1['id']."]' value='".$v1['id']."'> ".$v1['page'];
							echo "</label></div>";
						}
					}
				?>
					</div>
                                </div>

				<div class="form-group">
					<label class="control-label col-sm-2">Add Access:</label>
					<div  class="col-sm-10">
				<?php
					//List pages inaccessible to permission level
					foreach ($pageData as $v1) {
						if(!isset($pagePermissions[$v1['id']]) AND $v1['private'] == 1){
							echo "<div class=\"checkbox\"><label>";
							echo "<input type='checkbox' name='addPage[".$v1['id']."]' id='addPage[".$v1['id']."]' value='".$v1['id']."'> ".$v1['page'];
							echo "</label></div>";
						}
					}
				?>
					</div>
                                </div>

				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Update</button>
				    </div>
				</div>
			</fieldset>
                        </form>
                    </div>
		</div>

            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php require_once("models/footerscripts.php"); ?>
</body>

</html>
