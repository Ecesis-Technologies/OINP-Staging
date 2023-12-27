<?php 
/**

 * Template Name: Contact Page

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site may use a

 * different template.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package mysite

 */
$siteKey     = '6LcNBOsjAAAAACFGmFm-8I1l78W5O0-qBV6RWXvb'; 
$secretKey     = '6LcNBOsjAAAAAJP3JePBHiow__QeN34aeaCKuT3E'; 
get_header(); 
$fimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />
        
<!-- Contact content -->
        <section class="contact-page-main">
            <div class="banner-images">
                <img src="<?php echo $fimage[0]; ?>" alt="<?php the_title(); ?>">
            </div>
            <?php if (have_rows('contact_details')) :     
     while (have_rows('contact_details')) : the_row(); 
	 //$youtube_cover_image=get_sub_field('youtube_cover_image');
	 //print_r($youtube_cover_image);
	 ?>   
            <div class="gradient-outer">

                <img src="<?php echo get_template_directory_uri();?>/assets/images/faq-bg-image.png" class="faq-bg-left" alt="gradient-backgroubnd">
                <img src="<?php echo get_template_directory_uri();?>/assets/images/right-gradient-outer.png"  class="faq-bg-right" alt="gradient-background">
                <h3 class="h3-titles"><?php _ol(get_sub_field('title')); ?></h3>
                <span class="h3-content"><?php _ol(get_sub_field('sub_title')); ?></span>
                <div class="container">
                <?php 
