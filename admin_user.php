<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];

//Check if selected user exists
if(!userIdExists($userId)){
	header("Location: admin_users.php"); die();
}

$userdetails = fetchUserDetails(NULL, NULL, $userId); //Fetch user details

//Forms posted
if(!empty($_POST))
{	
	//Delete selected account
	if(!empty($_POST['delete'])){
		$deletions = $_POST['delete'];
		if ($deletion_count = deleteUsers($deletions)) {
			$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
		}
		else {
			$errors[] = lang("SQL_ERROR");
		}
	}
	else
	{
		//Update display name
		if ($userdetails['display_name'] != $_POST['display']){
			$displayname = trim($_POST['display']);
			
			//Validate display name
			if(displayNameExists($displayname))
			{
				$errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			}
			elseif(minMaxRange(5,25,$displayname))
			{
				$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
			}
			elseif(!ctype_alnum($displayname)){
				$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
			}
			else {
				if (updateDisplayName($userId, $displayname)){
					$successes[] = lang("ACCOUNT_DISPLAYNAME_UPDATED", array($displayname));
				}
				else {
					$errors[] = lang("SQL_ERROR");
				}
			}
			
		}
		else {
			$displayname = $userdetails['display_name'];
		}
		
		//Activate account
		if(isset($_POST['activate']) && $_POST['activate'] == "activate"){
			if (setUserActive($userdetails['activation_token'])){
				$successes[] = lang("ACCOUNT_MANUALLY_ACTIVATED", array($displayname));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		//Update email
		if ($userdetails['email'] != $_POST['email']){
			$email = trim($_POST["email"]);
			
			//Validate email
			if(!isValidEmail($email))
			{
				$errors[] = lang("ACCOUNT_INVALID_EMAIL");
			}
			elseif(emailExists($email))
			{
				$errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));
			}
			else {
				if (updateEmail($userId, $email)){
					$successes[] = lang("ACCOUNT_EMAIL_UPDATED");
				}
				else {
					$errors[] = lang("SQL_ERROR");
				}
			}
		}
		
		//Update title
		if ($userdetails['title'] != $_POST['title']){
			$title = trim($_POST['title']);
			
			//Validate title
			if(minMaxRange(1,50,$title))
			{
				$errors[] = lang("ACCOUNT_TITLE_CHAR_LIMIT",array(1,50));
			}
			else {
				if (updateTitle($userId, $title)){
					$successes[] = lang("ACCOUNT_TITLE_UPDATED", array ($displayname, $title));
				}
				else {
					$errors[] = lang("SQL_ERROR");
				}
			}
		}
		
		//Remove permission level
		if(!empty($_POST['removePermission'])){
			$remove = $_POST['removePermission'];
			if ($deletion_count = removePermission($remove, $userId)){
				$successes[] = lang("ACCOUNT_PERMISSION_REMOVED", array ($deletion_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		if(!empty($_POST['addPermission'])){
			$add = $_POST['addPermission'];
			if ($addition_count = addPermission($add, $userId)){
				$successes[] = lang("ACCOUNT_PERMISSION_ADDED", array ($addition_count));
			}
			else {
				$errors[] = lang("SQL_ERROR");
			}
		}
		
		$userdetails = fetchUserDetails(NULL, NULL, $userId);
	}
}

$userPermission = fetchUserPermissions($userId);
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
		<h3>User configuration</h3>
		<div class="panel panel-default">
                   <div class="panel-body">
			<?php echo resultBlock($errors,$successes); ?>
			<form class="form-horizontal" name='adminUser' action=" <?php $_SERVER['PHP_SELF']?>?id=<?=$userId?> " method="post">
                            <fieldset>
				<div class="form-group">
                                    <h4 class="control-label col-sm-2">General info</h4>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">ID:</label>
					<div  class="col-sm-10">
					<label class="form-control"><?=$userdetails['id']?></label>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Username:</label>
					<div  class="col-sm-10">
                                    	<label class="form-control"><?=$userdetails['user_name']?></label>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Display name:</label>
					<div  class="col-sm-10">
                                    	<input class="form-control" type="text" name='display' value="<?=$userdetails['display_name']?>" />
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Email:</label>
					<div  class="col-sm-10">
                                    	<input class="form-control" type="text" name="email"  value="<?=$userdetails['email']?>" />
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Active:</label>
					<div  class="col-sm-10">
				<?php
				//Display activation link, if account inactive
				if ($userdetails['active'] == '1'){
					echo "<label class=\"form-control\">Yes</label>";
					echo "</div></div>";
				}
				else{
					echo "<label class=\"form-control\">No</label>";
					echo "</div></div>";
					
					echo "<div class=\"form-group\">
					<label class=\"control-label col-sm-2\">Activate:</label>
					<div  class=\"col-sm-10\">
                                    	<input type='checkbox' name='activate' id='activate' value='activate'>
					</div";
				}
				?>

                                <div class="form-group">
					<label class="control-label col-sm-2">Title:</label>
					<div  class="col-sm-10">
                                    	<input class="form-control" type='text' name='title' value="<?=$userdetails['title']?>"/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Sign up:</label>
					<div  class="col-sm-10">
                                    	<label class="form-control"><?=date("l, j F Y (G:i)", $userdetails['sign_up_stamp'])?></label>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Last sign in:</label>
					<div  class="col-sm-10">
                                    	<label class="form-control"><?=date("l, j F Y (G:i)", $userdetails['last_sign_in_stamp'])?></label>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Delete:</label>
					<div  class="col-sm-10">
						<div class="checkbox"><label>
		                                    	<input type="checkbox" name="delete[<?=$userdetails['id']?>]" id="delete[<?=$userdetails['id']?>]" value="<?=$userdetails['id']?>">Delete this user
						</label></div>
					</div>
                                </div>

				</br></br></br>
				<div class="form-group">
                                    <h4 class="control-label col-sm-2">Permission membership</h4>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Remove permission:</label>
					<div  class="col-sm-10">
				<?php
				//List of permission levels user is apart of
				foreach ($permissionData as $v1) {
					if(isset($userPermission[$v1['id']])){
						echo "<div class=\"checkbox\"><label>";
						echo "<input type='checkbox' name='removePermission[".$v1['id']."]' id='removePermission[".$v1['id']."]' value='".$v1['id']."'> ".$v1['name'];
						echo "</label></div>";
					}
				}
				?>

					</div>
                                </div>


				<div class="form-group">
					<label class="control-label col-sm-2">Add permission:</label>
					<div  class="col-sm-10">
				<?php
				//List of permission levels user is not apart of
				foreach ($permissionData as $v1) {
					if(!isset($userPermission[$v1['id']])){
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
