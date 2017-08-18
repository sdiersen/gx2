<?php

	require_once('../../../private/initialize.php');

	//require_login();

	$options = [];
	$options['sort'] = "ORDER BY class_types.name ASC, classes.name ASC";
	if(is_post_request()) {
		if(isset($_POST['sortType'])) {
			if ($_POST['sortType'] == 'Name') {
				$options['sort'] = "ORDER BY classes.name ASC";
			} elseif ($_POST['sortType'] == 'ID') {
				$options['sort'] = "ORDER BY classes.id ASC";
			}
		}
	}

	$class_set = classes_index($options);

	$page_title = 'GX Classes - Index';

	function showRow($row){
		echo "<tr>";
		echo "<td>" . h($row['class_id']) . "</td>";
		echo "<td>" . h($row['class_name']) . "</td>";
		echo "<td>" . h($row['type_name']) . "</td>";
		echo "<td>" . h($row['description']) . "</td>";
		echo "<td><a class=\"action\" href=\"" . url_for('/staff/classes/show.php?id=' . u(h($row['class_id']))) . "\">View</a></td>";
		echo "<td><a class=\"action\" href=\"" . url_for('/staff/classes/edit.php?id=' . u(h($row['class_id']))) . "\">Edit</a></td>";
		echo "<td><a class=\"action\" href=\"" . url_for('/staff/classes/delete.php?id=' . u(h($row['class_id']))) . "\">Delete</a></td>";
		echo "</tr>";
	}
	function showHead() {
		echo "<tr>";
		echo "<form" . url_for('/staff/classes/index.php') . "\" method=\"post\">";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"ID\" /></th>";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"Name\" /></th>";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"Type\" /></th>";
		echo "</form>";
		echo "<th>Description</th>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "<tr>";
	}

	include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
	

	<div class="classes listing">
		<h1>CLASSES</h1>
		<div class="actions">
			<p><a class="action" href="<?php echo url_for('/staff/classes/new.php'); ?>">Create New Class</a></p>
		</div>
			
		<table class="list">
			<?php 
			showHead();	 
			while($class = mysqli_fetch_assoc($class_set)) { 
				showRow($class); 
		 	} ?>
		</table>
	</div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>