// Include form submission script 
include_once 'contact-submit.php'; 
?>
                    <div class="main-contact-inner">
                        <div class="contact-form-main">
                        <form action="" method="post" class="form-contact"">
                            
                            <div class="input-section">
                                <input type="text" id="fname" name="fname" class="form-input"
                                    placeholder="<?php echo __( 'First Name', 'oinp' ); ?>" value="<?php echo !empty($postData['fname'])?$postData['fname']:''; ?>" required="">

                                <input type="text" id="lname" name="lname" class="form-input"
                                    placeholder="<?php echo __( 'Last Name', 'oinp' ); ?>" value="<?php echo !empty($postData['lname'])?$postData['lname']:''; ?>" required="">
                            </div>
                            <div class="input-section">
                                <input type="email" id="email" name="email" class="form-input" placeholder="<?php echo __( 'Email', 'oinp' ); ?>" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" required="">
                                    <input type="hidden"  id="code" name ="code" value="+91" >                                   
                                <input type="number" id="phone" name="phone" class="form-input" placeholder="<?php echo __( 'Phone', 'oinp' ); ?>" value="<?php echo !empty($postData['phone'])?$postData['phone']:''; ?>" required="">
                                
                                
                            </div>
                            <div class="input-section">
                                <select id="job-title" name="job-title" class="form-input job-title" value="<?php echo !empty($postData['job-title'])?$postData['job-title']:''; ?>" required="">
                                    <option selected value=""><?php echo __( 'What is your job title?', 'oinp' ); ?></option>
                                    <option class="volvo" value="<?php echo __( 'Managing Director', 'oinp' ); ?>"><?php echo __( 'Managing Director', 'oinp' ); ?></option>
                                    <option value="<?php echo __( 'Executive Team / C-Suite', 'oinp' ); ?>"><?php echo __( 'Executive Team / C-Suite', 'oinp' ); ?></option>
                                    <option value="<?php echo __( 'Founder', 'oinp' ); ?>"><?php echo __( 'Founder', 'oinp' ); ?></option>
                                    <option value="<?php echo __( 'Business Owner', 'oinp' ); ?>"><?php echo __( 'Business Owner', 'oinp' ); ?></option>
                                    <option value="<?php echo __( 'Management Team', 'oinp' ); ?>"><?php echo __( 'Management Team', 'oinp' ); ?></option>
                                    <option value="<?php echo __( 'Immigration Agent', 'oinp' ); ?>"><?php echo __( 'Immigration Agent', 'oinp' ); ?></option>
                                    <option value="<?php echo __( 'Other', 'oinp' ); ?>"><?php echo __( 'Other', 'oinp' ); ?></option>
                                </select>
                                <input type="text" id="company" name="company" class="form-input" placeholder="<?php echo __( 'Company Name', 'oinp' ); ?>" value="<?php echo !empty($postData['company'])?$postData['company']:''; ?>" required="">
                                <!-- <select id="country" name="country" class="form-input country">
                                    <option class="select-option" selected><?php echo __( 'Country', 'oinp' ); ?></option>
                                    <option value="volvo"><?php echo __( 'Volvo', 'oinp' ); ?></option>
                                    <option value="saab"><?php echo __( 'Saab', 'oinp' ); ?></option>
                                    <option value="mercedes"><?php echo __( 'Mercedes', 'oinp' ); ?></option>
                                    <option value="audi"><?php echo __( 'Audi', 'oinp' ); ?></option>
                                </select> -->
                            </div>
                            <select id="interest" name="interest" class="form-input-interest" value="<?php echo !empty($postData['interest'])?$postData['interest']:''; ?>" required="">
                                <option class="select-option" value="" selected><?php echo __( 'Please indicate your interest', 'oinp' ); ?></option>
                                <option value="<?php echo __( 'I am an International Entrepreneur', 'oinp' ); ?>"> <?php echo __( 'I am an International Entrepreneur', 'oinp' ); ?></option>
                                <option value="<?php echo __( 'I am a Business Owner in Canada', 'oinp' ); ?>"><?php echo __( 'I am a Business Owner in Canada', 'oinp' ); ?></option>
                                <option value="<?php echo __( 'I am an Immigration Agent', 'oinp' ); ?>"> <?php echo __( 'I am an Immigration Agent', 'oinp' ); ?></option>
                                <option value="<?php echo __( 'Other', 'oinp' ); ?>"><?php echo __( 'Other', 'oinp' ); ?></option>
                            </select>

                            <textarea id="message" name="message" class="form-input-message"
                                placeholder="Message" value="<?php echo !empty($postData['message'])?$postData['message']:''; ?>" required="" ></textarea>
                                <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>" style="margin-top: 15px;"></div>
                            <div class="btn-submit-section">
                                <div class="check-submit">
                                    <input type="checkbox" id="privacy-policy" required="">
                                    <label class="privacy-policy" for="privacy-policy"> <?php echo __( 'I agree to the', 'oinp' ); ?> <a href="<?php echo get_permalink( get_page_by_path( 'privacy-policy' ) ); ?>" target="_blank"><?php echo __( 'privacy policy', 'oinp' ); ?></a>
                                    </label>
                                </div>
                                <input type="submit" name="submit"  class="submit-btn" value="<?php echo __( 'Submit', 'oinp' ); ?>">
                                <!-- <button type="submit" class="submit-btn" value="submit"><span
                                        class="submit-text"><?php echo __( 'Submit', 'oinp' ); ?></span> <img src="<?php echo get_template_directory_uri();?>/assets/images/submit-arrow.png"
                                        class="white-arrow" alt="white-arrow">
                                </button> -->
                            </div>
                        </form>
                        </div>
                        <div class="contact-section2">
                            <div class="location-section">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/location-icon.png" class="contact-icon" alt="location-icon">
                                <div class="location-text">
                                    <?php _ol(get_sub_field('location_details')); ?>
                                    <h5 class="h6-titles">
                                    <a href="<?php _ol(get_sub_field('direction_link')); ?>" target="_blank">
                                        <?php echo __( 'Get Direction', 'oinp' ); ?>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="phone-section">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/phone-icon.svg" class="phone-icon" alt="phone-icon">
                                <div class="location-text">
                                    <?php _ol(get_sub_field('contact_details')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <?php
        endwhile;
   		endif; 
		?> 
            
        </section>
    
    


<!-- Footer section 2-->

<?php /*?><?php if (have_rows('contact_banner')) : ?>

    <?php

    get_template_part('template-parts/content', 'contactBanner'); ?>

<?php

endif; ?><?php */?>

<?php get_footer();  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<script>
$("form").submit(function() {
	var instance = $("#phone");
instance.intlTelInput();
//alert(instance.intlTelInput('getSelectedCountryData').dialCode);
$("#code").val("+"+instance.intlTelInput('getSelectedCountryData').dialCode);
});
        $("#phone").intlTelInput({
	initialCountry: "in",
	separateDialCode: true,
});
    </script>