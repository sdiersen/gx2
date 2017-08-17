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
		<?php $theType = ''; ?>
		<table class="list">
			<?php while($class = mysqli_fetch_assoc($class_set)) { 
				if($theType != $class['type_name']) { 
					$theType = $class['type_name']; ?>
					<tr colspan="6">
						<td class="rowH2"><?php echo h($class['type_name']); ?></td>
					</tr>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Description</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
					<tr>
						<td><?php echo h($class['class_id']); ?></td>
						<td><?php echo h($class['class_name']); ?></td>
						<td><?php echo h($class['description']); ?></td>
						<td><a class="action" href="<?php echo url_for('/staff/classes/show.php?id=' . u(h($class['class_id']))); ?>">View</a></td>
						<td><a class="action" href="<?php echo url_for('/staff/classes/edit.php?id=' . u(h($class['class_id']))); ?>">Edit</a></td>
						<td><a class="action" href="<?php echo url_for('/staff/classes/delete.php?id=' . u(h($class['class_id']))); ?>">Delete</a></td>
					</tr>
				<?php } else { ?>
					<tr>
						<td><?php echo h($class['class_id']); ?></td>
						<td><?php echo h($class['class_name']); ?></td>
						<td><?php echo h($class['description']); ?></td>
						<td><a class="action" href="<?php echo url_for('/staff/classes/show.php?id=' . u(h($class['class_id']))); ?>">View</a></td>
						<td><a class="action" href="<?php echo url_for('/staff/classes/edit.php?id=' . u(h($class['class_id']))); ?>">Edit</a></td>
						<td><a class="action" href="<?php echo url_for('/staff/classes/delete.php?id=' . u(h($class['class_id']))); ?>">Delete</a></td>
					</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>