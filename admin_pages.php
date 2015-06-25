<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$pages = getPageFiles(); //Retrieve list of pages in root usercake folder
$dbpages = fetchAllPages(); //Retrieve list of pages in pages table
$creations = array();
$deletions = array();

//Check if any pages exist which are not in DB
foreach ($pages as $page){
	if(!isset($dbpages[$page])){
		$creations[] = $page;	
	}
}

//Enter new pages in DB if found
if (count($creations) > 0) {
	createPages($creations)	;
}

if (count($dbpages) > 0){
	//Check if DB contains pages that don't exist
	foreach ($dbpages as $page){
		if(!isset($pages[$page['page']])){
			$deletions[] = $page['id'];	
		}
	}
}

//Delete pages from DB if not found
if (count($deletions) > 0) {
	deletePages($deletions);
}

//Update DB pages
$dbpages = fetchAllPages();

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
		<h3>Pages configuration</h3>
		<div class="panel panel-default">
                   <div class="panel-body">
			<?php echo resultBlock($errors,$successes); ?>
			<form name='adminPermissions' action=" <?php $_SERVER['PHP_SELF']?> " method="post">
                            <fieldset>
				<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Page</th>
						<th>Access</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//Display list of pages
					foreach ($dbpages as $page){
						echo "
						<tr>
						<td>
							".$page['id']."
						</td>
						<td>
							<a href ='admin_page.php?id=".$page['id']."'>".$page['page']."</a>
						</td>
						<td>";
	
						//Show public/private setting of page
						if($page['private'] == 0){
							echo "Public";
						}
						else {
							echo "Private";	
						}
	
						echo "
						</td>
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
