# input_validator
Light-weight PHP input checker for survey, questionnaire and other forms.It allows yout to read and write custom messages on the fly.
<br/>
##Supported Verification

 * Proper name
 * Age
 * Gender
 * Civil Status
 * E-Mail Address
 * Valid Number
 * Range
 * Empty field
 * Valid length
 * Contained in set (may be used for answering a,b,c or d in a questionnaire)
 * Answer (Yes or No, True or False)
 * URI

<br/>
<br/>
##Custom Messages
##### Writing Custom Messages
```php
	<?php 
		#write age verification error
		$verification->write('ageError','Please provide valid age'); 
	?>
``` 

##### Reading Custom Messages
```php
	<?php 
		#read age verification error
		$verification->read('ageError'); 
	?>
``` 

<br/>
<br/>
##Email Validation

```php
	<?php 
		#email verification
		if($check->email(['yourEmail@email.tld','email@anotherEmail.com'])->result){
 			$verification->write('emailError','email verified!');
		}else{
			$verification->write('emailError','email  invalid!');	
		}
	?>
``` 


<br/>
<br/>
##Contained In
Check and return item if exists on the list using contained_in() function<br/>
You can use this function for filtration and detection

```php
	<?php 
		#sample email filtering
		$email_verification=email([$email,'myEmail@yahoo.com'])->contained_in(['myEmail@yahoo.com','yourEmail@gmail.com']);
		
		#returns true if one or more email contained on the list
		if($email_verification->result){
 			//your code goes here
 			//you can check the filtered items by debugging $email_verification->filtered;
		}
	?>
``` 