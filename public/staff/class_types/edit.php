<?php
	require_once('../../../private/initialize.php');

	//require_login();
	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/class_types/index.php'));
	}

	$id = $_GET['id'];

	if(is_post_request()) {
		$type = [];
		$type['id'] = $id;
		$type['name'] = $_POST['name'] ?? '';
		$type['description'] = $_POST['description'] ?? '';

		$result = update_record('class_types', $type, $class_type_fields);
		redirect_to(url_for('/staff/class_types/show.php?=' . $id));
	} else {
		$type = find_record_by_id('class_types', $id);
	}

	$page_title = 'Edit Class type';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

	<a class="back-link" href="<?php echo url_for('/staff/class_types/index.php'); ?>">&laquo; Back to List</a>

	<div class="class_types edit">
		<h1>Edit Class type</h1>
		<form action="<?php echo url_for('/staff/class_types/edit.php?id=' . h(u($id)));?>" method="post">
			<dl>
				<dt>type Name: </dt>
				<dd><input type="text" name="name" value="<?php echo h($type['name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Description: </dt>
				<dd><textarea name="description" cols="60" rows="10"><?php echo h($type['description']); ?></textarea></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Edit Subject" />
			</div>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>