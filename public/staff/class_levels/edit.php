<?php
	require_once('../../../private/initialize.php');

	//require_login();
	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/class_levels/index.php'));
	}

	$id = $_GET['id'];

	if(is_post_request()) {
		$level = [];
		$level['id'] = $id;
		$level['name'] = $_POST['name'] ?? '';
		$level['description'] = $_POST['description'] ?? '';

		$result = update_record('class_levels', $level, $class_level_fields);
		redirect_to(url_for('/staff/class_levels/show.php?id=' . $id));
	} else {
		$level = find_record_by_id('class_levels', $id);
	}

	$page_title = 'Edit Class Level';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

	<a class="back-link" href="<?php echo url_for('/staff/class_levels/index.php'); ?>">&laquo; Back to List</a>

	<div class="class_levels edit">
		<h1>Edit Class Level</h1>
		<form action="<?php echo url_for('/staff/class_levels/edit.php?id=' . h(u($id)));?>" method="post">
			<dl>
				<dt>Level Name: </dt>
				<dd><input type="text" name="name" value="<?php echo h($level['name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Description: </dt>
				<dd><textarea name="description" cols="60" rows="10"><?php echo h($level['description']); ?></textarea></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Edit Subject" />
			</div>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>