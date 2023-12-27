<?php



/**

 * Template part for displaying page content in page.php.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package oinp

 */



?>

<?php if (have_rows('contact_banner')) :

    while (have_rows('contact_banner')) : the_row(); ?>

        <section class="<?php echo (get_sub_field('theme')=='Green')?'footer-section3' : 'footer-section2'; ?>">

            <div class="container">

                <div class="footer-inner-main">

                    <div class="footer-ques-title">

                        <span class="footer2-question"><?php _ol(get_sub_field('title')); ?></span>

                    </div>

                    <div class="faq-button">

                        <?php /*?><button class="faq-banner-btn" onclick="location.href='<?php _ol(get_sub_field('cta_url')); ?>';">

                            <span class="get-started"><?php _ol(get_sub_field('cta_label')); ?></span>

                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/right-arrow.png" alt="right-arrow" />

                        </button><?php */?>
                        
                        <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="faq-banner-btn" target="<?php _ol(get_sub_field('target')); ?>">
                        <span class="get-started"><?php _ol(get_sub_field('cta_label')); ?></span>

                            <?php /*?><img src="<?php echo get_template_directory_uri(); ?>/assets/images/right-arrow.png" alt="right-arrow" /><?php */?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

            <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#000"></path>

          </svg>
                        </a>

                    </div>
                    
                    
                    
                    

                </div>

            </div>

        </section>

<?php

    endwhile;

endif; ?>