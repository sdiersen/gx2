<?php
	require_once('../../../private/initialize.php');

	//require_login();
	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/class_types/index.php'));
	}

	$id = $_GET['id'];

	if(is_post_request()) {
		$result = delete_record($id, 'class_types');
		redirect_to(url_for('/staff/class_types/index.php'));
	} else {
		$type = find_class_type_by_id($id);
	}

	$page_title = 'Delete Class Type';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
 	<a class="back-link" href="<?php echo url_for('/staff/class_types/index.php'); ?>">&laquo;Back to List</a>
 	<div class="classes delete">
 		<h1>Delete Class Type</h1>
 		<p>Are you sure you want to delete this class type?</p>
 		<p class="item"><?php echo h($type['name']);?></p>
 		<form action="<?php url_for('/staff/class_types/delete?id=' . h(u($type['id']))); ?>" method="post">
 			<div id="operations">
 				<input type="submit" name="commit" value="Delete Class Type" />
 			</div>
 		</form>
 	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>