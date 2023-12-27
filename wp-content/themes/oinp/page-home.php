<?php



/**

 * Template Name: OINP Home

 *

 * This is the template for OINP Home page.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package OINP

 */
$siteKey     = '6LcNBOsjAAAAACFGmFm-8I1l78W5O0-qBV6RWXvb'; 
$secretKey     = '6LcNBOsjAAAAAJP3JePBHiow__QeN34aeaCKuT3E'; 
?>

<?php get_header(); ?>

<?php $secHero = get_field('hero'); ?>

<?php if (have_rows('home_banner')) :

  while (have_rows('home_banner')) : the_row(); 
  $desktop_image=get_sub_field('desktop_image');
  $mobile_image=get_sub_field('mobile_image');
  ?>

    <section class="banner">

      <div class="banner-inner ">

        <div class="banner-item">

          <div class="banner-images">

            <img src="<?php echo $desktop_image['url']; ?>" class="desk-banner" alt="<?php _ol(get_sub_field('title')); ?>">

            <img src="<?php echo $mobile_image['url']; ?>" class="mobile-banner" alt="<?php _ol(get_sub_field('title')); ?>">

          </div>

          <div class="container">

            <h1 class="h1-titles"><?php _ol(get_sub_field('title')); ?></h1>

            <p class="banner-cnt"><?php _ol(get_sub_field('content')); ?></p>

            <a href="<?php _ol(get_sub_field('link')); ?>" target="_blank" class="banner-learn color-blue">

              <span><?php _ol(get_sub_field('link_label')); ?></span>

              <img src="<?php _ol(get_template_directory_uri()); ?>/assets/images/white-arow.svg" alt="arrow-icon">

            </a>

          </div>

        </div>

      </div>

    </section>

<?php

endwhile;

endif; ?>

<?php $secOverview = get_field('overview'); ?>

<div class="trans-bg">

  <?php if (have_rows('overview')) :

    while (have_rows('overview')) : the_row(); ?>

      <section class="overview">

        <div class="container">

          <div class="overview-in">

            <div class="overview-map">

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cms/map-gif.gif" alt="map gif file">

            </div>

            <div class="overview-content">

              <h6 class="overview-sub-title"><?php _ol(get_sub_field('title')); ?></h6>

              <div class="oveview-cont">

                <p><?php _ol(get_sub_field('sub_title')); ?></p>

                <p><?php _ol(get_sub_field('description')); ?></p>

              </div>

              <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="overview-more">

                <span><?php _ol(get_sub_field('cta_label')); ?></span>

                <img src="<?php _ol(get_template_directory_uri()); ?>/assets/images/white-arow.svg" alt="arrow-icon">

              </a>

            </div>

          </div>

        </div>

      </section>

  <?php

  endwhile;

  endif; ?>

  <?php $secEntrepreneurs = get_field('entrepreneurs'); ?>

  <?php if (have_rows('entrepreneurs')) :

    while (have_rows('entrepreneurs')) : the_row(); ?>

      <section class="entrepreneurs">

        <div class="container">

          <div class="entrepreneurs-in">

            <?php

            if (have_rows('items')) :

              while (have_rows('items')) : the_row();
				$icon=get_sub_field('icon');
            ?>

                <div class="entrepreneur-box">

                  <span class="entre-icon">

                    <img src="<?php echo $icon['url']; ?>" alt="<?php _ol(get_sub_field('title')); ?> icon">

                  </span>

                  <div class="entre-texts">

                    <span class="entre-sub-text"><?php _ol(get_sub_field('title')); ?></span>

                    <p class="entre-main-texts"><?php _ol(get_sub_field('sub_title')); ?></p>

                    <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="entre-more">

                      <span><?php _ol(get_sub_field('cta_label')); ?></span>

                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-arrow.png" alt="arrow icon">

                    </a>

                  </div>

                </div>

            <?php

            endwhile;

            endif; ?>

          </div>

        </div>

      </section>

  <?php

  endwhile;

  endif;

  ?>

  <section class="helps">

    <div class="container">

      <div class="helps-in">

        <div class="helps-left">

          <?php if (have_rows('tbdc_helps')) :

            while (have_rows('tbdc_helps')) : the_row(); ?>

              <span class="help-cap"><?php _ol(get_sub_field('title')); ?></span>

              <h2 class="h1-titles"><?php _ol(get_sub_field('sub_title')); ?></h2>

              <p class="helps-content"><?php _ol(get_sub_field('description')); ?></p>

              <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="help-btn">

                <span><?php _ol(get_sub_field('cta_label')); ?></span>

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="arrow icon" class="help-icon-desk">

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-arrow.svg" alt="help icon" class="help-icon-mob">



              </a>

          <?php

          endwhile;

          endif; ?>

        </div>

        <div class="helps-right">

          <?php if (have_rows('tbdc_services')) :

            while (have_rows('tbdc_services')) : the_row(); ?>

              <span class="help-right-cap"><?php _ol(get_sub_field('title')); ?></span>

              <div class="help-right-tabs">

                <div class="help-tab-head">

                  <div class="entre-tabs selected"><a href="#international"><?php _ol(get_sub_field('tab_1_heading')); ?></a></div>

                  <div class="entre-tabs"><a href="#domestic"><?php _ol(get_sub_field('tab_2_heading')); ?></a></div>

                </div>

                <div class="help-tab-content">

                  <div class="tab-content-box" id="international">

                    <?php if (have_rows('tab_1_items')) :

                      while (have_rows('tab_1_items')) : the_row(); 
					  $iimage=get_sub_field('image');
					  ?>

                        <div class="service-list">

                          <div class="service-icon">

                            <img src="<?php echo $iimage['url']; ?>" alt="TBDC Sevice - chat icon">

                          </div>

                          <p class="service-content"><?php _ol(get_sub_field('description')); ?></p>

                        </div>

                    <?php

                    endwhile;

                    endif; ?>

                  </div>

                  <div class="tab-content-box" id="domestic" style="display:none;">

                    <?php if (have_rows('tab_2_items')) :

                      while (have_rows('tab_2_items')) : the_row(); 
					  $dimage=get_sub_field('image');
					  ?>

                        <div class="service-list">

                          <div class="service-icon">

                            <img src="<?php echo $dimage['url']; ?>" alt="TBDC Sevice - chat icon">

                          </div>

                          <p class="service-content"><?php _ol(get_sub_field('description')); ?></p>

                        </div>

                    <?php

                    endwhile;

                    endif; ?>

                  </div>

                </div>

              </div>

          <?php

          endwhile;

          endif; ?>

        </div>

      </div>

    </div>

  </section>

