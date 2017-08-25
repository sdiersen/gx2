<?php  
	require_once('../../../private/initialize.php');

	//require_login();

	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/classes/index.php'));
	}

	$id = $_GET['id'];
	$class = [];


	if(is_post_request()) {
		//alter levels for class
		//alter types for class
		//alter class information

		if (!empty($_POST['type_checked'])) {
			$record_t = [];
			$old_types = [];
			$record_t['class_id'] = $id;
			$checked_types = get_all_class_types_by_id($id);
	
			while($row = mysqli_fetch_assoc($checked_types)){
				$old_types[] = $row['id'];
			}			 

			$del_types = array_diff($old_types, $_POST['type_checked']);
			$new_types = array_diff($_POST['type_checked'], $old_types);

			foreach($del_types as $del_type) {
				$record_t['type_id'] = $del_type;
				$old_id = find_class_with_types_id($record_t);
				delete_record('class_with_types', $old_id['id']);
			}

			foreach($new_types as $new_type) {
				$record_t['type_id'] = $new_type;
				insert_record('class_with_types', $record_t, $class_with_types_fields);
			}

			mysqli_free_result($checked_types);

		} else {
			$errors[] = "Must have at least one Type checked.";
		}
		
		if (!empty($_POST['level_checked'])) {
			$record_l = [];
			$old_levels = [];
			$record_l['class_id'] = $id;
			$checked_levels = get_all_class_levels_by_id($id);
	
			while($row = mysqli_fetch_assoc($checked_levels)) {
				$old_levels[] = $row['id'];
			}

			$del_levels = array_diff($old_levels, $_POST['level_checked']);
			$new_levels = array_diff($_POST['level_checked'], $old_levels);

			foreach($del_levels as $del_level) {
				$record_l['level_id'] = $del_level;
				$old_id = find_class_with_levels_id($record_l);
				delete_record('class_with_levels', $old_id['id']);
			}

			foreach($new_levels as $new_level) {
				$record_l['level_id'] = $new_level;
				insert_record('class_with_levels', $record_l, $class_with_levels_fields);
			}
			mysqli_free_result($checked_levels);
		} else {
			$errors[] = "Must have at least one Level checked.";
		}

		$class['id'] = $id;
		$class['name'] = $_POST['name'] ?? '';
		$class['short_desc'] = $_POST['short_desc'] ?? '';
		$class['long_desc'] = $_POST['long_desc'] ?? '';
		$class['duration'] = $_POST['duration'] ?? '';

		$result = update_record('classes', $class, $classes_fields);
		
		if(empty($errors) && $result === true) {
			redirect_to(url_for('/staff/classes/show.php?id=' . $class['id']));
		} elseif($result === true) {
		} else {
			foreach($result as $error) {
				$errors[] = $error;
			}
		}
		
	} else {
		$class = find_record_by_id('classes', $id);
	}

	$options = [];
	$options['sort_by'] = "ORDER BY id ASC ";
	$levels = find_all_records('class_levels', $options);
	$types = find_all_records('class_types', $options);
	$checked_levels = get_all_class_levels_by_id($id);
	$checked_types = get_all_class_types_by_id($id);
	$page_title = 'Group Fitness - Edit';

	include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
	<a class="back-link" href="<?php echo url_for('/staff/classes/index.php'); ?>">&laquo;Back to List</a>

	<div class="classes new">
		<?php echo display_errors($errors); ?>

		<form id="editClassForm" action="<?php echo url_for('/staff/classes/edit.php?id=' . u(h($id))); ?>" method="post">
			<dl>
				<dt>Name: </dt>
				<dd><input type="text" name="name" value="<?php echo h($class['name']); ?>" /> </dd>
			</dl>
			<dl>
				<dt>Type: </dt>
				<dd class="inLineCheck">
					<?php 
					$checked_t = mysqli_fetch_assoc($checked_types);
					while($typ = mysqli_fetch_assoc($types)) {
						echo "<div>";
						echo "<input type=\"checkbox\" name=\"type_checked[]\" value=\"" . $typ['id'] . "\"";
						if(!is_null($checked_t) && $typ['id'] == $checked_t['id']) {
							echo " checked>";
							$checked_t = mysqli_fetch_assoc($checked_types);
						} else {
							echo ">";
						}
						echo "<label>" . $typ['name'] . "</label>";
						echo "</div>";
					} ?>					
				</dd>
			</dl>
			<dl>
				<dt>Level: </dt>
				<dd class="inLineCheck">
					<?php 
					$level_count = 0;
					$checked_l = mysqli_fetch_assoc($checked_levels);
					while($lvl = mysqli_fetch_assoc($levels)) {
						echo "<div>";
						echo "<input type=\"checkbox\" name=\"level_checked[]\" value=\"" . $lvl['id'] . "\"";
						if(!is_null($checked_l) && $lvl['id'] == $checked_l['id']) {
							echo " checked>";
							$checked_l = mysqli_fetch_assoc($checked_levels);
						} else {
							echo ">";
						}
						echo "<label>" . $lvl['name'] . "</label>";
						echo "</div>";
					} ?>					
				</dd>
			</dl>
			<dl>
				<dt>Duration: </dt>
				<dd>
					<select name="duration" form="editClassForm">
						<option value="0" <?php if($class['duration'] == "0") { echo "selected"; } ?> >0 Minutes</option>
						<option value="30" <?php if($class['duration'] == "30") { echo "selected"; } ?> >30 Minutes</option>
						<option value="45" <?php if($class['duration'] == "45") { echo "selected"; } ?> >45 Minutes</option>
						<option value="60" <?php if($class['duration'] == "60") { echo "selected"; } ?> >60 Minutes</option>
						<option value="75" <?php if($class['duration'] == "75") { echo "selected"; } ?> >75 Minutes</option>
						<option value="90" <?php if($class['duration'] == "90") { echo "selected"; } ?> >90 Minutes</option>
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
				<input type="submit" value="Edit Class" />
			</div>
		</form>
	</div>
</div>

<?php 
	mysqli_free_result($levels);
	mysqli_free_result($types);
	mysqli_free_result($checked_levels);
	mysqli_free_result($checked_types);
	include(SHARED_PATH . '/staff_footer.php'); 
?>