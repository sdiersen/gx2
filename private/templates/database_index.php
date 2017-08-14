<?php
	require_once('../../../private/initialize.php');

	require_login();

	//$data_set = find_all_table_name();

	$page_title = 'Table Name Index';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<div class="classes listing">
		<h1>Table Name</h1>

		<div class="actions">
			<a class="action" href="<?php echo url_for('/staff/table_name/new.php'); ?>">Create New Level</a>
		</div>

		<table class="list">
			<tr>
				<th>ID</th>
				<th>Level</th>
				<th>Description</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>

			<?php while($data = mysqli_fetch_assoc($data_set)) { ?>
				<tr>
					<td><?php echo h($level['id']); ?></td>
					<td><?php echo h($level['name']); ?></td>
					<td><?php echo h($level['description']); ?></td>
					<td><a class="action" href="<?php echo url_for('/staff/table_name/show.php?id=' . h(u($level['id']))); ?>">View</a></td>
					<td><a class="action" href="<?php echo url_for('/staff/table_name/edit.php?id=' . h(u($level['id']))); ?>">Edit</a></td>
					<td><a class="action" href="<?php echo url_for('/staff/table_name/delete.php?id=' . h(u($level['id']))); ?>">Delete</a></td>
				</tr>
			<?php } ?>
		</table>
		<?php mysqli_free_result($data_set); ?>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>