</div>

<section class="start-business">

  <div class="container">

    <div class="business-in">

      <?php if (have_rows('eligibility_criteria')) :

        while (have_rows('eligibility_criteria')) : the_row(); ?>

          <div class="business-content">

            <span class="title-cap"><?php _ol(get_sub_field('title')); ?></span>

            <h2 class="h1-titles"><?php _ol(get_sub_field('sub_title')); ?></h2>

            <div class="business-texts"><?php _ol(get_sub_field('description')); ?></div>


            <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="elig-btn">

              <span><?php _ol(get_sub_field('cta_label')); ?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#fff"></path>

              </svg>

            </a>

          </div>

      <?php

      endwhile;

      endif; ?>

      <form action="" method="post" style="width:100%">

        <div class="business-form">

          <?php

          // Include form submission script 

           include_once 'home-submit.php';

          ?>



          <div class="busines-form-box">

            <span class="form-box-title"><?php echo __( 'Eligibility requirements', 'oinp' ); ?></span>

            <div class="choose-me">

              <span class="choose-title"><?php echo __( "I'm", 'oinp' ); ?>:</span>

              <div class="choose-type">
              <input type="hidden" name="lng" value="<?php echo WPGlobus::Config()->language; ?>" />

                <?php /*?><input type="radio" id="inter1" name="radio-button" value="<?php echo __( 'An International Entrepreneur', 'oinp' ); ?>" onclick="chooselookingfor(1)"><?php */?>
                <input type="radio" id="inter1" name="radio-button" value="1" onclick="chooselookingfor(1)">

                <label for="inter1" onclick="chooselookingfor(1)"><?php echo __( 'An International Entrepreneur', 'oinp' ); ?></label>

              </div>

              <div class="choose-type">

                <?php /*?><input type="radio" id="domstk1" name="radio-button" value="<?php echo __( 'A Domestic Business Owner', 'oinp' ); ?>" onclick="chooselookingfor(2)"><?php */?>
                <input type="radio" id="domstk1" name="radio-button" value="2" onclick="chooselookingfor(2)">

                <label for="domstk1" onclick="chooselookingfor(2)"><?php echo __( 'A Domestic Business Owner', 'oinp' ); ?></label>

              </div>

            </div>

            <div class="choose-me">

              <span class="choose-title"><?php echo __( 'Looking For', 'oinp' ); ?>:</span>

              <div class="choose-type">

                <input type="radio" disabled id="inter" value="<?php echo __( 'Investment/Buying a Business', 'oinp' ); ?>" name="radio-button1">

                <label for="inter"><?php echo __( 'Investment/Buying a Business', 'oinp' ); ?></label>

              </div>

              <div class="choose-type">

                <input type="radio" disabled id="domstk" value="<?php echo __( 'Selling Existing Business', 'oinp' ); ?>" name="radio-button1">

                <label for="domstk"><?php echo __( 'Selling Existing Business', 'oinp' ); ?></label>

              </div>

            </div>

            <div class="types">

              <div class="ty-busi business">

                <span class="types-title"><?php echo __( 'Type of Business', 'oinp' ); ?></span>

                <select class="business-type" name="type" aria-label="business type select" value="<?php echo !empty($postData['type']) ? $postData['type'] : ''; ?>">

                  <!-- <option>Agriculture</option> -->

                  <option value="<?php echo __( 'Agriculture', 'oinp' ); ?>"><?php echo __( 'Agriculture', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Hospitality', 'oinp' ); ?>"><?php echo __( 'Hospitality', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Retail', 'oinp' ); ?>"><?php echo __( 'Retail', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Manufacturing', 'oinp' ); ?>"><?php echo __( 'Manufacturing', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Technology', 'oinp' ); ?>"><?php echo __( 'Technology', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Healthcare', 'oinp' ); ?>"><?php echo __( 'Healthcare', 'oinp' ); ?></option>

                  <option value="<?php echo __( 'Others', 'oinp' ); ?>"><?php echo __( 'Others', 'oinp' ); ?></option>

                </select>

              </div>

              <div class="ty-busi experiance">

                <span class="types-title"><?php echo __( 'Business Experience', 'oinp' ); ?></span>

                <select class="business-type" name="experience" aria-label="business experiance select" value="<?php echo !empty($postData['experience']) ? $postData['experience'] : ''; ?>">

                  <!-- <option>5-7 years</option> -->

                  <option value="<?php echo __( 'Under 2 years', 'oinp' ); ?>"><?php echo __( 'Under 2 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '2-5 years', 'oinp' ); ?>"><?php echo __( '2-5 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '5-7 years', 'oinp' ); ?>"><?php echo __( '5-7 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '7-10 years', 'oinp' ); ?>"><?php echo __( '7-10 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '10-15 years', 'oinp' ); ?>"><?php echo __( '10-15 years', 'oinp' ); ?></option>

                  <option value="<?php echo __( '15+ years', 'oinp' ); ?>"><?php echo __( '15+ years', 'oinp' ); ?></option>

                </select>

              </div>

            </div>

            <div class="personal">

              <div class="personal-title-box">

                <span class="title-text"><?php echo __( 'Personal Net Worth', 'oinp' ); ?> <span><?php echo __( '(Approx)', 'oinp' ); ?></span></span>

                <span class="personal-amount" id="range-slider__value"><?php echo __( '800,000', 'oinp' ); ?></span>

              </div>

              <div class="personal-amount-bar">

                <!-- <div class="amount-seeker"></div> -->

                <!-- <div class="drag-elem"></div> -->



                <input id="range-slider__range" name="range" class="amount-seeker" type="range" min="0" max="800000" value="<?php echo !empty($postData['range']) ? $postData['range'] : '0'; ?>">



              </div>

            </div>

            <a href="javascript:void(0)" class="form-btn">

              <span><?php echo __( 'Continue', 'oinp' ); ?></span>

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white-arrow.png" alt="white-arrow" class="desk-form">

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/white arrow.png" alt="white arrow" class="mob-form">

            </a>

            <!-- <input type="button" class="form-btn" aria-label="continue" value="Continue"> -->

          </div>

          <div class="busines-form-box face-back">

            <fieldset>

              <label for="firstname"><?php echo __( 'First Name', 'oinp' ); ?></label>

              <input id="firstname" type="text" name="fname" class="field-box" placeholder="<?php echo __( 'Enter your firstname', 'oinp' ); ?>" value="<?php echo !empty($postData['fname']) ? $postData['fname'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <label for="Lastname"><?php echo __( 'Last Name', 'oinp' ); ?></label>

              <input id="Lastname" type="text" name="lname" class="field-box" placeholder="<?php echo __( 'Enter your Lastname', 'oinp' ); ?>" value="<?php echo !empty($postData['lname']) ? $postData['lname'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <label for="Email"><?php echo __( 'Enter Email Id', 'oinp' ); ?></label>

              <input id="Email" type="email" name="email" class="field-box" placeholder="<?php echo __( 'Enter your Email Id', 'oinp' ); ?>" value="<?php echo !empty($postData['email']) ? $postData['email'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <label for="Mobile"><?php echo __( 'Enter Mobile Number', 'oinp' ); ?></label>

              <input id="Mobile" type="number" name="mobileno" class="field-box" placeholder="<?php echo __( 'Enter your Mobile number', 'oinp' ); ?>" value="<?php echo !empty($postData['mobileno']) ? $postData['mobileno'] : ''; ?>" required="">

            </fieldset>

            <fieldset>

              <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>

            </fieldset>

            <input type="submit" class="submit" name="submit" value="<?php echo __( 'Submit', 'oinp' ); ?>">

          </div>



          <!-- <div class="submit-form">

                                

                            </div> -->

        </div>

      </form>

    </div>

  </div>

</section>

<?php if (have_rows('stream_app')) :

  while (have_rows('stream_app')) : the_row(); ?>

    <section class="stream">

      <div class="container">

        <div class="stream-app">

          <div class="stream-text"><?php _ol(get_sub_field('description')); ?></div>

          <div class="help-read">

            <a class="read-text-link" href="<?php _ol(get_sub_field('cta_1_url')); ?>">

              <span><?php _ol(get_sub_field('cta_1_label')); ?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#FFFFFF"></path>

              </svg>

            </a>

            <a class="read-text-link" href="<?php _ol(get_sub_field('cta_2_url')); ?>">

              <span><?php _ol(get_sub_field('cta_2_label')); ?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

                <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#FFFFFF"></path>

              </svg>



            </a>

          </div>

        </div>

      </div>

    </section>

<?php

endwhile;

endif; ?>

<?php if (have_rows('why_ontario')) :

  while (have_rows('why_ontario')) : the_row(); ?>

    <section class="why">

      <div class="container">

        <div class="why-in">

          <div class="why-map">

            <div id="map"></div>

          </div>

          <div class="why-contents">

            <h2 class="h1-titles"><?php _ol(get_sub_field('title')); ?></h2>

            <p class="why-texts"><?php _ol(get_sub_field('description')); ?></p>

            <a href="<?php _ol(get_sub_field('cta_url')); ?>" class="why-btn">

              <span><?php _ol(get_sub_field('cta_label')); ?></span>

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="arrow icon" class="desk-icon">

              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-arrow.svg" alt="arrow-icon" class="mobil-icon">

            </a>

            <!-- <input type="button" class="why-btn" value="continue" aria-label="continue"> -->

          </div>

        </div>

      </div>

    </section>

<?php

endwhile;

endif; ?>


<?php if (have_rows('social_media')) :

  while (have_rows('social_media')) : the_row(); ?>
<section class="media">

  <div class="container">

    <div class="media-heder">

      <div class="media-tabs">

        <ul class="media-links">

          <li class="active"><a href="#media"><?php echo __( 'Social Media', 'oinp' ); ?></a></li>

        </ul>

      </div>

      <div class="view-all">

        <a href="<?php _ol(get_sub_field('view_all_link')); ?>" target="_blank">

          <span><?php echo __( 'View all', 'oinp' ); ?></span>

          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="16" viewBox="0 0 28 16" fill="none">

            <path d="M26.9892 8.70711C27.3797 8.31658 27.3797 7.68342 26.9892 7.29289L20.6252 0.928932C20.2347 0.538408 19.6015 0.538408 19.211 0.928932C18.8205 1.31946 18.8205 1.95262 19.211 2.34315L24.8678 8L19.211 13.6569C18.8205 14.0474 18.8205 14.6805 19.211 15.0711C19.6015 15.4616 20.2347 15.4616 20.6252 15.0711L26.9892 8.70711ZM0.0390625 9H26.2821V7H0.0390625V9Z" fill="#000"></path>

          </svg>

        </a>



      </div>

    </div>

    <div class="media-contents">

      <div class="media-tabs owl-carousel owl-carousel2" id="news">
<?php while (have_rows('links')) : the_row(); ?>
        <div class="media-blocks">



          <iframe src="<?php _ol(get_sub_field('link')); ?>" height="913" width="371" frameborder="0" allowfullscreen="" title="Embedded post"></iframe>

        </div>

<?php endwhile; ?>
      </div>

    </div>

  </div>

</section>

<?php

endwhile;

endif; ?>

<?php if (have_rows('advisor_text')) :

  while (have_rows('advisor_text')) : the_row(); ?>

    <div class="advisor">

      <p class="advisor-texts"><?php _ol(get_sub_field('title')); ?></p>

      <span class="advisor-icon">

        <a href="<?php _ol(get_sub_field('cta_url')); ?>">

          <span><?php _ol(get_sub_field('cta_label')); ?></span>

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