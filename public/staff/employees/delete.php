<?php
	require_once('../../../private/initialize.php');

	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/instructors/index.php'));
	}

	$id = $_GET['id'];
	$instructor = find_record_by_id('instructors', $id);

	if(is_post_request()) {
		$result = delete_record('instructors', $id);
		redirect_to(url_for('/staff/instructors/index.php'));
	}

	$page_title = 'Instructors - Delete Instructor';
	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/instructors/index.php'); ?>">&laquo;Back to List</a>
	<div class="instructors delete">
		<h1>Delete Instructor</h1>
		<p>Are you sure you want to delete this Instructor?</p>
		<p class="item"><?php echo h($instructor['first_name']) . " " . h($instructor['last_name']); ?></p>

		<form action="<?php echo url_for('/staff/instructors/delete.php?id=' . h(u($id))); ?>" method="post">
			<div id="operations">
				<input type="submit" name="commit" value="Delete Instructor" />
			</div>
		</form>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>