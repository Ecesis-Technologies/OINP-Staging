<?php 

/**

 * Langauage switcher

 * @return String Swith language link

 */

function site_switch_language(){

	if(class_exists('WPGlobus')){

		global $post;

		$sl = (WPGlobus::Config()->language=='en')?'fr':'en';

		

		if(isset($post->ID) AND !is_404()){

			$url = get_permalink( $post->ID );

		}else{

			$url = site_url();

		}

		$link = esc_url( WPGlobus_Utils::localize_url($url,$sl) );

		if($sl == 'fr'){

			echo '<div><a href="'.$link.'">English</a></div><div><a href="'.$link.'">French</a></div>';

		}else{

			echo '<div><a href="#">French</a></div><div><a href="'.$link.'">English</a></div>';

		}

	}

}



/**

 * Language attribute

 * @return String

 */

function site_language_attributes(){

	if(class_exists('WPGlobus')){

		echo $attribute = (WPGlobus::Config()->language=='en')?'lang="en-US"':'lang="fr"';

	}

}



/**

 * Language attribute

 * @return String

 */

function site_cuttent_language(){

	if(class_exists('WPGlobus')){

		echo $attribute = (WPGlobus::Config()->language=='en')?'English':'French';

	}

}



/**

 * language handle

 * @return String post value or dafault value

 */

function _ol($key,$print=true){

	if($print){

		_e($key,'oinp');

	}else{

		return __($key,'oinp');

	}

}

/**

 * language handle

 * @return String post value or dafault value

 */

function _el($key){

	return __($key,'oinp');

}

/**

 * Print active menu

 * @param  String $slug Page Slug

 * @return [type] [description]

 */

function site_getactivemenu($id,$checkparent=true) {

    global $post;

    if($checkparent){

    	if (is_page( $id ) OR $post->post_parent == $id) {

    	    echo 'active';

    	}

    }else{

    	if (is_page( $id )) {

    	    echo 'active';

    	}

    }

}



add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );


$siteKey     = '6LcNBOsjAAAAACFGmFm-8I1l78W5O0-qBV6RWXvb'; 
$secretKey     = '6LcNBOsjAAAAAJP3JePBHiow__QeN34aeaCKuT3E'; 



/*add_action('init', 'contactform_func');
function contactform_func(){
	error_reporting(0);
	global $wpdb;
    if($_POST['fname']!="" && $_POST['lname']!="" && $_POST['email']!="" && $_POST['phone']!="" && $_POST['job-title']!="" && $_POST['company']!=""  && $_POST['interest']!=""  && $_POST['message']!=""  && $_POST['g-recaptcha-response']!=""  && isset($_POST)){
	//unset($_POST['contact-grecaptcha']);
	//unset($_POST['g-recaptcha-response']);
	$from_mail=array('info@futureisontario.com'=>'OINP','ecapindia@gmail.com' => 'Ecap');
	$admin_name='OINP';
	$site_name='OINP';
  
	$adminbodylayout   = '
	<table width="80%" border="0" cellpadding="5" style="border:solid 1px #F00;">
  <tr>
    <td align="center" valign="top">
	<table width="70%" border="0" cellpadding="5">
  <tr>
    <td bgcolor="#efefef">Name</td>
    <td bgcolor="#efefef">'.$_POST['Name'].'</td>
  </tr>
  <tr>
    <td bgcolor="#efefef">Age</td>
    <td bgcolor="#efefef">'.$_POST['Age'].'</td>
  </tr>
  <tr>
    <td bgcolor="#efefef">Gender</td>
    <td bgcolor="#efefef">'.$_POST['Gender'].'</td>
  </tr>
  <tr>
    <td bgcolor="#efefef">Mobile</td>
    <td bgcolor="#efefef">'.$_POST['Mobile'].'</td>
  </tr>
  <tr>
    <td bgcolor="#efefef">Address</td>
    <td bgcolor="#efefef">'.$_POST['Address'].'</td>
  </tr>
  <tr>
    <td bgcolor="#efefef">Comments</td>
    <td bgcolor="#efefef">'.$_POST['Comments'].'</td>
  </tr>
  
</table>
	
	</td>
  </tr>
</table>';


	$bodylayout   = '';


	$Subject    = 'Book An Appointment';
	$aheaders = array('Content-Type: text/html; charset=UTF-8',
							'From: OINP <noreply@futureisontario.com>',
						);
	$attachments = "";
	foreach($from_mail as $tomeail => $tomail_adr){
	wp_mail( $tomeail, $Subject, $adminbodylayout, $aheaders, $attachments );
	}
	//$Subject    = "Nair Contracting Website : Form Submission";
	//wp_mail( $_POST['uemail'], $Subject, $bodylayout, $aheaders, $attachments );
	
	//$table=$wpdb->prefix.'formdata';
	//$mdata=array();
	//$mdata['form_data']=serialize($_POST);
	//$mdata['form_type']=1;
	//$mdata['submitted_date']=date('Y-m-d');
	//$wpdb->insert( $table, $mdata);
	//$redirectlink = get_permalink( get_page_by_path( 'contact' ) );
	wp_redirect($redirectlink."?succ=1");
	//wp_redirect(site_url()."/contact/success/");
	exit;
	}
}*/


function mobilecheck(){ 
	$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	return 1;	
}
else{
	return 0;
}
}