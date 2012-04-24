<?php
//Created and Copyrighted By Superlative Code 2012 (OpenSource)
//Visit http://superlativecode.com/

class Emailer extends EmailObj  {

	//If in test mode, emails will not be sent
	var $testMode = false;
	
	//If this variable is set to true each email process will be forked
	var $fork = false;
	
	//Set test mode value
	public function setTestMode($testMode){
		if($testMode){
			//Put code in here to be notified if the email object is in test mode
			//echo "in test mode";
		}
		$this->testMode = $testMode;
	}
	
	//Set fork value and check to see if pcntl_fork is installed correctly
	public function setFork($bool){
		if($bool){
			if(!function_exists('pcntl_fork')){
				throw new Exception('Forking is not allowed by your server. Run PHP as CGI module or set the fork value to false.');
			}
		}
		$this->fork = $bool;
	}
	
	//Public send function
	public function send(){
		foreach($this->tos as $to){
			$success = $this->sendMail($to);
			if(!$success){
				return false;
			}
		}
		return true;
	}
	
	//Send Individual Emails
	private function sendMail($to){
		if($this->fork){
			//Send Email in forked Process
			$pid = pcntl_fork();
			if ($pid == -1) {
			     die('could not fork');
			} else if ($pid) {
			     // we are the parent
			     pcntl_wait($status); //Protect against Zombie children
			} else {
			     // we are the child
			     $this->mailIt($to);
			}
		}else{
			//Send email without forking
			$this->mailIt($to);
		}

	}
	
	//Mail It!
	private function mailIt($to){
		return (!$this->success || $this->testMode) ? false : mail(
			$to, 
			$this->subject, 
			$this->message, 
			$this->buildHeader()
		);
	}
	
	//Build Email Header for sending
	private function buildHeader(){
		$headers = 'From: ' . $this->from. "\r\n";
    	if($this->isHTML){
    		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 			    
    	}else{
    		$headers .= "Content-type: text/plain; charset=ISO-8859-1\r\n"; 
    	}
    	
    	if(isset($this->ccs) && !empty($this->ccs)){
			$i = 1;
    		$headers .= "CC: ";
    		foreach($this->ccs as $cc){
    			$headers .= "".$cc."";
    			if($i != count($this->ccs)){
    				$headers .= ",";
    			}
    			
    			$i++;
    		}
    		$headers .= "\r\n";
    	}
    	
    	if(isset($this->bccs) && !empty($this->bccs)){
			$i = 1;
    		$headers .= "BCC: ";
    		foreach($this->bccs as $bcc){
    			$headers .= "".$bcc."";
    			if($i != count($this->ccs)){
    				$headers .= ",";
    			}
    			
    			$i++;
    		}
    		$headers .= "\r\n";
    	}
    	
    	
    	$headers .= 'X-Mailer: PHP/' . phpversion(). "\r\n";
    	return $this->headers = $headers;		    
	}
}
?>