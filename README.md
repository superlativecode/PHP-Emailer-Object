# PHP Emailer Object

Build and send emails using this extremely useful utility written in PHP. This utility is easy to use and fast. Feel free to customize this email tool for any use you may need. We are always taking ideas for new features, so just shoot me an email at superlativecode [at] gmail [dot] com.  This repo includes:
* A PHP Emailing Object
	* Plain Text
	* HTML
	* Custom Header Support
	* Multiple To Addresses
	* Multiple Carbon Copies
	* Multiple Blind Carbon Copies
	* Open Source
	* Test Mode
* A Simple PHP Validation Object
	* checkByRegex()
	* hasLength()
	* maxLength()
	* lengthInRange()
	* isEmail()
	* isNumeric()
	* isString()
	* isPhone()
	* isReq()
	* isAlphaNumeric()
	* isAlphaLower()
	* isAlphaUpper()

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
	<title>Test PHP Email Object by Superlative Code</title>
	</head>
	<body>
		<h1>Test PHP Email Object by Superlative Code</h1>
		<?php require_once('PHP_Emailer.php')?>
		<?php
			//Insntiate the EmailObj
			$emailObj = new EmailObj();
			
			$emailObj->setTo('example@example.com');
			$emailObj->setFrom('example@example.com');
			
			$emailObj->setSubject('Email #1');
			
			$emailObj->setCc('example@example.com');
			$emailObj->setCc('example@example.com');
			
			$emailObj->setBcc('example@example.com');	
			$emailObj->setBcc('example@example.com');
		
			$emailObj->setMessage('Simple text email with multiple BCCs and CCs.');
			
			
			var_dump($emailObj);
			
			//Insantiate the Emailer
			$emailer = new Emailer();
			
			//Send email
			if($emailer->send($emailObj)):
		?>
			<h2>SENT EMAIL #1!</h2>
		<?php
			else:
		?>
			<h2>EMAIL #1 NOT SENT :(</h2>
		<?php
			endif;
		?>
		<?php
			$validation = new Validation();
			
			$to = 'example@example.com';
			$to = $validation->isEmail($to) ? $to : false;
			
			$from = 'example@example.com';
			$from = $validation->isEmail($from) ? $from : false;
			
			$subject = 'Email #2';
			$subject = $validation->lengthInRange($subject, 50, 3) ? $subject : false;
			
			//Insntiate the EmailObj
			$emailObj2 = new EmailObj();
			
			if($to !== false){
				$emailObj2->setTo($to);
			}
			
			if($from !== false){
				$emailObj2->setFrom($from);
			}
			
			if($subject !== false){
				$emailObj2->setSubject($subject);
			}
			
			$emailObj2->setType('html');
			
			$emailObj2->setMessage('This is the second message with validation.');
			
			
			var_dump($emailObj2);
			
			//Send email
			if($emailer->send($emailObj2)):
		?>
			<h2>SENT EMAIL #2!</h2>
		<?php
			else:
		?>
			<h2>EMAIL #2 NOT SENT :(</h2>
		<?php
			endif;
		?>
	
	</body>
	</html>	
# Future Updates
* SMTP Support
* JS Validation and Integration Support
* Security Features	
	
# Support

If you have any problems post them in the issues section of the Github repo.

{SC} <a href="http://superlativecode.com/">Superlative Code</a> is currently taking on projects. So please visit our website http://superlativecode.com/ to inquire about our services.

This Github repo is Open Source but all code is copyrighted by Superlative Code &copy; 2012 