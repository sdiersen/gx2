<?php  
	require_once('../../../private/initialize.php');

	//require_login();

	if(!isset($_GET['id'])) {
		redirect_to(url_for('/staff/classes/index.php'));
	}

	$id = $_GET['id'];
	$levels = find_all_records('class_levels');
	$types = find_all_records('class_types');
	$checked_levels = get_all_class_levels($id);

	if(is_post_request()) {

	} else {
		$class = find_record_by_id('classes', $id);
	}

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
						echo "<input type=\"checkbox\" id=\"" . $lvl['name'] . "\" name=\"" . $lvl['name'] . "\" value=\"" . $lvl['id'] . "\"";
						while($check_level = mysqli_fetch_assoc($checked_levels)){
							if($check_level['name'] == $lvl['name']) {
								echo " checked";
							}
						}
						echo ">";
						echo "<label for=\"" . $lvl['name'] . "\">" . $lvl['name'] . "</label>";
					} ?>					
				</dd>
			</dl>
			<dl>
				<dt>Duration: </dt>
				<dd>
					<select name="duration" form="newClassForm">
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

<?php include(SHARED_PATH . '/staff_footer.php'); ?>