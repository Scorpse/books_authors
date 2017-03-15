<?php

abstract class BasicModel
{
	protected $link;
	protected $db;

	protected $field_validation = [];


	public function __construct($id = null)
	{
		$db = $this->db = Database::getInstance();
		$this->link = $db->getConnection();

		
	}

	public function __get($var) {
		if (isset($this->$var)) {
			return $this->$var;
		}
		return null;
	}

	public function __set($var,$value) {
		$this->$var = $value;
	}

	public function validateInputs(array $arr)
	{
		foreach ($this->field_validation as $field => $regex) {
			if (!(isset($arr[$field]) && preg_match($regex, $arr[$field]))) {
				throw new Exception('Invalid Field: '.$field);
			}
		}
		return true;
	}

}