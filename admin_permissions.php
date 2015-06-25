<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	//Delete permission levels
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deletePermission($deletions)){
		$successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
	}
	
	//Create new permission level
	if(!empty($_POST['newPermission'])) {
		$permission = trim($_POST['newPermission']);
		
		//Validate request
		if (permissionNameExists($permission)){
			$errors[] = lang("PERMISSION_NAME_IN_USE", array($permission));
		}
		elseif (minMaxRange(1, 50, $permission)){
			$errors[] = lang("PERMISSION_CHAR_LIMIT", array(1, 50));	
		}
		else{
			if (createPermission($permission)) {
			$successes[] = lang("PERMISSION_CREATION_SUCCESSFUL", array($permission));
		}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
	}
}

$permissionData = fetchAllPermissions(); //Retrieve list of all permission levels

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
		<h3>User configuration</h3>
		<div class="panel panel-default">
                   <div class="panel-body">
			<?php echo resultBlock($errors,$successes); ?>
			<form name='adminPermissions' action=" <?php $_SERVER['PHP_SELF']?> " method="post">
                            <fieldset>
				<table class="table table-hover">
				<thead>
					<tr>
						<th>Delete</th>
						<th>Permission name</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//List each permission level
					foreach ($permissionData as $v1) {
						echo "
						<tr>
						<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
						<td><a href='admin_permission.php?id=".$v1['id']."'>".$v1['name']."</a></td>
						</tr>";
					}
					?>
				</tbody>

				</table></br></br>
				<div class="form-group">
					<label class="control-label col-sm-2">Add permission:</label>
					<div  class="col-sm-10">
                                    		<input class="form-control" placeholder="New Permission" name="newPermission"/>
					</div>
                                </div>
				</br></br></br>
				<input type='submit' name='Submit' value='Submit' />
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
