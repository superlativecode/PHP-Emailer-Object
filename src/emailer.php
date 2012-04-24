<?php

function debug($shit){
	echo "<pre>";
	echo var_export($shit, true);
	echo "</pre>";
}

/*
		$to      = 'nobody@example.com';
		$subject = 'the subject';
		$message = 'hello';
		$headers = 'From: webmaster@example.com' . "\r\n" .
    			   'Reply-To: webmaster@example.com' . "\r\n" .
    			    'X-Mailer: PHP/' . phpversion();
*/

class Emailer extends EmailObj  {
	var $testMode = false;
	
	var $fork = false;
	
	
	public function setTestMode($testMode){
		if($testMode){
			echo "in test mode";
		}
		$this->testMode = $testMode;
	}
	
	public function setFork($bool){
		if($bool){
			if(!function_exists('pcntl_fork')){
				throw new Exception('Forking is not allowed by your server. Run PHP as CGI module or set the fork value to false.');
			}
		}
		$this->fork = $bool;
	}
	
	public function send(){
		foreach($this->tos as $to){
			$success = $this->sendMail($to);
			if(!$success){
				return false;
			}
		}
		return true;
	}
	
	private function sendMail($to){
		if($this->fork){
			$pid = pcntl_fork();
			if ($pid == -1) {
			     die('could not fork');
			} else if ($pid) {
			     // we are the parent
			     pcntl_wait($status); //Protect against Zombie children
			} else {
			     // we are the child
			     return (!$this->success || $this->testMode) ? false : mail(
					$to, 
					$this->subject, 
					$this->message, 
					$this->buildHeader()
				);
			}
		}else{
			return (!$this->success || $this->testMode) ? false : mail(
				$to, 
				$this->subject, 
				$this->message, 
				$this->buildHeader()
			);
		}

	}
	
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