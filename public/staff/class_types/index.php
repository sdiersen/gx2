<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$type_set = find_all_records('class_types');

	$page_title = 'Class Types Index';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

	<?php 
		show_index('class_types', $type_set, $class_type_headings, $class_type_fields); 
		mysqli_free_result($type_set);
	?>
	

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>