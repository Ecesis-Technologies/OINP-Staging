<?php 
// Google reCAPTCHA API key configuration 
$siteKey     = '6LcNBOsjAAAAACFGmFm-8I1l78W5O0-qBV6RWXvb'; 
$secretKey     = '6LcNBOsjAAAAAJP3JePBHiow__QeN34aeaCKuT3E'; 
 
// Email configuration 
// $recipients = array('info@futureisontario.com','ecapindia@gmail.com'); //to email
$recipients = array('sivapriyaece256@gmail.com', 'sivapriyathiru256@gmail.com');
$fromName = 'OINP'; 
$fromEmail = 'info@futureisontario.com'; //from email
 
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
    $range = trim($_POST['range']); 
    $experience = trim($_POST['experience']); 
    $type = trim($_POST['type']); 
    $i_am_on = trim($_POST['radio-button']);
    $looking_for= "";

    if($i_am_on == 1)
        $i_am_on="An International Entrepreneur";
    else if($i_am_on == 2)
        $i_am_on="A Domestic Business Owner";

    if($i_am_on=="An International Entrepreneur")
        $looking_for="Investment/Buying a Business";
    else if($i_am_on=="A Domestic Business Owner")
        $looking_for="Selling Existing Business";

  
     
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
   
    if(empty($experience)){ 
        $valErr .= 'Please choose your business experience<br/>'; 
    } 
    if(empty($type)){ 
        $valErr .= 'Please choose your business type<br/>'; 
    } 
    // if(empty($message)){ 
    //     $valErr .= 'Please enter your message.<br/>'; 
    // } 
     
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
			$jsarray['Range']=$range;
			$jsarray['Experience']=$experience;
			$jsarray['Type']=$type;
			$jsarray['Iamon']=$i_am_on;
			$jsarray['Lookingfor']=$looking_for;
			$tjson = json_encode($jsarray);
			$msg_pres = curl_json_contents("https://flow.zoho.com/805703817/flow/webhook/incoming?zapikey=1001.6fdbc95d85f05a971850f240a60b2746.910663213cc68b29d7baaceb5888f7d4&isdebug=false", $tjson);
 
                // Send email notification to the site admin 
                $subject = 'New contact request received from home page form'; 
                $htmlContent = " 
                    <h2>Contact Request Details</h2> 
                    <p><b>I’am: </b>".$i_am_on."</p> 
                    <p><b>Looking For: </b>".$looking_for."</p> 
                    <p><b>Business Type: </b>".$type."</p> 
                    <p><b>Business Experience: </b>".$experience."</p> 
                    <p><b>Personal Net Worth: </b>".$range."</p> 
                    <p><b>Name: </b>".$fname." ".$lname."</p> 
                    <p><b>Email: </b>".$email."</p> 
                    <p><b>Mobile No: </b>".$mobileno."</p>                                      
                "; 

                // Always set content-type when sending HTML email 
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                // More headers 
                $headers .= 'From:'.$fromName.' <'.$fromEmail.'>' . "\r\n"; 
                 
                // Send email 
                // mail($toEmail, $subject, $htmlContent, $headers); 
                foreach ($recipients as $toEmail) {
                   mail($toEmail, $subject, $htmlContent, $headers);
   
                }
                 
                $status = 'success'; 
                $statusMsg = '<div style="color:green;" class="err-msg">Thank you! Your contact request has submitted successfully, we will get back to you soon.</div>'; 
                $postData = ''; 
            }else{ 
                $statusMsg = '<div style="color:red;" class="err-msg">Captcha verification failed, please try again.</div>'; 
            } 
        }else{ 
            $statusMsg = '<div style="color:red;" class="err-msg">Please check on the reCAPTCHA box.</div>'; 
        } 
    }else{ 
        $statusMsg = '<div style="color:red;" class="err-msg"><p>Please fill all the mandatory fields:</p>'.trim($valErr, '<br/>')."</div>"; 
    } 
}

// Display status message 
// echo $statusMsg;
// header('Location: https://staging2.futureisontario.com/rewamp/#top');
