<?php
	require_once('../../../private/initialize.php');

	//require_login();

	if(is_post_request()) {
		$level = [];
		$level['name'] = $_POST['name'] ?? '';
		$level['description'] = $_POST['description'] ?? '';

		$result = insert_record('class_levels', $level, $class_level_fields);
		if ($result) {
			$new_id = mysqli_insert_id($db);
			redirect_to(url_for('/staff/class_levels/show.php?id=' . $new_id));
		} else  { //there were errors in the validation of the page 
			// TODO error work
		}
	} else { //this is the entry point to the new.php page. Create the empty $level array
		$level = [];
		$level['name'] = '';
		$level['description'] = '';
	}

	$page_title = 'New Class Level';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<p><a class="back-link" href="<?php echo url_for('/staff/class_levels/index.php'); ?>">&laquo;Back to List</a></p>

	<div class="classes new">
		<h1>Create Class Level</h1>

		<form action="<?php echo url_for('/staff/class_levels/new.php'); ?>" method="post">
			<dl>
				<dt>Name: </dt>
				<dd><input type="text" name="name" value="<?php echo h($level['name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Description: </dt>
				<dd><textarea name="description" cols="60" rows="10"><?php echo h($level['description']); ?></textarea></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Create Level" />
			</div>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>