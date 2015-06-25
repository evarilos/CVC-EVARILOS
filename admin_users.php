<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteUsers($deletions)){
		$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$userData = fetchAllUsers(); //Fetch information for all users

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
			<form name='adminUsers' action=" <?php $_SERVER['PHP_SELF']?> " method="post">
                            <fieldset>
				<table class="table table-hover">
				<thead>
					<tr>
						<th>Delete</th>
						<th>Username</th>
						<th>Display Name</th>
						<th>Title</th>
						<th>Last Sign In</th>
					</tr>
				</thead>
				<tbody>

			<?php 
			//Cycle through users
			foreach ($userData as $v1) {
				echo "
				<tr>
					<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>

					<td><a href='admin_user.php?id=".$v1['id']."'>".$v1['user_name']."</a></td>
					<td>".$v1['display_name']."</td>
					<td>".$v1['title']."</td>

					<td>
					";
	
					//Interprety last login
					if ($v1['last_sign_in_stamp'] == '0'){
						echo "Never";	
					}
					else {
						echo date("l, j F Y (G:i)", $v1['last_sign_in_stamp']);
					}
					echo "
					</td>
				</tr>";
			}
			?>
				</tbody>
			</table></br></br>

			<input type='submit' name='Submit' value='Delete' />
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
