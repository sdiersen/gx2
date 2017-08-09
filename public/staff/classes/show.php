<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$id = $_GET['id'] ?? '1';

	$class = find_class_by_id($id);
	$page_title = 'Group Fitness - Show';
	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/classes/index.php'); ?>">&laquo;Back to List</a>

	<div class="classes show">
		<dl>
			<dt>Class Name: </dt>
			<dd><?php echo h($class['name']); ?></dd>
		</dl>
		<dl>
			<dt>Type: </dt>
			<dd><?php echo h($class['type']); ?></dd>
		</dl>
		<dl>
			<dt>Level: </dt>
			<dd><?php echo h($class['level']); ?></dd>
		</dl>
		<dl>
			<dt>Description: </dt>
			<dd><?php echo h($class['description']); ?></dd>
		</dl>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>