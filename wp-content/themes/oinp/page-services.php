<?php 
/**

 * Template Name: Service Page

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
get_header(); 
$fimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
?>

<section class="inner-banner">

    <?php

    while (have_posts()) : the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.

        if (comments_open() || get_comments_number()) :

            comments_template();

        endif;

    endwhile; // End of the loop.

    ?>

</section>

   
  <!-- slider -->
        <section class="slider-section">
            <div class="container">
                <div class="switch-tab">
                    <ul>
                    <?php if (have_rows('tab_1')) :     
					 while (have_rows('tab_1')) : the_row(); 
					 ?>
                        <li id="first-switch" class="first-switch-tab active" onClick="sliderSwitch()"><?php _ol(get_sub_field('title')); ?></li>
                       <?php
						endwhile;
						endif; 
						?>
                        <?php if (have_rows('tab_2')) :     
					 while (have_rows('tab_2')) : the_row(); 
					 ?>
                        <li id="second-switch" class="second-switch-tab" onClick="sliderSwitch()"><?php _ol(get_sub_field('title')); ?></li>
                            <?php
						endwhile;
						endif; 
						?>
                    </ul>
                </div>
               
				<?php if (have_rows('tab_1')) :     
					 while (have_rows('tab_1')) : the_row(); 
					 
					 ?>
                <!-- slider 1-->
                <div id="slider1" class="slider-main">
                    <p class="h6-content"><?php _ol(get_sub_field('intro_content')); ?></p>
                    <div class="swiper swiper1">
                        <div class="swiper-wrapper">
                        <?php while (have_rows('swiper_details')) : the_row(); 
						$icon_image=get_sub_field('icon_image');
						//print_r($icon_image);
						?>
                            <div class="swiper-slide">
                                <div class="swiper-image">
                                    <div class="image">
                                        <img src="<?php echo $icon_image['url']; ?>" class="identify-icon"  alt="identify-icon" >
                                        <p class="slider-content"><?php _ol(get_sub_field('description')); ?></p>
                                    </div>
                                </div>
                            </div>
						<?php endwhile; ?>
                        </div>
                        <div class="swiper-button-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="12" viewBox="0 0 25 12"
                                fill="none">
                                <path opacity="1"
                                    d="M0.469669 5.46967C0.176777 5.76256 0.176777 6.23744 0.469669 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.469669 5.46967ZM25 5.25L1 5.25V6.75L25 6.75V5.25Z"
                                    fill="white" />
                            </svg>

                        </div>
                        <div class="swiper-button-next"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="12"
                                viewBox="0 0 25 12" fill="none">
                                <path
                                    d="M24.5303 6.53033C24.8232 6.23744 24.8232 5.76257 24.5303 5.46967L19.7574 0.696701C19.4645 0.403807 18.9896 0.403807 18.6967 0.696701C18.4038 0.989594 18.4038 1.46447 18.6967 1.75736L22.9393 6L18.6967 10.2426C18.4038 10.5355 18.4038 11.0104 18.6967 11.3033C18.9896 11.5962 19.4645 11.5962 19.7574 11.3033L24.5303 6.53033ZM-6.55671e-08 6.75L24 6.75L24 5.25L6.55671e-08 5.25L-6.55671e-08 6.75Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </div>
                </div>
						<?php
						endwhile;
						endif; 
						?>
                        <?php if (have_rows('tab_2')) :     
					 while (have_rows('tab_2')) : the_row(); 
					 
					 ?>
                <!-- slider 2-->
                <div id="slider2" class="slider-main hidden">
                    <p class="h6-content"><?php _ol(get_sub_field('intro_content')); ?></p>
                    <div class="swiper swiper2">
                        <div class="swiper-wrapper">
                            <?php while (have_rows('swiper_details')) : the_row(); 
						$icon=get_sub_field('icon');
						?>
                            <div class="swiper-slide">
                                <div class="swiper-image">
                                    <div class="image">
                                        <img src="<?php echo $icon['url']; ?>" class="identify-icon"
                                            alt="identify-icon" >
                                        <p class="slider-content"><?php _ol(get_sub_field('description')); ?></p>
                                    </div>
                                </div>
                            </div>
						<?php endwhile; ?>


                        </div>
                        <div class="swiper-button-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="12" viewBox="0 0 25 12"
                                fill="none">
                                <path opacity="1"
                                    d="M0.469669 5.46967C0.176777 5.76256 0.176777 6.23744 0.469669 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.469669 5.46967ZM25 5.25L1 5.25V6.75L25 6.75V5.25Z"
                                    fill="white" />
                            </svg>

                        </div>
                        <div class="swiper-button-next"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="12"
                                viewBox="0 0 25 12" fill="none">
                                <path
                                    d="M24.5303 6.53033C24.8232 6.23744 24.8232 5.76257 24.5303 5.46967L19.7574 0.696701C19.4645 0.403807 18.9896 0.403807 18.6967 0.696701C18.4038 0.989594 18.4038 1.46447 18.6967 1.75736L22.9393 6L18.6967 10.2426C18.4038 10.5355 18.4038 11.0104 18.6967 11.3033C18.9896 11.5962 19.4645 11.5962 19.7574 11.3033L24.5303 6.53033ZM-6.55671e-08 6.75L24 6.75L24 5.25L6.55671e-08 5.25L-6.55671e-08 6.75Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </div>
                </div>
						<?php
						endwhile;
						endif; 
						?>
            </div>
        </section>
        
        <?php if (have_rows('key_benefits')) :     
					 while (have_rows('key_benefits')) : the_row(); 
					 $main_image=get_sub_field('main_image');
					 ?>
        <!-- key benefits section -->
        <section class="key-benefits-section">
            <div class="container">


                <div class="key-benefits-main">

                    <div class="key-image-section">                       
                        <img src="<?php echo get_template_directory_uri();?>/assets/images/border-image.png" alt="key-benefits">
                        <div class="key-img-video">
                            <!-- <video autoplay muted loop playsinline preload="metadata">
                                <source src="video/loop video for benefits section.mp4" type="video/mp4">
                            </video> -->
                            <img src="<?php echo $main_image['url']; ?>" alt=" key benfits image">
                        </div>
                    </div>

                    <div class="are-tab-content">
                        <div class="tab-content-txts" id="overview">
                            <span class="tab-content-title"><?php _ol(get_sub_field('title')); ?></span>

                            <div class="content-list">
                                <ol>
                                <?php while (have_rows('details')) : the_row(); 
								  ?>
                                    <li><?php _ol(get_sub_field('detail')); ?></li>
                                    <?php endwhile; ?>
                                   
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
    					<?php
						endwhile;
						endif; 
						?>


<!-- Footer section 2-->

<?php if (have_rows('contact_banner')) : ?>

    <?php

    get_template_part('template-parts/content', 'contactBanner'); ?>

<?php

endif; ?>

<?php get_footer();  ?>
