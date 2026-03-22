<?php 
if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha␂response'])): 
 //your site secret key 
 $secret = '6LdGtoMsAAAAAGwB3aOekXxfOL5wmQWyQNbUAsR4'; 
 //get verify response data 
 $verifyResponse = file_get_contents( 
 'https://www.google.com/recaptcha/api/siteverify?secret='. 
 $secret.'&response='.$_POST['g-recaptcha-response']); 
 $responseData = json_decode($verifyResponse); 
 if($responseData->success): 
 echo "<h1>YOURNAME reCAPTCHA Succeeded!</h1>"; 
 else: 
 echo "<h1>Robot verification failed, please try again.</h1>";
endif; 
else: 
 echo '<h1>Please click on the reCAPTCHA box.</h1>'; 
endif; 
?>
