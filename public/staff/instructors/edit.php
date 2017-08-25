<?php
	require_once('../../../private/initialize.php');

	if(!isset($_GET['id'])) {
		redirct_to(url_for('/staff/instructors/index.php'));
	} 

	$id = $_GET['id'];
	$options = [];
	$options['sort_by'] = "ORDER BY id ASC";

	$instructor = [];

	if(is_post_request()) {
		$instructor['id'] = $id;
		$instructor['first_name'] = $_POST['First'] ?? '';
		$instructor['last_name'] = $_POST['Last'] ?? '';
		$instructor['email'] = $_POST['Email'] ?? '';
		$instructor['primary_phone'] = convert_phone($_POST['Primary'] ?? '');
		$instructor['secondary_phone'] = convert_phone($_POST['Secondary'] ?? '');
		
		$result = update_record('instructors', $instructor, $instructors_fields);

		if($result === true) {
			redirect_to(url_for('/staff/instructors/show.php?id=' . $id));
		}
		$errors = $result;
	} else {
		$instructor = find_record_by_id('instructors', $id);
	}

	$page_title = 'Instructors - Edit Instructor';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/instructors/index.php'); ?>">&laquo;Back to List</a>

	<div class="instructors edit">
		<?php echo display_errors($errors); ?>
		<form id="editInstructorsForm" action="<?php echo url_for('/staff/instructors/edit.php?id=' . u(h($id))); ?>" method="post">
			<dl>
				<dt>First Name: </dt>
				<dd><input type="text" name="First" value="<?php echo h($instructor['first_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Last Name: </dt>
				<dd><input type="text" name="Last" value="<?php echo h($instructor['last_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Email: </dt>
				<dd><input type="text" name="Email" value="<?php echo h($instructor['email']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Primary Phone: </dt>
				<dd><input type="text" name="Primary" value="<?php echo h($instructor['primary_phone']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Secondary Phone: </dt>
				<dd><input type="text" name="Secondary" value="<?php echo h($instructor['secondary_phone']); ?>" /></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Edit Instructor" />
			</div>
		</form>
	</div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>