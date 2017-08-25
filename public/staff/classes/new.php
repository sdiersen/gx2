<?php
	require_once('../../../private/initialize.php');

	//require_login();
	
	$class = [];
		
	if(is_post_request()) { //user has submitted a new class

		//make sure there is at least one level
		if(empty($_POST['level_checked'])) {
			$errors[] = 'Must have at least 1 level checked';
		}

		//make sure there is at least one type
		if(empty($_POST['type_checked'])) {
			$errors[] = 'Must have at least 1 type checked';
		}
		
		//create the class
		$class['name'] = $_POST['name'] ?? '';
		$class['short_desc'] = $_POST['short_desc'] ?? '';
		$class['long_desc'] = $_POST['long_desc'] ?? '';
		$class['duration'] = $_POST['duration'] ?? '';

		//If there are any errors from the type and level then check for errors in the class
		if(!empty($errors)){
			$result = validate_classes($class);
			foreach($result as $error) {
				$errors[] = $error;
			}
		} else { //since there are no errors in level and type try to create the record
			$result = insert_record('classes', $class, $classes_fields);

			if($result === true) { //record created save the id for later use
				$class['id'] = mysqli_insert_id($db);
			} else { //errors in the class, add them to the array to show
				foreach($result as $error) {
					$errors[] = $error;
				}
			}		
		}
		//Check once more for errors that have happened
		if(empty($errors)) { //No errors: insert records into class_with_levels and class_with_types
			$class_level = [];
			$class_level['class_id'] = $class['id'];
			foreach($_POST['level_checked'] as $lvl) {
				$class_level['level_id'] = $lvl;
				insert_record('class_with_levels', $class_level, $class_with_levels_fields);
			}
			$class_type = [];
			$class_type['class_id'] = $class['id'];
			foreach($_POST['type_checked'] as $typ) {
				$class_type['type_id'] = $typ;
				insert_record('class_with_types', $class_type, $class_with_types_fields);
			}

			redirect_to(url_for('/staff/classes/show.php?id=' . $class['id']));
		}

		

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
	

	function show_types() {
		$types = find_all_records('class_types');
		$ids = $_POST['type_checked'] ?? [];
		$id = array_shift($ids);
		echo "<div>";
		while($typ = mysqli_fetch_assoc($types)) {
			echo "<input type=\"checkbox\" name=\"type_checked[]\" value=\"" . $typ['id'] . "\" ";
			if(!is_null($id) && $typ['id'] == $id) {
				echo "checked >";
				$id = array_shift($ids);
			}
			echo "<label>" . $typ['name'] . "</label>";
		}
		echo "</div>";
		mysqli_free_result($types);
	}

	function show_levels() {
		$levels = find_all_records('class_levels');
		$ids = $_POST['level_checked'] ?? [];
		$id = array_shift($ids);
		echo "<div>";
		while($lev = mysqli_fetch_assoc($levels)) {
			echo "<input type=\"checkbox\" name=\"level_checked[]\" value=\"" . $lev['id'] . "\" ";
			if(!is_null($id) && $lev['id'] == $id) {
				echo "checked >";
				$id = array_shift($ids);
			}
			echo "<label>" . $lev['name'] . "</label>";
		}
		echo "</div>";
		mysqli_free_result($levels);
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
					<?php show_types(); ?>					
				</dd>
			</dl>
			<dl>
				<dt>Level: </dt>
				<dd class="inLineCheck">
					<?php show_levels(); ?>					
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