<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$id = $_GET['id'] ?? '1';
	$class_type = find_record_by_id('class_types', $id);
		
	//$page_title = 'Show Class type';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

	<?php show_record('class_types', $class_type, $class_type_fields); ?>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>