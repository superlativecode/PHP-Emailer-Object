<?php 
class EmailObj {
	protected $to = array();
	protected $cc = array();
	protected $bcc = array();
	protected $from;
	protected $subject;
	protected $message;
	//Possible Type Options: text and html
	protected $type = "text"; 
	protected $headers;
	
	public function getTo(){ return $this->to; }
	public function getCc(){ return $this->cc; }
	public function getBcc(){ return $this->bcc; }
	public function getFrom(){ return $this->from; }
	public function getSubject(){ return $this->subject; }
	public function getMessage(){ return $this->message; }
	public function getType(){ return $this->type; }
	public function getHeaders(){ return $this->headers; }
	
	public function setTo($val){
		$this->to[] = trim($val);
	}
	public function setCc($val){
		$this->cc[] = trim($val);
	}
	public function setBcc($val){
		$this->bcc[] = trim($val);
	}
	public function setFrom($val){
		$this->from = trim($val);
	}
	public function setSubject($val){
		$this->subject = trim($val);
	}
	public function setMessage($val){
		$this->message = trim($val);
	}
	public function setType($val){
		$this->type = trim($val);
	}
	public function setHeaders($val){
		$this->headers = trim($val);
	}
}
?>