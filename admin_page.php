<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$pageId = $_GET['id'];

//Check if selected pages exist
if(!pageIdExists($pageId)){
	header("Location: admin_pages.php"); die();	
}

$pageDetails = fetchPageDetails($pageId); //Fetch information specific to page

//Forms posted
if(!empty($_POST)){
	$update = 0;
	
	if(!empty($_POST['private'])){ $private = $_POST['private']; }
	
	//Toggle private page setting
	if (isset($private) AND $private == 'Yes'){
		if ($pageDetails['private'] == 0){
			if (updatePrivate($pageId, 1)){
				$successes[] = lang("PAGE_PRIVATE_TOGGLED", array("private"));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
	}
	elseif ($pageDetails['private'] == 1){
		if (updatePrivate($pageId, 0)){
			$successes[] = lang("PAGE_PRIVATE_TOGGLED", array("public"));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
	}
	
	//Remove permission level(s) access to page
	if(!empty($_POST['removePermission'])){
		$remove = $_POST['removePermission'];
		if ($deletion_count = removePage($pageId, $remove)){
			$successes[] = lang("PAGE_ACCESS_REMOVED", array($deletion_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
		
	}
	
	//Add permission level(s) access to page
	if(!empty($_POST['addPermission'])){
		$add = $_POST['addPermission'];
		if ($addition_count = addPage($pageId, $add)){
			$successes[] = lang("PAGE_ACCESS_ADDED", array($addition_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");	
		}
	}
	
	$pageDetails = fetchPageDetails($pageId);
}

$pagePermissions = fetchPagePermissions($pageId);
$permissionData = fetchAllPermissions();

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
			<form class="form-horizontal" name='adminPage' action=" <?php $_SERVER['PHP_SELF']?>?id=<?=$pageId?> " method="post">
                            <fieldset>
				<div class="form-group">
                                    <h4 class="control-label col-sm-2">Page info</h4>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">ID:</label>
					<div  class="col-sm-10">
					<label class="form-control"><?=$pageDetails['id']?></label>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Name:</label>
					<div  class="col-sm-10">
						<input class="form-control" type='text' name='name' value="<?=$pageDetails['page']?>" />
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Private:</label>
					<div  class="col-sm-10">
						<div class="checkbox"><label>
							<?php
							//Display private checkbox
							if ($pageDetails['private'] == 1){
								echo "<input type='checkbox' name='private' id='private' value='Yes' checked>";
							}
							else {
								echo "<input type='checkbox' name='private' id='private' value='Yes'>";	
							}
							?>
						</label></div>
					</div>
                                </div>

				</br></br></br>
				<div class="form-group">
                                    <h4 class="control-label col-sm-2">Page Access</h4>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Remove access:</label>
					<div  class="col-sm-10">
				<?php
					//Display list of permission levels with access
					foreach ($permissionData as $v1) {
						if(isset($pagePermissions[$v1['id']])){
							echo "<div class=\"checkbox\"><label>";
							echo "<input type='checkbox' name='removePermission[".$v1['id']."]' id='removePermission[".$v1['id']."]' value='".$v1['id']."'> ".$v1['name'];
							echo "</label></div>";
						}
					}
				?>

					</div>
                                </div>


				<div class="form-group">
					<label class="control-label col-sm-2">Add access:</label>
					<div  class="col-sm-10">
				<?php
					//Display list of permission levels without access
					foreach ($permissionData as $v1) {
						if(!isset($pagePermissions[$v1['id']])){
							echo "<div class=\"checkbox\"><label>";
							echo "<input type='checkbox' name='addPermission[".$v1['id']."]' id='addPermission[".$v1['id']."]' value='".$v1['id']."'> ".$v1['name'];
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
