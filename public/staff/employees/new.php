<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$employee = [];
	
	if(is_post_request()) {
		$employee['first_name'] = $_POST['First'] ?? '';
		$employee['last_name'] = $_POST['Last'] ?? '';
		$employee['email'] = $_POST['Email'] ?? '';
		$employee['primary_phone'] = convert_phone($_POST['Primary'] ?? '');
		$employee['secondary_phone'] = convert_phone($_POST['Secondary'] ?? '');
		
		$result = insert_record('employees', $employee, $employees_fields);

		if($result === true) {
			$id = mysqli_insert_id($db);
			redirect_to(url_for('/staff/employees/show.php?id=' . $id));
		}
		$errors = $result;
		

	} else {
		$employee['first_name'] = '';
		$employee['last_name'] = '';
		$employee['email'] = '';
		$employee['primary_phone'] = '';
		$employee['secondary_phone'] = '';
	}

	$page_title = 'employees - New employee';
	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/employees/index.php'); ?>">&laquo;Back to List</a>

	<div class="employees new">
		<?php echo display_errors($errors); ?>

		<form id="newemployeeForm" action="<?php echo url_for('/staff/employees/new.php'); ?>" method="post">
			<dl>
				<dt>First Name: </dt>
				<dd><input type="text" name="First" value="<?php echo h($employee['first_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Last Name: </dt>
				<dd><input type="text" name="Last" value="<?php echo h($employee['last_name']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Email: </dt>
				<dd><input type="text" name="Email" value="<?php echo h($employee['email']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Primary Phone: </dt>
				<dd><input type="text" name="Primary" value="<?php echo h($employee['primary_phone']); ?>" /></dd>
			</dl>
			<dl>
				<dt>Secondary Phone: </dt>
				<dd><input type="text" name="Secondary" value="<?php echo h($employee['secondary_phone']); ?>" /></dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Create employee" />
			</div>
		</form>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>