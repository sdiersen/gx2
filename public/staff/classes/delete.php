<?php
	require_once('../../../private/initialize.php');

	//require_login();
	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/classes/index.php'));
	}

	$id = $_GET['id'];

	if(is_post_request()) {
		$result = delete_record('classes', $id);
		redirect_to(url_for('/staff/classes/index.php'));
	} else {
		$class = find_record_by_id('classes', $id);
	}

	$page_title = 'Delete Class';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
 	<a class="back-link" href="<?php echo url_for('/staff/classes/index.php'); ?>">&laquo;Back to List</a>
 	<div class="classes delete">
 		<h1>Delete Class</h1>
 		<p>Are you sure you want to delete this class?</p>
 		<p class="item"><?php echo h($class['name']);?></p>
 		<form action="<?php url_for('/staff/classes/delete?id=' . h(u($class['id']))); ?>" method="post">
 			<div id="operations">
 				<input type="submit" name="commit" value="Delete Class" />
 			</div>
 		</form>
 	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>