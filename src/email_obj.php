<?php

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
	
	var $regex = '//';
	
	var $validator;
	
	var $success = true;
	
	var $errors = array();
	
	function __construct(){
		$this->validator = new FieldValidator();
	}
	
	public function setFalseRegexValue($regex){
		$this->regex = $regex;
	}
	
	public function setTo($tos){
		if(strpos($tos, ',') !== false){
			$tos = explode(',', str_replace(' ', '', $tos));
			$valid = true;
			foreach($tos as &$to){
				$valid = $this->setError($this->validator->isEmail($to), $to . ' is not a valid email address.');
				if(!($this->exists($to) && $valid)){
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
			$this->tos = array(($this->exists($tos) && $valid) ? $tos : false);
		}
		return true;
	}
	
	public function setCCs($ccs){
		if(strpos($ccs, ',') !== false){
			$ccs = explode(',', str_replace(' ', '', $ccs));
			$valid = true;
			foreach($ccs as &$cc){
				$valid = $this->setError($this->validator->isEmail($cc), $cc . ' is not a valid email address.');
				if(!($this->exists($cc) && $valid)){
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
			$this->ccs = array(($this->exists($ccs) && $valid) ? $ccs : false);
			
		}
		return true;
	}
	
	public function setBCCs($bccs){
		if(strpos($bccs, ',') !== false){
			$bccs = explode(',', str_replace(' ', '', $bccs));
			$valid = true;
			foreach($bccs as &$bcc){
				$valid = $this->setError($this->validator->isEmail($bcc), $bcc . ' is not a valid email address.');
				if(!($this->exists($bcc) && $valid)){
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
			$this->bccs = array(($this->exists($bccs) && $valid) ? $bccs : false);
			
		}
		return true;
	}

	
	public function setFrom($from){
		$valid = $this->setError($this->validator->isEmail($from), 'From field is not a valid email.');
		$this->from = ($this->exists($from) && $valid) ? $from : false;
	}
	
	public function setSubject($subject, $regex = false){
		if($regex === false){
			$regex = $this->regex;
		}
		$valid = $this->setError($this->validator->checkByRegex($subject, $regex), 'Subject field is not valid.');
		$this->subject = ($this->exists($subject) && $valid) ? $subject : false;
	}
	
	public function setMessage($message){
		$this->isHTML = false;
		$this->message = ($this->exists($message)) ? $message : false;
	}
	
	public function setHTMLMessage($html){
		$this->isHTML = true;
		$this->message = ($this->exists($html)) ? $html : false;
	}
	
	public function basicHTML($content){
		$html = "<html>";
		$html .= "<body>";
		$html .= $content;
		$html .= "</body>"; 
		$html .= "</html>";
		return $html; 
	}
	
	// UTILITIES 
	
	private function setError($valid, $msg){
		if(!$valid){
			$this->errors[] = $msg;
			$this->success = false;
		}
		return $valid;
	}
	
	private function exists($value){
		if(isset($value) && !empty($value)){
			return true;
		}else{
			return false;
		}
	}
	
	public function check($req = array('tos', 'from', 'subject', 'message')) {
		if(is_array($req)){
			foreach($req as $field){
				if($this->$field === false || !isset($this->$field)){
					$this->errors[] = 'Missing field for :: ' . $field;
					$this->success = false;
				}
			}			
		}else if(is_string($req)){
			if(!($this->$req !== false || isset($this->$req))) {
				$this->errors[] = 'Missing field for :: ' . $req;
				$this->success = false;
			}	
		}
		
		if(!$this->success && !empty($this->errors)){
			return $this->success;
		}
	}
	
	public function getErrors(){
		return $this->errors;
	}
}
?>