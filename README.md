# PHP Emailer Object

Build and send plain text and html emails using an extremely useful PHP Plugin. This repo includes:
* A PHP Emailing Object
* A Simple PHP Validation Object

It is recommended that the user have a basic knowledge of PHP objects.

# Download

### Option 1 [Using Git]:

* Open up a Terminal/Shell
* Go into application plugin directory (If it doesn't exist, create it)
    <code> $ cd /path/to/app/plugins </code>
* Clone repo into directory
    <code> $ git clone https://github.com/superlativecode/PHP-Emailer-Object </code>
	
### Option 2 [Manual Install]:

* Download zip file https://github.com/superlativecode/PHP-Emailer-Object/zipball/master
* Place item into /path/to/app/plugins

# Set Up

Require the PHP_Emailer.php file. For example,
	<code> require_once('/path/to/app/plugins/PHP_Emailer.php'); </code>

# Example

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Test File for Email Object</title>
	</head>
	<body>
		<?php require_once('PHP_Emailer.php')?>
		<?php
			//Insantiate the Main Object
			$emailer = new Emailer();
			
			//Set test mode to true to avoid any errors
			$emailer->setTestMode(true);
			
			//Set From Address
			$emailer->setFrom('peterdemartini@me.com');
			
			//Set To Address (for multiple separate them by commas)
			$emailer->setTo('superlativecode@gmail.com');
			
			//Set Optional Blind Carbon Copy Addresses (for multiple separate them by commas)
			//$emailer->setBCCs('thepeterdemartini@gmail.com, peterdemartini@me.com, cool@example.com');
			
			//Set Optional Carbon Copy Addresses (for multiple separate them by commas)
			//$emailer->setCCs('thepeterdemartini@gmail.com, peterdemartini@me.com, cool@example.com');
			
			//Set Subject
			$emailer->setSubject('Hello There');
			
			//Set Message in HTML
			//$emailer->setHTMLMessage($emailer->basicHTML('<b>What up?</b> :: <br />' . date('Y-m-d H:i:s', time())));
			
			//Set Message in Plain Text
			$emailer->setMessage('What up? :: ' . date('Y-m-d H:i:s', time()));
			
			//Check To See If Email Fields Exist
			$emailer->check();
			
			//Echo Errors to Brower
			foreach($emailer->getErrors() as $error){
				echo "ERROR :: " . $error;
				echo "<br />";
			}
			//Enable Forking -- Forking must be installed on your server for this to work
			$emailer->setFork(false);
			
			//Send email
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
	
# Support

If you have any problems post them in the issues section of the Github repo.

{SC} <a href="http://superlativecode.com/">Superlative Code</a> is currently taking on projects. So please visit our website http://superlativecode.com/ to inquire about our services.

This Github repo is Open Source but all code is copyrighted by Superlative Code &copy; 2012 