<?php

	require_once('../../../private/initialize.php');

	//require_login();

	$class_set = classes_index();

	$page_title = 'GX Classes - Index';

	include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
	

	<div class="classes listing">
		<h1>CLASSES</h1>
		<div class="actions">
			<p><a class="action" href="<?php echo url_for('/staff/classes/new.php'); ?>">Create New Class</a></p>
		</div>
		<table class="list">
			<tr>
				<th>Class Type</th>
				<th>Class Name</th>
			</tr>
			<?php while($class = mysqli_fetch_assoc($class_set)) { ?>
				<tr>
					<td><?php echo h($class['type_name']); ?></td>
					<td><?php echo h($class['class_name']); ?></td>
			<?php } ?>
	</div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>