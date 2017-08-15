<?php
	require_once('../../../private/initialize.php');

	//require_login();

	if(is_post_request()) {
		$level = [];
		$level['name'] = $_POST['name'] ?? '';
		$level['discription'] = $_POST['discription'] ?? '';

		$result = insert_class_level($level);
		
	}

	$page_title = 'New Class Level';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>