<?php
	require_once('../../../private/initialize.php');

	//require_login();

	if(is_post_request()) {
		$type = [];
		$type['name'] = $_POST['name'] ?? '';
		$type['description'] = $_POST['description'] ?? '';

		$result = insert_record('class_types', $type, $class_type_fields);
		if ($result) {
			$new_id = mysqli_insert_id($db);
			redirect_to(url_for('/staff/class_types/show.php?id=' . $new_id));
		} else  { //there were errors in the validation of the page 
			// TODO error work
		}
	} else { //this is the entry point to the new.php page. Create the empty $type array
		$type = [];
		$type['name'] = '';
		$type['description'] = '';
	}

	$page_title = 'New Class type';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<p><a class="back-link" href="<?php echo url_for('/staff/class_types/index.php'); ?>">&laquo;Back to List</a></p>

	<div class="classes new">
		<h1>Create Class type</h1>

		<form action="<?php echo url_for('/staff/class_types/new.php'); ?>" method="post">
			<dl>
				<dt>Name: </dt>
				<dd><input type="text" name="name" value="<?php echo h($type['name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Description: </dt>
				<dd><textarea name="description" cols="60" rows="10"><?php echo h($type['description']); ?></textarea></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Create type" />
			</div>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>