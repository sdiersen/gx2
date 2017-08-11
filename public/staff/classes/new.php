<?php
	require_once('../../../private/initialize.php');

	//require_login();

	if(is_post_request()) { //user has submitted a new class

	} else { //user is getting to this page for the first time, initialize variables
		$class = [];
		$class['name'] = '';
		$class['short_desc'] = '';
		$class['long_desc'] = '';

		$class_type = [];
		$class_type['id'] = '';
		$class_type['name'] = '';

		$class_level = [];
		$class_level['id'] = '';
		$class_level['name'] = '';

		$levels = [];
	}

	// process this part everytime the page is entered
	$page_title = 'Group Fitness - New Class';
	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/classes/index.php'); ?>">&laquo;Back to List</a>

	<div class="classes new">
		<?php echo display_errors($errrors); ?>

		<form action="<?php echo url_for('/staff/classes/new.php'); ?>" method="post">
			<dl>
				<dt>Class Name: </dt>
				<dd><input type="text" name="name" value="<?php echo h($class['name']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Class Type: </dt>
				<dd class="inLineRadio">
					<?php $type_set = get_all_class_types();
					while($type = mysqli_fetch_assoc($type_set)) {
						echo "<input type=\"radio\" name=\"class_type\" value=\"" . h($type['name']) . "\"";
						if($type['name'] == $class_type['name']) { echo " checked"; }
						echo ">" . h($type['name']) . "</input>";
					} ?>
				</dd>
			</dl>
			<dl>
				<dt>Class Level: </dt>
				<dd class="inLineCheck">
					<?php $level_set = get_all_level_types();
					while($level = mysqli_fetch_assoc($level_set)) { ?>
						<input type="checkbox" name="class_level[]" value="<?php echo h($level['id']); ?>" 
							<?php if(has_inclusion_of($level['id'], $levels)) { echo " checked=\"checked\""; } ?> >
							<?php echo h($level['name']); ?>
						</input>
				</dd>
			</dl>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>