<?php
//Created and Copyrighted By Superlative Code 2012 (OpenSource)
//Visit http://superlativecode.com/

class Emailer {

	//If in test mode, emails will not be sent
	var $testMode = false;
	
	public function getTestMode(){ return $this->testMode; }
	
	//Set test mode value
	public function setTestMode($testMode){
		if($testMode){
			//Put code in here to be notified if the email object is in test mode
		}
		$this->testMode = $testMode;
	}
	
	
	//Public send function
	public function send($obj){
		$to = $obj->getTo();
		$cc = $obj->getCc();
		$bcc = $obj->getBcc();
		$from = $obj->getFrom();
		$subject = $obj->getSubject();
		$message = $obj->getMessage();
		//Possible Type Options: text and html
		$type = $obj->getType(); 
		$customHeaders = $obj->getHeaders();
		
		$headers = 'From: ' . $from. "\r\n";
    	if($type == 'html'){
    		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 			    
    	}else{
    		$headers .= "Content-type: text/plain; charset=ISO-8859-1\r\n"; 
    	}
    	
    	//Insert Custom Headers From Email Object
    	$headers .= $customHeaders;
    	
    	if(isset($cc) && !empty($cc) && !is_null($cc)){
			$i = 1;
    		$headers .= "CC: ";
    		foreach($cc as $_cc){
    			$headers .= "".$_cc."";
    			if($i != count($cc)){
    				$headers .= ",";
    			}
    			
    			$i++;
    		}
    		$headers .= "\r\n";
    	}
    	
    	if(isset($bcc) && !empty($bcc) && !is_null($bcc)){
			$i = 1;
    		$headers .= "BCC: ";
    		foreach($bcc as $_bcc){
    			$headers .= "".$_bcc."";
    			if($i != count($bcc)){
    				$headers .= ",";
    			}
    			$i++;
    		}
    		$headers .= "\r\n";
    	}
    	
    	
    	$headers .= 'X-Mailer: PHP/' . phpversion(). "\r\n";
    	
    	$success = true;
    	//SEND THE EMAIL(S)
    	foreach($to as $_to){
	    	$success = ($this->testMode) ? false : mail(
				$_to, 
				$subject, 
				$message, 
				$headers
			);
		}
		
		return $success;
	}

}
?>