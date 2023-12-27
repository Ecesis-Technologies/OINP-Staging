<?php 
// Google reCAPTCHA API key configuration 
$siteKey     = '6LcNBOsjAAAAACFGmFm-8I1l78W5O0-qBV6RWXvb'; 
$secretKey     = '6LcNBOsjAAAAAJP3JePBHiow__QeN34aeaCKuT3E'; 
 
// Email configuration 
$toEmail = 'info@futureisontario.com'; //to email
$fromName = 'OINP'; 
$fromEmail = 'noreply@futureisontario.com'; //from email
 
$postData = $statusMsg = $valErr = ''; 
$status = 'error'; 

function curl_json_contents($url,$data)
{
	$lan = 'en';
    $ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data),
	'Accept-Language:' .$lan)                                                                       
);
$result = curl_exec($ch);
return $result;

}
 
// If the form is submitted 
if(isset($_POST['submit'])){ 
    // Get the submitted form data 
    $postData = $_POST; 
    $fname = trim($_POST['fname']); 
    $lname = trim($_POST['lname']); 
    $email = trim($_POST['email']); 
    $mobileno = trim($_POST['mobileno']); 
    $interest = trim($_POST['interest']); 
   
     
    // Validate form fields 
    if(empty($fname)){ 
        $valErr .= 'Please enter your first name.<br/>'; 
    } 
    if(empty($lname)){ 
        $valErr .= 'Please enter your last name.<br/>'; 
    } 
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
        $valErr .= 'Please enter a valid email.<br/>'; 
    } 
    if(empty($mobileno)){ 
        $valErr .= 'Please enter your mobile no.<br/>'; 
    } 
    if(empty($interest)){ 
        $valErr .= 'Please choose your interest<br/>'; 
    } 
     
    if(empty($valErr)){ 
         
        // Validate reCAPTCHA box 
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
 
            // Verify the reCAPTCHA response 
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
             
            // Decode json data 
            $responseData = json_decode($verifyResponse); 
             
            // If reCAPTCHA response is valid 
            if($responseData->success){ 
 
 
 			$jsarray=array();
			$jsarray['FirstName']=$fname; 
			$jsarray['LastName']=$lname; 
			$jsarray['Email']=$email;
			$jsarray['Mobile']=$mobileno;
			$jsarray['Interest']=$interest;
			$tjson = json_encode($jsarray);
			$msg_pres = curl_json_contents("https://flow.zoho.com/805703817/flow/webhook/incoming?zapikey=1001.6fdbc95d85f05a971850f240a60b2746.910663213cc68b29d7baaceb5888f7d4&isdebug=false", $tjson);
 
 
 
 
                // Send email notification to the site admin 
                $subject = 'New request received from LP page form'; 
                $htmlContent = " 
                    <h2>Contact Request Details</h2> 
                    <p><b>Name: </b>".$fname." ".$lname."</p> 
                    <p><b>Email: </b>".$email."</p> 
                    <p><b>Mobile No: </b>".$mobileno."</p>    
                    <p><b>Interested In: </b>".$interest."</p>                                   
                "; 
                 
                // Always set content-type when sending HTML email 
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                // More headers 
                $headers .= 'From:'.$fromName.' <'.$fromEmail.'>' . "\r\n"; 
                 
                // Send email 
                mail($toEmail, $subject, $htmlContent, $headers); 
                 
                $status = 'success'; 
                $statusMsg = '<div style="color:green;">Thank you! Your contact request has submitted successfully, we will get back to you soon.</div>'; 
                $postData = ''; 
            }else{ 
                $statusMsg = '<div style="color:red;">Captcha verification failed, please try again.</div>'; 
            } 
        }else{ 
            $statusMsg = '<div style="color:red;">Please check on the reCAPTCHA box.</div>'; 
        } 
    }else{ 
        $statusMsg = '<div style="color:red;"><p>Please fill all the mandatory fields:</p>'.trim($valErr, '<br/>')."</div>"; 
    } 
}

// Display status message 
echo $statusMsg;