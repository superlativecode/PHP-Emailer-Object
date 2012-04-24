<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test File for Email Object</title>
</head>
<body>
	<?php require_once('PHP_Emailer.php')?>
	<?php
		$emailer = new Emailer();
		$emailer->setTestMode(true);
		$emailer->setFrom('peterdemartini@me.com');
		$emailer->setTo('superlativecode@gmail.com');
		//$emailer->setBCCs('thepeterdemartini@gmail.com, peterdemartini@me.com, cool@example.com');
		//$emailer->setCCs('thepeterdemartini@gmail.com, peterdemartini@me.com, cool@example.com');
		$emailer->setSubject('Hello There');
		//$emailer->setHTMLMessage($emailer->basicHTML('<b>What up?</b> :: <br />' . date('Y-m-d H:i:s', time())));
		$emailer->setMessage('What up? :: ' . date('Y-m-d H:i:s', time()));
		$emailer->check();
		foreach($emailer->getErrors() as $error){
			echo "ERROR :: " . $error;
			echo "<br />";
		}
		//$emailer->testOutput();
		$emailer->setFork(false);
		if($emailer->send()):
	?>
		<h1>SENT</h1>
	<?php
		else:
	?>
		<h1>NOT SENT</h1>
	<?php
		endif;
	?>
</body>
</html>