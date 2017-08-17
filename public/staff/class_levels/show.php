<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$id = $_GET['id'] ?? '1';
	$class_level = find_record_by_id('class_levels', $id);
		
	//$page_title = 'Show Class Level';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

	<?php show_record('class_levels', $class_level, $class_level_fields); ?>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>