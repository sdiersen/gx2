<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$id = $_GET['id'] ?? '1';
	$class_type = find_class_type_by_id($id);
		
	//$page_title = 'Show Class type';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

	<?php show_record('class_types', $class_type, $class_type_fields); ?>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>