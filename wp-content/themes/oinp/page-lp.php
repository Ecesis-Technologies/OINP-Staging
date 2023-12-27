<?php



/**

 * Template Name: LP Page

 *

 * This is the template for LP page.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package OINP

 */
// $siteKey     = '6LcNBOsjAAAAACFGmFm-8I1l78W5O0-qBV6RWXvb'; 
// $secretKey     = '6LcNBOsjAAAAAJP3JePBHiow__QeN34aeaCKuT3E'; 
?>

<?php get_header(); ?>

<?php //$secHero = get_field('lp_hero'); ?>

<?php if (have_rows('lp_home_banner')) :
    while (have_rows('lp_home_banner')) : the_row(); 
    $desktop_image=get_sub_field('lp_desktop_image');
    $mobile_image=get_sub_field('lp_mobile_image');
    ?>
        <section class="banner lp-banner">
            <div class="banner-inner ">
                <div class="banner-item">
                    <div class="banner-images">
                    <img src="<?php echo $desktop_image['url']; ?>" class="desk-banner" alt="<?php _ol(get_sub_field('lp_title')); ?>">
                    <img src="<?php echo $mobile_image['url']; ?>" class="mobile-banner" alt="<?php _ol(get_sub_field('lp_title')); ?>">
                    </div>
                    <div class="container">
                        <h1 class="h1-titles"><?php _ol(get_sub_field('lp_title')); ?></h1>
                        <p class="banner-cnt"><?php _ol(get_sub_field('lp_content')); ?></p>
                        <a href="<?php _ol(get_sub_field('lp_link')); ?>" target="_blank" class="banner-learn color-blue">
                            <span><?php _ol(get_sub_field('lp_link_label')); ?></span>
                            <img src="<?php _ol(get_template_directory_uri()); ?>/assets/images/white-arow.svg" alt="arrow-icon">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php
    endwhile;
endif; ?>

<section class="start-business">
    <div class="container">
        <div class="business-in">
            <?php if (have_rows('lp_build_business')) :
                while (have_rows('lp_build_business')) : the_row(); ?>
                    <div class="business-content">
                    <h2 class="h1-titles"><?php _ol(get_sub_field('lp_sub_title')); ?></h2>
                    <div class="business-texts"><?php _ol(get_sub_field('lp_description')); ?></div>
                    </div>
                <?php
                endwhile;
            endif; ?>
			<div class="business-form">
				 <div class="busines-form-box">
			       <?php echo do_shortcode('[wpforms id="1185"]');?>
				</div>
			</div>
            
        </div>
    </div>

    <div class="business-in" id="videoEdit">
        <?php if (have_rows('lp_build_business')) :
            $video_mp4 =  get_field('lp_video'); // MP4 Field Name
            // Build the  Shortcode
            $attr =  array(
            'mp4'      => $video_mp4,
            );
            ?>
                <div id='videoLine' class="container embed-container border-line"><?php  echo wp_video_shortcode( $attr ); ?></div>
        <?php
        endif; ?>
    </div>
</section>

    <?php $secOverview = get_field('lp_overview'); ?>

    <div class="trans-bg">
        <?php if (have_rows('lp_overview')) :
        while (have_rows('lp_overview')) : the_row(); ?>
            <div class="overview lp-overview">
                <div class="container">
                    <div class="overview-in">
                        <div class="overview-map">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cms/map-gif.gif" alt="map gif file">
                        </div>
                        <div class="overview-content">
                            <h6 class="overview-sub-title"><?php _ol(get_sub_field('lp_title')); ?></h6>
                            <div class="oveview-cont">
                            <p><?php _ol(get_sub_field('lp_sub_title')); ?></p>
                            <p><?php _ol(get_sub_field('lp_description')); ?></p>
                            </div>
                            <a href="<?php _ol(get_sub_field('lp_cta_url')); ?>" class="overview-more">
                            <span><?php _ol(get_sub_field('lp_cta_label')); ?></span>
                            <img src="<?php _ol(get_template_directory_uri()); ?>/assets/images/white-arow.svg" alt="arrow-icon">
                            </a>
                        </div>
                    </div>
                </div>
        </div>
        <?php
        endwhile;
        endif; ?>
    </div>

	<section class="lp-services">
            <div class="container">
                <?php if (have_rows('lp_services')) :
                    while (have_rows('lp_services')) : the_row(); ?>
                        <div class="lp-h1-title" id='titlesec'>
                            <p class="lp-h1-title"><?php _ol(get_sub_field('lp_title')); ?></p>
							<div id="columsItems">
								
								
                                    <?php while (have_rows('lp_items')) : the_row(); 
                                        $icon=get_sub_field('lp_icon');
                                    ?>
                                        <div class="lp-service-list">
                                            <div class="lp-service-icon">
                                                <img src="<?php echo $icon['url']; ?>" alt="TBDC Sevice - chat icon">
                                            </div>
                                                <p class="lp-service-content"><?php _ol(get_sub_field('lp_description')); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                        </div>
							</div>
							
                    <?php
                    endwhile;
                endif; 
                ?>
            </div>
	</section>



	<?php if (have_rows('lp_advisor_text')) :
	  while (have_rows('lp_advisor_text')) : the_row(); ?>
		<div class="advisor">
		  <p class="advisor-texts"><?php _ol(get_sub_field('lp_title')); ?></p>
		  <span class="advisor-icon">
			<a href="<?php _ol(get_sub_field('lp_cta_url')); ?>">
			  <span><?php _ol(get_sub_field('lp_cta_label')); ?></span>
			  <!--<img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-arow.svg" alt="advisor more icon">-->
			  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">
				<path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#fff"></path>
			  </svg>
			</a>
		  </span>
		</div>
	<?php
	endwhile;
	endif; ?>




<?php get_footer();  ?>