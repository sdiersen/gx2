<?php

	require_once('../../../private/initialize.php');

	//require_login();

	$class_set = find_all_classes();

	$page_title = 'GX Classes - Index';

	include(SHARED_PATH . '/staff_header.php');

?>

<div id="content">
	<div class="classes listing">
		<h1>Classes</h1>
		<div class="actions">
			<a class="action" href="<?php echo url_for('/staff/classes/new.php'); ?>">Create New Class</a>
		</div>
		<table class="list">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>View</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<?php $type_value = 'strength'; ?>
			<tr class="type_row"><?php echo strtoupper(h($type_value)); ?></tr>
			<?php	while($class = mysqli_fetch_assoc($class_set)) 
			{ 
				if($type_value != $class['type']) {
					$type_value = $class['type']; 
			?>
					<tr class="type_row"><?php echo strtoupper(h($type_value)); ?></tr>			
				<?php } else { // end of the if clause ($type_value != $class['type']?>
					<tr>
						<td><?php echo h($class['id']);?></td>
						<td><?php echo h($class['name']);?></td>
						<td><a class="action" href="<?php url_for('/staff/classes/show.php?id=' . u(h($class['id']))); ?>">View</a></td>
						<td><a class="action" href="<?php url_for('/staff/classes/edit.php?id=' . u(h($class['id']))); ?>">Edit</a></td>
						<td><a class="action" href="<?php url_for('/staff/classes/delete.php?id=' . u(h($class['id']))); ?>">Delete</a></td>
					</tr>
				<?php } //end the else clause ?>
			<?php } //end the while $class clause ?>
		</table>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>