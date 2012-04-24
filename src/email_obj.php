<?php
//Created and Copyrighted By Superlative Code 2012 (OpenSource)
//Visit http://superlativecode.com/

require_once('validate_fields.php');

class EmailObj {
	var $tos;
	var $ccs;
	var $bccs;
	var $from;
	var $subject;
	var $message;
	var $isHTML = false;
	var $headers;
	//Default Refex Statement
	var $regex = '//';
	
	var $validator;
	
	var $success = true;
	
	var $errors = array();
	
	function __construct(){
		//Insatiate Email Object
		$this->validator = new FieldValidator();
	}
	
	//If Regex paramter is set to false in function then use this regex statement
	public function setFalseRegexValue($regex){
		$this->regex = $regex;
	}
	
	//Set To Field and validate each email
	//Can have multiple, just separate by commas
	public function setTo($tos){
		if(strpos($tos, ',') !== false){
			$tos = explode(',', str_replace(' ', '', $tos));
			$valid = true;
			foreach($tos as &$to){
				$valid = $this->setError($this->validator->isEmail($to), $to . ' is not a valid email address.');
				if(!($this->validator->isReq($to) && $valid)){
					$to = false;
					$valid = false;
				}
			}
			
			if($valid){
				$this->tos = $tos;
			}else{
				$this->tos = false;
			}
			
		}else{
			$valid = $this->setError($this->validator->isEmail($tos), 'To field is not a valid email.');
			$this->tos = array(($this->validator->isReq($tos) && $valid) ? $tos : false);
		}
		return true;
	}
	
	//Set CCs Field and validate each email
	//Can have multiple, just separate by commas
	public function setCCs($ccs){
		if(strpos($ccs, ',') !== false){
			$ccs = explode(',', str_replace(' ', '', $ccs));
			$valid = true;
			foreach($ccs as &$cc){
				$valid = $this->setError($this->validator->isEmail($cc), $cc . ' is not a valid email address.');
				if(!($this->validator->isReq($cc) && $valid)){
					$cc = false;
					$valid = false;
				}
			}
			
			if($valid){
				$this->ccs = $ccs;
			}else{
				$this->ccs = false;
			}
			
		}else{
			$valid = $this->setError($this->validator->isEmail($ccs), 'To field is not a valid email.');
			$this->ccs = array(($this->validator->isReq($ccs) && $valid) ? $ccs : false);
			
		}
		return true;
	}
	
	//Set BCCs Field and validate each email
	//Can have multiple, just separate by commas
	public function setBCCs($bccs){
		if(strpos($bccs, ',') !== false){
			$bccs = explode(',', str_replace(' ', '', $bccs));
			$valid = true;
			foreach($bccs as &$bcc){
				$valid = $this->setError($this->validator->isEmail($bcc), $bcc . ' is not a valid email address.');
				if(!($this->validator->isReq($bcc) && $valid)){
					$bcc = false;
					$valid = false;
				}
			}
			
			if($valid){
				$this->bccs = $bccs;
			}else{
				$this->bccs = false;
			}
			
		}else{
			$valid = $this->setError($this->validator->isEmail($bccs), 'To field is not a valid email.');
			$this->bccs = array(($this->validator->isReq($bccs) && $valid) ? $bccs : false);
			
		}
		return true;
	}

	//Set From Field and validate it
	public function setFrom($from){
		$valid = $this->setError($this->validator->isEmail($from), 'From field is not a valid email.');
		$this->from = ($this->validator->isReq($from) && $valid) ? $from : false;
	}
	
	//Set From Field and validate it by the default regex statement
	public function setSubject($subject, $regex = false){
		if($regex === false){
			$regex = $this->regex;
		}
		$valid = $this->setError($this->validator->checkByRegex($subject, $regex), 'Subject field is not valid.');
		$this->subject = ($this->validator->isReq($subject) && $valid) ? $subject : false;
	}
	
	//Set Message in Plain Text
	public function setMessage($message){
		$this->isHTML = false;
		$this->message = ($this->validator->isReq($message)) ? $message : false;
	}
	
	//Set Message in HTML
	public function setHTMLMessage($html){
		$this->isHTML = true;
		$this->message = ($this->validator->isReq($html)) ? $html : false;
	}
	
	//Use basic HTML Structure
	public function basicHTML($content){
		$html = "<html>";
		$html .= "<body>";
		$html .= $content;
		$html .= "</body>"; 
		$html .= "</html>";
		return $html; 
	}
	
	// UTILITIES 
	
	// Set error with message
	private function setError($valid, $msg){
		if(!$valid){
			$this->errors[] = $msg;
			$this->success = false;
		}
		return $valid;
	}
	
	// Get Error message array
	public function getErrors(){
		return $this->errors;
	}
	
	//Check to see if the default fields for sending emails exist
	public function check($req = array('tos', 'from', 'subject', 'message')) {
		if(is_array($req)){
			foreach($req as $field){
				if($this->$field === false || !isset($this->$field)){
					$this->setError(false, 'Missing field for :: ' . $field);
				}
			}			
		}else if(is_string($req)){
			if(!($this->$req !== false || isset($this->$req))) {
				$this->setError(false, 'Missing field for :: ' . $field);
			}	
		}
		
		if(!$this->success && !empty($this->errors)){
			return $this->success;
		}
	}
	
	
}
?>