<?php
class FieldValidator {
	public function checkByRegex($field, $reg){
		return preg_match($reg, $field);
	}
	
	public function hasLength($field, $len){
		return strlen($field) > $len;
	}
	
	public function maxLength($field, $len){
		return strlen($field) <= $len;
	}
	
	public function lengthInRange($field, $max, $min){
		return strlen($field) > $min && strlen($field) < $max;
	}
	
	public function isEmail($field){
		return $this->checkByRegex($field, '(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})');
	}
	
	public function isNumeric($field){
		return $this->checkByRegex($field, '/[0-9]/');
	}
	
	public function isString(){
		return is_string($field);
	}
	
	public function isPhone(){
		$field = preg_replace('/(\s|\(|\)|\-|\s|\.)/', '', $field);
		return $this->isNumeric($field) && $this->hasLength($field, 7);
	}
	
	public function req($field){
		return isset($field) && !empty($field);
	}
	
	public function isAlphaNumeric($field){
		return $this->checkByRegex($field, '/[a-zA-Z0-9]/');
	}
	
	public function isAplhaLower($field){
		return $this->checkByRegex($field, '/[a-z]/');
	}
	
	public function isAplhaUpper($field){
		return $this->checkByRegex($field, '/[A-Z]/');
	}
}
?>