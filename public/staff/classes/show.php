<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$id = $_GET['id'] ?? '1';

	$class = find_record_by_id('classes', $id);
	$levels = get_all_class_levels($id);
	$types = get_all_class_types($id);
	
	$lvl_string = '';
	while($lvl = mysqli_fetch_assoc($levels)) {
		$lvl_string .= $lvl['name'] . " ";
	}
	$type_string = '';
	while($typ = mysqli_fetch_assoc($types)) {
		$type_string .= $typ['name'] . " ";
	}
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
			<dd><?php echo h($type_string); ?></dd>
		</dl>
		<dl>
			<dt>Level: </dt>
			<dd><?php echo h($lvl_string); ?></dd>
		</dl>
		<dl>
			<dt>Duration: </dt>
			<dd><?php echo h($class['duration']); ?></dd>
		</dl>
		<dl>
			<dt>Short Description: </dt>
			<dd><?php echo h($class['short_desc']); ?></dd>
		</dl>
		<dl>
			<dt>Long Description: </dt>
			<dd><?php echo h($class['long_desc']); ?></dd>
		</dl>
	</div>
</div>

<?php 
	include(SHARED_PATH . '/staff_footer.php'); 
	mysqli_free_result($levels);
	mysqli_free_result($types);
?>