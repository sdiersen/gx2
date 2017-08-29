<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$id = $_GET['id'] ?? 1;	

	$instructor = find_record_by_id('instructors', $id);

	$page_title = 'Instructors - Show';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/instructors/index.php'); ?>">&laquo;Back to List</a>

	<div class="instructors show">
		<dl>
			<dt>First Name: </dt>
			<dd><?php echo h($instructor['first_name']); ?></dd>
		</dl>
		<dl>
			<dt>Last Name: </dt>
			<dd><?php echo h($instructor['last_name']); ?></dd>
		</dl>
		<dl>
			<dt>Email: </dt>
			<dd><?php echo h($instructor['email']); ?></dd>
		</dl>
		<dl>
			<dt>Primary Phone: </dt>
			<dd><?php echo h($instructor['primary_phone']); ?></dd>
		</dl>
		<dl>
			<dt>Secondary Phone: </dt>
			<dd><?php echo h($instructor['secondary_phone']); ?></dd>
		</dl>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');