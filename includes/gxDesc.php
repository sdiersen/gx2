<?php

class gxDesc extends DatabaseObject {

	protected static $table_name = "gxdescriptions";
	protected static $db_fields = array('id', 'name', 'description');
	public $id;
	public $name;
	public $description;

	public static function createGXDesc($gxName="", $gxDesc="") {
		global $database;
		$name = $database->escaped_value($gxName);
		$description = $database->escaped_value($gxDesc);

		
	}
}