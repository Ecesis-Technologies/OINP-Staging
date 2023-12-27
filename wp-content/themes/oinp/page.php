<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title('|',true,'right'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tiny-slider.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <?php wp_head(); ?>
</head>
<body>
<div class="dropdown-overlay"></div>
<header class="headroom">
    <div class="topbar black-bg">
        <div class="container wd">
            <div class="flex justify-flex-end align-center">
                <div class="language-select">
                  <?php dynamic_sidebar('language-menu'); ?>
                </div>
                <div class="font-rezier">
                    <button id="decrease-plugin-ac">A</button>
                    <button id="normal-plugin-ac">A</button>
                    <button id="increase-plugin-ac">A</button>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container wd">
            <div class="flex align-center">
                <div class="col-2">
                  <a class="header-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                    $new_header_logo = get_field('new_header_logo');
                    if( !empty( $new_header_logo ) ): ?>
                        <img src="<?php echo esc_url($new_header_logo['url']); ?>" alt="<?php echo esc_attr($new_header_logo['alt']); ?>" />
                    <?php endif; ?>
                  </a>
                </div>

                <div class="col-7 relative">
                    <button class="hamburger" type="button"><span> </span><span> </span><span></span></button>
                    <div class="header-nav-main">
                        <div class="header-main-wrapper">

                            <div class="header-nav">

                               <?php while( have_rows('new_header_menu') ) : the_row(); ?>

                                <div>
                                    <a href="<?php the_sub_field('new_header_menu_link');?>">
                                       <?php the_sub_field('new_header_menu_name');?>
                                    </a>
                                </div>

                               <?php endwhile; ?>

                            </div>

                            <div class="login-header-block">
                              <a class="button" href="<?php the_field('new_contact_us_button_link'); ?>"><?php the_field('new_contact_us_button_name'); ?></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-3 hidden-1200">
                    <div class="login-header-block"><a class="button" href="<?php the_field('new_contact_us_button_link'); ?>"><?php the_field('new_contact_us_button_name'); ?></a></div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="bottom-floating-buttons"><a id="return-to-top" href="#!">
    <svg width="24" height="30" viewbox="0 0 24 30" fill="none">
        <path d="M13.06.94a1.5 1.5 0 0 0-2.12 0l-9.547 9.545a1.5 1.5 0 1 0 2.122 2.122L12 4.12l8.485 8.486a1.5 1.5 0 1 0 2.122-2.122L13.06.94ZM13.5 30V2h-3v28h3Z"
              fill="#fff"></path>
    </svg>
</a>
    <button class="button floating-button-bottom contact-popup-trigger">
		<?php the_field('inquire_button_name') ?>
	</button>

</div>
	
<div class="form-modal-main pp">
    <div class="form-modal-block">
        <div class="modal-head flex justify-space-between">
           <h2 class="heading-small">
            <?php the_field('inquire_form_heading','option'); ?>
          </h2>
            <button class="close-modal">
                <svg width="24" height="24" viewbox="0 0 24 24" fill="none">
                    <path d="m13.41 12 4.3-4.29a1.004 1.004 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1.004 1.004 0 0 0-1.42 1.42l4.3 4.29-4.3 4.29a1 1 0 0 0 0 1.42.998.998 0 0 0 1.42 0l4.29-4.3 4.29 4.3a.999.999 0 0 0 1.42 0 1 1 0 0 0 0-1.42L13.41 12Z"
                          fill="#101010"></path>
                </svg>
            </button>
        </div>

        <div class="modal-body">

               <?php $inquire_form_shortcode = get_field('inquire_form_shortcode','option'); ?>

                <?php echo do_shortcode($inquire_form_shortcode); ?>

        </div>
		
    </div>
</div>


<div class="container ppt">
  <div class="row">
    <div class="col col-12">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php if( get_field('talk_heading','option') || get_field('talk_content','option') || get_field('talk_button','option')): ?>
<div class="footer-cta section-pad">
    <div class="container">
        <div class="text-center">
           <h2 class="heading white"><?php the_field('talk_heading','option'); ?></h2>
            <p class="white mx-auto" style="max-width:500px">
              <?php the_field('talk_content','option'); ?>
            </p>
			<div class="dld">	
			<?php $a = 1; while( have_rows('talk_button','option') ) : the_row(); ?>
                <button class="button red-button hover-white <?php echo $a; ?>" href="<?php the_sub_field('talk_button_link'); ?>">
                <?php the_sub_field('talk_button_text'); ?>
               </button>
			</div>
			<?php $a++; endwhile; ?>
			
               </div>
        </div>
</div>
<?php endif; ?>	
	
<footer class="footer-main black-bg section-pad">
    <div class="container">


        <div class="row align-center" style="display:none">
            <div class="col col-6">
              <h3 class="white mb-0"><?php the_field('subscribe_text','option'); ?></h3>
            </div>
            <div class="col col-6">
                <div class="subscibe-block relative">
                     <input type="text" placeholder="Your email">
                    <button class="button hover-white red-button" type="submit">Subscribe</button>
                </div>
            </div>
        </div>


        <div class="footer-divider" style="display:none"></div>

        <div class="row">
            <div class="col col-5">
                <div class="footer-logos">
                <a class="single-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                 <?php
                 $new_footer_logo = get_field('new_footer_logo');
                 if( !empty( $new_footer_logo ) ): ?>
                     <img src="<?php echo esc_url($new_footer_logo['url']); ?>" alt="<?php echo esc_attr($new_footer_logo['alt']); ?>" />
                 <?php endif; ?>
                </a>

                    <div class="flex">
                        <div class="single-footer-logo">
                           <?php
                           $new_ontario_logo = get_field('new_ontario_logo');
                           if( !empty( $new_ontario_logo ) ): ?>
                               <img src="<?php echo esc_url($new_ontario_logo['url']); ?>" alt="<?php echo esc_attr($new_ontario_logo['alt']); ?>" />
                           <?php endif; ?>
                        </div>

                        <div class="single-footer-logo">
                            <?php
                            $new_tbdc_logo = get_field('new_tbdc_logo');
                            if( !empty( $new_tbdc_logo ) ): ?>
                                <img src="<?php echo esc_url($new_tbdc_logo['url']); ?>" alt="<?php echo esc_attr($new_tbdc_logo['alt']); ?>" />
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <div class="footer-social flex">

                  <?php while( have_rows('new_social_info') ) : the_row(); ?>
                   <a href="<?php the_sub_field('new_social_info_link'); ?>" target="_blank" rel="noopener noreferrer">
                    <?php the_sub_field('new_social_info_icon'); ?>
                   </a>

                <?php endwhile; ?>

                </div>


            </div>

            <?php if( get_field('new_connect_heading') || get_field('new_connect_menu') ): ?>
            <div class="col col-3">
               <p class="footer-head"><?php the_field('new_connect_heading'); ?></p>
                <div class="footer-correct">

                <?php while( have_rows('new_connect_menu') ) : the_row(); ?>
                    <div class="flex single-footer-connect">
                      <?php
                      $new_connect_menu_icon = get_sub_field('new_connect_menu_icon');
                      if( !empty( $new_connect_menu_icon ) ): ?>
                          <img src="<?php echo esc_url($new_connect_menu_icon['url']); ?>" alt="<?php echo esc_attr($new_connect_menu_icon['alt']); ?>" />
                      <?php endif; ?>
                       <a href="<?php the_sub_field('new_connect_menu_link'); ?>"> <?php the_sub_field('new_connect_menu_name'); ?></a>
                    </div>
               <?php endwhile; ?>


                </div>
            </div>
           <?php endif; ?>

            <div class="col-md col-4">

                <div class="row">

                  <?php if( get_field('new_quick_heading') || get_field('new_quick_menu')  ): ?>

                    <div class="col col-6">
                     <p class="footer-head"><?php the_field('new_quick_heading'); ?></p>
                        <ul class="footer-links">

                          <?php while( have_rows('new_quick_menu') ) : the_row(); ?>
                            <li><a href="<?php the_sub_field('new_quick_menu_link'); ?>"><?php the_sub_field('new_quick_menu_name'); ?></a></li>
                           <?php endwhile; ?>

                        </ul>
                    </div>
                    <?php endif; ?>

                  <?php if( get_field('new_legal_heading') || get_field('new_legal_menu') ): ?>
                    <div class="col col-6">
                       <p class="footer-head"><?php the_field('new_legal_heading'); ?></p>

                        <ul class="footer-links">

                            <?php while( have_rows('new_legal_menu') ) : the_row(); ?>
                                <li><a href="<?php the_sub_field('new_legal_menu_link'); ?>"><?php the_sub_field('new_legal_menu_name'); ?></a></li>
                            <?php endwhile; ?>

                        </ul>
                    </div>
                   <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</footer>
	
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/accessibility.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/headroom.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js"></script>
<?php wp_footer(); ?>
</body>
</html>