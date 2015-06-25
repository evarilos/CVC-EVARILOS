<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$captcha = md5($_POST["captcha"]);
	
	
	if ($captcha != $_SESSION['captcha'])
	{
		$errors[] = lang("CAPTCHA_FAIL");
	}
	if(minMaxRange(3,25,$username))
	{
		$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(3,25));
	}
	if(!ctype_alnum($username)){
		$errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
	}
	if(minMaxRange(3,25,$displayname))
	{
		$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(3,25));
	}
	$valid_chars = array('-', '_', ' ', '.'); 
	if( ! ctype_alnum(str_replace($valid_chars, '', $displayname)) ) { 
		$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
	}
	if(minMaxRange(5,50,$password) && minMaxRange(5,50,$confirm_pass))
	{
		$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(5,50));
	}
	else if($password != $confirm_pass)
	{
		$errors[] = lang("ACCOUNT_PASS_MISMATCH");
	}
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}
	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$user = new User($username,$displayname,$password,$email);
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user->AddUserToDB())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		$successes[] = $user->success;
	}
}

require_once("models/header.php");

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">The <SPAN>EVARILOS</SPAN> benchmarking platform</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php include("left-nav.php"); ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">The <img src="img/evarilos.png"/> benchmarking platform</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
		<h3>New user? Fill in this form!</h3>
		<div class="panel panel-default">
                   <div class="panel-body">
			<?php echo resultBlock($errors,$successes); ?>
			<form class="form-horizontal" name='updateAccount' action=" <?php $_SERVER['PHP_SELF']?> " method="post">
                            <fieldset>
                                <div class="form-group">
					<label class="control-label col-sm-2">Username:</label>
					<div  class="col-sm-10">
                                    	<input class="form-control" placeholder="Username" name="username"/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Display name:</label>
					<div  class="col-sm-10">
                                    	<input class="form-control" placeholder="Display name" name="displayname"/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Email:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Email" name="email"/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Password:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Confirm password:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Password" name="passwordc" type="password">
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Security Code:</label>
					<div  class="col-sm-10">
                                    <input class="form-control" placeholder="Security code" name="captcha"/>
					</div>
                                </div>
                                <div class="form-group">
					<label class="control-label col-sm-2">Enter Security Code:</label>
					<div  class="col-sm-10">
                                    <img src='models/captcha.php'>
					</div>
                                </div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Register</button>
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

<?php require_once("models/footerscripts.php"); ?>

</body>

</html>
