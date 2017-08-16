<?php
	require_once('../../../private/initialize.php');

	//require_login();
	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/class_levels/index.php'));
	}

	$id = $_GET['id'];

	if(is_post_request()) {
		$result = delete_record($id, 'class_levels');
		redirect_to(url_for('/staff/class_levels/index.php'));
	} else {
		$level = find_class_level_by_id($id);
	}

	$page_title = 'Delete Class Level';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
 	<a class="back-link" href="<?php echo url_for('/staff/class_levels/index.php'); ?>">&laquo;Back to List</a>
 	<div class="classes delete">
 		<h1>Delete Class Level</h1>
 		<p>Are you sure you want to delete this class level?</p>
 		<p class="item"><?php echo h($level['name']);?></p>
 		<form action="<?php url_for('/staff/class_levels/delete?id=' . h(u($level['id']))); ?>" method="post">
 			<div id="operations">
 				<input type="submit" name="commit" value="Delete Class Level" />
 			</div>
 		</form>
 	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>