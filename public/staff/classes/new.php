<?php
	require_once('../../../private/initialize.php');

	//require_login();

	if(is_post_request()) { //user has submitted a new class

	} else { //user is getting to this page for the first time, initialize variables
		$class = [];
		$class['name'] = '';
		$class['type'] = '';
		$class['level'] = '';
		$class['description'] = '';
	}

	// process this part everytime the page is entered
	$page_title = 'Group Fitness - New Class';
	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>