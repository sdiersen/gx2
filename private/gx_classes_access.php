<?php

	//BASICS FOR EACH TABLE
	//find_all_*table*($sql)
	//find_*table_data*_by_id($id)
	//validate_*table_data*
 	//insert_*table_data*
	//delete_*table_data*
	//update_*table_data*
	$class_level_headings = ['Class Level', 'ID', 'Level', 'Description'];
	$class_level_fields = ['id', 'name', 'description'];
	$class_type_headings = ['Class Type', 'ID', 'Type', 'Description'];
	$class_type_fields = ['id', 'name', 'description'];
	$classes_headings = ['Classes', 'ID', 'Name', 'Short Description', 'Long Description', 'Duration'];
	$classes_fields = ['id', 'name', 'short_desc', 'long_desc', 'duration'];
	$class_with_levels_fields = ['id', 'class_id', 'level_id'];
	$class_with_types_fields = ['id', 'class_id', 'type_id'];
	$instructors_fields = ['id', 'first_name', 'last_name', 'email', 'primary_phone', 'secondary_phone'];
	//DAYNAME(date) returns the day of the week for the date given
	//use as SELECT DAYNAME('1-1-2017');

	//classes functions

	function find_one($sql) {
		global $db;

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$row = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $row;
	}

	function check_query($sql) {
		global $db;

		$result = mysqli_query($db, $sql);
		if($result) {
			return true;
		} else {
			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function show_index($table_name, $data_set, $headings, $fields) {

		echo "<div class=\"classes listing\">";
		echo "<h1>" . strtoupper(h($headings[0])) . "</h1>";
		echo "<div class=\"actions\">";
		$new = "/staff/" . h(u($table_name)) . "/new.php";
		echo "<p><a class=\"action\" href=\"" . url_for($new) . "\">Create New " . h($headings[0]) . "</a></p>";
		echo "</div>";
		echo "<table class=\"list\">";
		echo "<tr>";
		$hcount = count($headings);
		for($h = 1; $h < $hcount; $h++) {
			echo "<th>" . h($headings[$h]) . "</th>";
		}
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "<th>&nbsp;</th>";
		echo "</tr>";
		
		$count = count($fields);
		while($data = mysqli_fetch_assoc($data_set)) {
			echo "<tr>";
			for($i = 0; $i < $count; $i++) {
				echo "<td>" . h($data[$fields[$i]]) . "</td>";
			}
			$show = "/staff/" . h(u($table_name)) . "/show.php?id=" . h(u($data['id']));
			echo "<td><a class=\"action\" href=\"" . url_for($show) . "\">View</a></td>";
			$edit = "/staff/" . h(u($table_name)) . "/edit.php?id=" . h(u($data['id']));
			echo "<td><a class=\"action\" href=\"" . url_for($edit) . "\">Edit</a></td>";
			$delete = "/staff/" . h(u($table_name)) . "/delete.php?id=" . h(u($data['id']));
			echo "<td><a class=\"action\" href=\"" . url_for($delete) . "\">Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";	
	}

	function show_record($table_name, $record, $fields) {

		$index = "/staff/" . $table_name . "/index.php";
		echo "<p><a class=\"back-link\" href=\"" . url_for($index) . "\">&laquo;Back to List</a></p>"; 

		echo "<div class=\"" . $table_name . " show\">";
		$crec = count($record);
		$cfie = count($fields);
		if($crec !== $cfie) {
			echo "RECORD HAS A DIFFERENT COUNT THAN FIELDS";
			echo "<a class=\"back-link\" href=\"" . url_for($index) . "\">Back to Index</a>";
		} else {
			for ($i = 0; $i < $crec; $i++) {
				echo "<dl>";
				echo "<dt>" . $fields[$i] . ": </dt>";
				echo "<dd>" . $record[$fields[$i]] . "</dd>";
				echo "<dl>";
			}
		}
		echo "</div>";
	}

	function update_record($table_name, $record, $fields, $options=[]) {
		
		global $db;

		$errors = validate($table_name, $record);
		if(!empty($errors)) {
			return $errors;
		}

		$count = count($fields);

		$sql  = "UPDATE " . db_escape($db, $table_name) . " SET ";
		if ($count > 1) {
			for($i = 1; $i < ($count -1); $i++) {
				$sql .= db_escape($db, $fields[$i]) . "='" . db_escape($db, $record[$fields[$i]]) . "', ";
			}
		}
		$sql .= db_escape($db, $fields[($count-1)]) . "='" . db_escape($db, $record[$fields[($count-1)]]) . "' ";
		$sql .= "WHERE id='" . db_escape($db, $record['id']) . "' ";
		$sql .= "LIMIT 1";
		return check_query($sql);
	}

	function insert_record($table_name, $record, $fields, $options=[]) {
		global $db;

		$errors = validate($table_name, $record);
		if(!empty($errors)) {
			return $errors;
		}

		$cfields = count($fields);
		$crecord = count($record);

		if ($cfields == $crecord) {
			return false;
		}
		$sql  = "INSERT INTO " . db_escape($db, $table_name) . " ";
		$sql .= "(";
		if ($cfields > 1) {
			//fields includes id, which record does not (not known yet)
			for($i = 1; $i < ($cfields - 1); $i++) {
				$sql .= db_escape($db, $fields[$i]) . ", ";
			}
		}
		$sql .= db_escape($db, $fields[($cfields-1)]) . ") ";
		$sql .= "VALUES (";
		if ($crecord > 1) {
			//record will have one less field than fields because it doesn't have id yet
			for($j = 1; $j < ($crecord); $j++) {
				$sql .= "'" . db_escape($db, $record[$fields[$j]]) . "', ";
			}
		}
		$sql .= "'" . db_escape($db, $record[$fields[($cfields - 1)]]) . "')";
		echo $sql;
		return check_query($sql);
	}

	function delete_record($table_name, $id, $options=[]) {
		global $db;

		$sql  = "DELETE FROM " . db_escape($db, $table_name) . " ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
		$sql .= "LIMIT 1";

		return check_query($sql);
	}

	function find_all_records($table_name, $options=[]) {
		global $db;

		$sql = "SELECT * FROM " . db_escape($db, $table_name) . " ";

		if(isset($options['sort_by'])) {
			$sql .= $options['sort_by'];
		}

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function find_record_by_id($table_name, $id, $options=[]) {
		global $db;

		$sql  = "SELECT * FROM " . db_escape($db, $table_name) . " ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";

		return find_one($sql);
	}

	function find_class_with_levels_id($record, $options=[]) {
		global $db;

		$sql  = "SELECT id FROM class_with_levels ";
		$sql .= "WHERE class_id='" . db_escape($db, $record['class_id']) . "' ";
		$sql .= "AND level_id='" . db_escape($db, $record['level_id']) . "' ";
		$sql .= "LIMIT 1";

		return find_one($sql);
	}

	function find_class_with_types_id($record, $options=[]) {
		global $db;

		$sql  = "SELECT id FROM class_with_types ";
		$sql .= "WHERE class_id='" . db_escape($db, $record['class_id']) . "' ";
		$sql .= "AND type_id='" . db_escape($db, $record['type_id']) . "' ";
		$sql .= "LIMIT 1";

		return find_one($sql);		
	}


	//Classes
	function find_all_classes($options=[]) {
		
		$sql  = "SELECT * FROM classes ";
		$sql .= "ORDER BY type ASC, name ASC";

		return find_all($sql);
	}

	function find_class_by_id($id, $options=[]) {
		global $db;

		$sql  = "SELECT * FROM classes ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";

		return find_one($sql);
	}

	function find_class_by_name($name, $options=[]) {
		global $db;

		$sql  = "SELECT * FROM classes ";
		$sql .= "WHERE name='" . db_escape($db, $name) . "'";

		return find_one($sql);
	}

	function find_classes_with_levels($options=[]) {
		
		$sql  = "SELECT classes.name, class_levels.name ";
		$sql .= "FROM classes, class_levels, class_with_levels ";
		$sql .= "WHERE classes.id = class_with_levels.class_id ";
		$sql .= "AND class_levels.id = class_with_levels.level_id";

		return find_all($sql);
	}

	function classes_index($options=[]) {
		global $db;

		//search through classes_with_types, sorting by classes_types.name ASC and classes.name ASC 
		//which are gotten from classes_with_types.types_id and classes_with_types.class_id

		$sql  = "SELECT class_types.name AS type_name, classes.name AS class_name, classes.id AS class_id, classes.short_desc AS description ";
		$sql .= "FROM class_with_types, classes, class_types ";
		$sql .= "WHERE class_with_types.type_id = class_types.id ";
		$sql .= "AND class_with_types.class_id = classes.id ";
		if (isset($options['sort'])) {
			$sql .= db_escape($db, $options['sort']);
		} else {
			$sql .= "ORDER BY class_types.name ASC, classes.name ASC";
		}

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function get_all_class_levels($id, $options=[]){
		global $db;

		$sql  = "SELECT class_levels.name AS name ";
		$sql .= "FROM class_levels, class_with_levels ";
		$sql .= "WHERE class_with_levels.class_id ='" . db_escape($db, $id) . "' ";
		$sql .= "AND class_with_levels.level_id = class_levels.id";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function get_all_class_types($id, $options=[]) {
		global $db;

		$sql  = "SELECT class_types.name AS name ";
		$sql .= "FROM class_types, class_with_types ";
		$sql .= "WHERE class_with_types.class_id ='" . db_escape($db, $id) . "' ";
		$sql .= "AND class_with_types.type_id = class_types.id ";
		
		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function get_all_class_levels_by_id($id, $options=[]) {
		global $db;

		$sql  = "SELECT class_levels.id AS id ";
		$sql .= "FROM class_levels, class_with_levels ";
		$sql .= "WHERE class_with_levels.class_id ='" .db_escape($db, $id) . "' ";
		$sql .= "AND class_with_levels.level_id = class_levels.id ";
		$sql .= "ORDER BY class_levels.id ASC ";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function get_all_class_types_by_id($id, $options=[]) {
		global $db;

		$sql  = "SELECT class_types.id AS id ";
		$sql .= "FROM class_types, class_with_types ";
		$sql .= "WHERE class_with_types.class_id ='" . db_escape($db, $id) . "' ";
		$sql .= "AND class_with_types.type_id = class_types.id ";
		$sql .= "ORDER BY class_types.id ASC ";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	//Validation
	function validate($table_name, $record) {
		switch ($table_name) {
			case 'instructors':
				return validate_instructors($record);
				break;
			case 'classes':
				return validate_classes($record);
				break;
		}
	}

	function validate_instructors($instructor) {
		$errors = [];

		if(!has_valid_phone_number($instructor['primary_phone'])) {
			$errors[] = 'Invalid Primary Phone Number: acceptable formats are 1112223333 or 111-222-3333';
		}

		if(!has_valid_phone_number($instructor['secondary_phone'])) {
			$errors[] = 'Invalid Secondary Phone Number';
		}

		if(!has_valid_email_format($instructor['email'])) {
			$errors[] = 'Invalid Email Format';
		}
		return $errors;
	}

	function validate_classes($class) {
		$errors = [];

		if(is_blank($class['name'])) {
			$errors[] = 'Class must have a name.';
		} elseif(!has_length_less_than($class['name'], 255)) {
			$errors[] = 'Class name must be less than 255 characters.';
		}

		if(is_blank($class['short_desc'])) {
			$errors[] = 'Class must have a short description';
		}

		if(is_blank($class['long_desc'])) {
			$errors[] = 'Class must have a long description';
		}

		if(is_blank($class['duration'])) {
			$errors[] = 'Class needs to have a duration';
		}

		return $errors;
	}
?>
