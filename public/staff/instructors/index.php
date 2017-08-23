<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$options = [];
	$options['sort_by'] = "ORDER BY id ASC";
	if(is_post_request()) {
		if(isset($_POST['sortType'])) {
			if($_POST['sortType'] == 'First') {
				$options['sort_by'] = "ORDER BY first_name ASC";
			} elseif($_POST['sortType'] == 'Last') {
				$options['sort_by'] = "ORDER BY last_name ASC";
			} elseif($_POST['sortType'] == 'ID') {
				$options['sort_by'] = "ORDER BY id ASC";
			} elseif($_POST['sortType'] == 'Email') {
				$options['sort_by'] = "ORDER BY email ASC";
			} elseif($_POST['sortType'] == 'Primary') {
				$options['sort_by'] = "ORDER BY primary_phone ASC";
			} elseif($_POST['sortType'] == 'Secondary') {
				$options['sort_by'] = "ORDER BY secondary_phone ASC";
			}
		}
	}
	$instructor_set = find_all_records('instructors', $options);

	$page_title = 'GX Instructors - Index';

	function showRow($row) {
		echo "<tr>";
		echo "<td>" . h($row['id']) . "</td>";
		echo "<td>" . h($row['first_name']) . "</td>";
		echo "<td>" . h($row['last_name']) . "</td>";
		echo "<td>" . h($row['email']) . "</td>";
		echo "<td>" . h($row['primary_phone']) . "</td>";
		echo "<td>" . h($row['secondary_phone']) . "</td>";
		echo "<td><a class=\"action\" href=\"" . url_for('/staff/instructors/show.php?id=' . u(h($row['id']))) . "\">View</a></td>";
		echo "<td><a class=\"action\" href=\"" . url_for('/staff/instructors/edit.php?id=' . u(h($row['id']))) . "\">Edit</a></td>";
		echo "<td><a class=\"action\" href=\"" . url_for('/staff/instructors/delete.php?id=' . u(h($row['id']))) . "\">Delete</a></td>"; 
		echo "</tr>";
	}

	function showHead()
	{
		echo "<tr>";
		echo "<form action=\"" . url_for('/staff/instructors/index.php') . "\" method=\"post\">";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"ID\" /> </th>";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"First\" /></th>";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"Last\" /></th>";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"Email\" /></th>";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"Primary\" /></th>";
		echo "<th><input type=\"submit\" name=\"sortType\" value=\"Secondary\" /></th>";
		echo "</form>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "<tr>";
	}

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<div class="instructors listing">
		<h1>INSTRUCTORS</h1>
		<div class="actions">
			<p><a class="action" href="<?php echo url_for('/staff/instructors/new.php'); ?>">Create New Instructor</a></p>
		</div>
			
		<table class="list">
			<?php 
			showHead();	 
			while($instructor = mysqli_fetch_assoc($instructor_set)) { 
				showRow($instructor); 
		 	} ?>
		</table>
	</div>
</div>

<?php
	mysqli_free_result($instructor_set);
	include(SHARED_PATH . '/staff_footer.php');
?>