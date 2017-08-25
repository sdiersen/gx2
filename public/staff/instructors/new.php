<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$instructor = [];
	
	if(is_post_request()) {
		$instructor['first_name'] = $_POST['First'] ?? '';
		$instructor['last_name'] = $_POST['Last'] ?? '';
		$instructor['email'] = $_POST['Email'] ?? '';
		$instructor['primary_phone'] = convert_phone($_POST['Primary'] ?? '');
		$instructor['secondary_phone'] = convert_phone($_POST['Secondary'] ?? '');
		
		$result = insert_record('instructors', $instructor, $instructors_fields);

		if($result === true) {
			$id = mysqli_insert_id($db);
			redirect_to(url_for('/staff/instructors/show.php?id=' . $id));
		}
		$errors = $result;
		

	} else {
		$instructor['first_name'] = '';
		$instructor['last_name'] = '';
		$instructor['email'] = '';
		$instructor['primary_phone'] = '';
		$instructor['secondary_phone'] = '';
	}

	$page_title = 'Instructors - New Instructor';
	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/instructors/index.php'); ?>">&laquo;Back to List</a>

	<div class="instructors new">
		<?php echo display_errors($errors); ?>

		<form id="newInstructorForm" action="<?php echo url_for('/staff/instructors/new.php'); ?>" method="post">
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
				<input type="submit" value="Create Instructor" />
			</div>
		</form>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>