<?php
	require_once('../../../private/initialize.php');

	//require_login();
	$levels = find_all_records('class_levels');
	$types = find_all_records('class_types');

	if(is_post_request()) { //user has submitted a new class
		$class = [];
		$class_type = [];
		$class_level = [];

		$class['name'] = $_POST['name'] ?? '';
		$class['short_desc'] = $_POST['short_desc'] ?? '';
		$class['long_desc'] = $_POST['long_desc'] ?? '';
		$class['duration'] = $_POST['duration'] ?? '';

		insert_record('classes', $class, $classes_fields);

		$class['id'] = mysqli_insert_id($db);

		$class_level['class_id'] = $class['id'];
		while($l = mysqli_fetch_assoc($levels)) {
			if(isset($_POST[$l['name']])) {
				$class_level['level_id'] = $_POST[$l['name']];
				insert_record('class_with_levels', $class_level, $class_with_levels_fields);
			}
		}
		$class_type['class_id'] = $class['id'];
		while($t = mysqli_fetch_assoc($types)) {
			if(isset($_POST[$t['name']])) {
				$class_type['type_id'] = $_POST[$t['name']];
				insert_record('class_with_types', $class_type, $class_with_types_fields);
			}
		}

		redirect_to(url_for('/staff/classes/show.php?id=' . $class['id']));

	} else { //user is getting to this page for the first time, initialize variables
		$class = [];
		$class['name'] = '';
		$class['short_desc'] = '';
		$class['long_desc'] = '';
		$class['duration'] = '';

		$class_type = [];
		$class_type['id'] = '';
		$class_type['name'] = '';

		$class_level = [];
		$class_level['id'] = '';
		$class_level['name'] = '';


	}

	// process this part everytime the page is entered
	$page_title = 'Group Fitness - New Class';
	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/classes/index.php'); ?>">&laquo;Back to List</a>

	<div class="classes new">
		<?php echo display_errors($errors); ?>

		<form id="newClassForm" action="<?php echo url_for('/staff/classes/new.php'); ?>" method="post">
			<dl>
				<dt>Name: </dt>
				<dd><input type="text" name="name" value="<?php echo h($class['name']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Type: </dt>
				<dd class="inLineCheck">
					<?php while($typ = mysqli_fetch_assoc($types)) {
						echo "<div>";
						echo "<input type=\"checkbox\" id=\"" . $typ['name'] . "\" name=\"" . $typ['name'] . "\" value=\"" . $typ['id'] . "\">";
						echo "<label for\"" . $typ['name'] . "\">" . $typ['name'] . "</label>";
					} ?>					
				</dd>
			</dl>
			<dl>
				<dt>Level: </dt>
				<dd class="inLineCheck">
					<?php while($lvl = mysqli_fetch_assoc($levels)) {
						echo "<div>";
						echo "<input type=\"checkbox\" id=\"" . $lvl['name'] . "\" name=\"" . $lvl['name'] . "\" value=\"" . $lvl['id'] . "\">";
						echo "<label for\"" . $lvl['name'] . "\">" . $lvl['name'] . "</label>";
					} ?>					
				</dd>
			</dl>
			<dl>
				<dt>Duration: </dt>
				<dd>
					<select name="duration" form="newClassForm">
						<option value="0">0 Minutes</option>
						<option value="30">30 Minutes</option>
						<option value="45">45 Minutes</option>
						<option value="60">60 Minutes</option>
						<option value="75">75 Minutes</option>
						<option value="90">90 Minutes</option>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>Short Description: </dt>
				<dd>	
					<textarea name="short_desc" cols="60" rows="10">
						<?php echo h($class['short_desc']); ?>
					</textarea>
				</dd>
			</dl>
			<dl>
				<dt>Long Description: </dt>
				<dd>
					<textarea name="long_desc" cols="60" rows="10">
						<?php echo h($class['long_desc']); ?>
					</textarea>
				</dd>
			</dl>
			<div id="operations">
				<input type="submit" value="Create Class" />
			</div>
		</form>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>