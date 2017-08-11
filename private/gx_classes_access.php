<?php
	//Classes
	function find_all_classes($options=[]) {
		global $db;

		$sql  = "SELECT * FROM classes ";
		$sql .= "ORDER BY type ASC, name ASC";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

	function find_class_by_id($id, $options=[]) {
		global $db;

		$sql  = "SELECT * FROM classes ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$class = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $class;
	}

	function find_class_by_name($name, $options=[]) {
		global $db;

		$sql  = "SELECT * FROM classes ";
		$sql .= "WHERE name='" . db_escape($db, $name) . "'";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		$class = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $class;
	}

	function find_classes_with_levels() {
		global $db;

		$sql  = "SELECT classes.name, class_level.name ";
		$sql .= "FROM classes, class_levels, class_with_levels ";
		$sql .= "WHERE classes.id = class_with_levels.class_id ";
		$sql .= "AND class_levels.id = class_with_levels.level_id";

		$result = mysqli_query($db, $sql);
		confirm_result_set($result);
		return $result;
	}

?>
