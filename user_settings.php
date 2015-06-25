<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

if(!empty($_POST))
{
	$errors = array();
	$successes = array();
	$password = $_POST["password"];
	$password_new = $_POST["passwordc"];
	$password_confirm = $_POST["passwordcheck"];
	
	$errors = array();
	$email = $_POST["email"];
	
	//Perform some validation
	//Feel free to edit / change as required
	
	//Confirm the hashes match before updating a users password
	$entered_pass = generateHash($password,$loggedInUser->hash_pw);
	
	if (trim($password) == ""){
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}
	else if($entered_pass != $loggedInUser->hash_pw)
	{
		//No match
		$errors[] = lang("ACCOUNT_PASSWORD_INVALID");
	}	
	if($email != $loggedInUser->email)
	{
		if(trim($email) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_EMAIL");
		}
		else if(!isValidEmail($email))
		{
			$errors[] = lang("ACCOUNT_INVALID_EMAIL");
		}
		else if(emailExists($email))
		{
			$errors[] = lang("ACCOUNT_EMAIL_IN_USE", array($email));	
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			$loggedInUser->updateEmail($email);
			$successes[] = lang("ACCOUNT_EMAIL_UPDATED");
		}
	}
	
	if ($password_new != "" OR $password_confirm != "")
	{
		if(trim($password_new) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_NEW_PASSWORD");
		}
		else if(trim($password_confirm) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_CONFIRM_PASSWORD");
		}
		else if(minMaxRange(8,50,$password_new))
		{	
			$errors[] = lang("ACCOUNT_NEW_PASSWORD_LENGTH",array(8,50));
		}
		else if($password_new != $password_confirm)
		{
			$errors[] = lang("ACCOUNT_PASS_MISMATCH");
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			//Also prevent updating if someone attempts to update with the same password
			$entered_pass_new = generateHash($password_new,$loggedInUser->hash_pw);
			
			if($entered_pass_new == $loggedInUser->hash_pw)
			{
				//Don't update, this fool is trying to update with the same password Â¬Â¬
				$errors[] = lang("ACCOUNT_PASSWORD_NOTHING_TO_UPDATE");
			}
			else
			{
				//This function will create the new hash and update the hash_pw property.
				$loggedInUser->updatePassword($password_new);
				$successes[] = lang("ACCOUNT_PASSWORD_UPDATED");
			}
		}
	}
	if(count($errors) == 0 AND count($successes) == 0){
		$errors[] = lang("NOTHING_TO_UPDATE");
	}
}

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
		<div class="panel panel-default">
                   <div class="panel-body">
			<?php echo resultBlock($errors,$successes); ?>
			<form class="form-horizontal" name='updateAccount' action=" <?php $_SERVER['PHP_SELF']?> " method="post">
                            <fieldset>
                                <div class="form-group">
					<label class="control-label col-sm-2">Old password:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value=""/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Display name:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Display name" name="displayname"
							value="<?php print $loggedInUser->displayname; ?>"/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Email:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Email" name="email"
							value="<?php print $loggedInUser->email; ?>"/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">New password:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Password" name="passwordc" type="password" value="">
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Confirm password:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Password" name="passwordcheck" type="password" value="">
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
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
