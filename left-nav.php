<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) {
	echo "
		<li><a href=\"account.php\"><i class=\"fa fa-dashboard fa-fw\"></i> More information</a></li>

		<li><a href=\"download.php\"><i class=\"fa fa-download fa-fw\"></i> Download &amp; Upload</a></li>
		<li><a href=\"collect.php\"><i class=\"fa fa-wrench fa-fw\"></i> Collect new data</a></li>
		<li><a href=\"benchmark.php\"><i class=\"fa fa-eye fa-fw\"></i> Benchmark your SUT</a></li>
		<li><a href=\"visualize.php\"><i class=\"fa fa-bar-chart fa-fw\"></i> Visualize results</a></li>
		<li><a href=\"compare.php\"><i class=\"fa fa-trophy fa-fw\"></i> Compare &amp; Rank</a></li>
";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
		</br></br>
		<li class=\"divider\"></li>
		<li><a href=\"admin_configuration.php\"><i class=\"fa fa-sliders fa-fw\"></i> Admin Configuration</a></li>
		<li><a href=\"admin_users.php\"><i class=\"fa fa-users fa-fw\"></i> Admin Users</a></li>
		<li><a href=\"admin_permissions.php\"><i class=\"fa fa-unlock fa-fw\"></i> Admin Permissions</a></li>
		<li><a href=\"admin_pages.php\"><i class=\"fa fa-database fa-fw\"></i> Admin Pages</a></li>";
	}
	
	echo "
				</div><!--/.nav-collapse -->
			</div>
		</div>
	";
} 
//Links for users not logged in
else {
	echo "
		<li><a href=\"index.php\"><i class=\"fa fa-dashboard fa-fw\"></i> Home</a></li>
		<li><a href=\"login.php\"><i class=\"fa fa-sign-in fa-fw\"></i> Login</a></li>
		<li><a href=\"register.php\"><i class=\"fa fa-pencil fa-fw\"></i> Register</a></li>
		<li><a href=\"forgot-password.php\"><i class=\"fa fa-question fa-fw\"></i> Forgot password</a></li>
	";
}

?>
