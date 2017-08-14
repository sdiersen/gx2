<?php
	require_once('../../../private/initialize.php');

	//require_login();

	$level_set = find_all_class_levels();

	$page_title = 'Class Levels Index';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

	<?php 
		show_index('class_levels', $level_set, $class_level_headings, $class_level_fields); 
		mysqli_free_result($level_set);
	?>
	

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>