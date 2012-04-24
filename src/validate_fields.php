<?php
class FieldValidator {
	//Check By Regex 
	public function checkByRegex($field, $regex){
		return preg_match($regex, $field);
	}
	
	//Check if string is longer than the specified length
	public function hasLength($field, $len){
		return strlen($field) > $len;
	}
	
	//Check if string is under the max length specified
	public function maxLength($field, $len){
		return strlen($field) <= $len;
	}
	
	//Check if string is with a range of the max and min variable
	public function lengthInRange($field, $max, $min){
		return strlen($field) > $min && strlen($field) < $max;
	}
	
	//Check if inputed field is a valid email
	public function isEmail($field){
		return $this->checkByRegex($field, '(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})');
	}
	
	//Check if the field is numeric (0-9)
	public function isNumeric($field){
		return $this->checkByRegex($field, '/[0-9]/');
	}
	
	//Check if the field is a string
	public function isString($field){
		return is_string($field);
	}
	
	//Check if the field is a phone number
	public function isPhone($field){
		$field = preg_replace('/(\s|\(|\)|\-|\s|\.)/', '', $field);
		return $this->isNumeric($field) && $this->hasLength($field, 7);
	}
	
	//Check if the field is required
	public function req($field){
		return isset($field) && !empty($field);
	}
	
	//Check if the field Alpha Numeric
	public function isAlphaNumeric($field){
		return $this->checkByRegex($field, '/[a-zA-Z0-9]/');
	}
	
	//Check if Alpha String is lower case
	public function isAplhaLower($field){
		return $this->checkByRegex($field, '/[a-z]/');
	}
	
	//Check if Alpha String is upper case
	public function isAplhaUpper($field){
		return $this->checkByRegex($field, '/[A-Z]/');
	}
}
?>