<?php



/**

 * The template for displaying the footer.

 *

 * Contains the closing of the #content div and all content after.

 *

 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials

 *

 * @package oinc

 */

?>

<!-- Go to top -->

<div class="go-to-top">

    <a href="#">

        <div class="go-to-arrow">

            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-up.png" alt="" />

        </div>

        <div class="text-main-goto">

            <p class="go-to-text"><?php echo __( 'Go to top', 'oinp' ); ?></p>

        </div>

    </a>

</div>

<footer>

    <div class="container">

        <div class="footer-in">

            <div class="foot-logo">

                <div class="b-logo">

                    <a href="<?php echo site_url(); ?>">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/foot-logos.png" alt="Footer logo"></a>



                </div>

                <div class="ofc-address">

                    <p class="location"><?php echo __( '111 Peter St, Floor 9, Suite 902,', 'oinp' ); ?>

                        <?php echo __( 'Toronto, ON M5V 2G9', 'oinp' ); ?>

                    </p>

                </div>



            </div>

            <div class="foot-links">

                <?php wp_nav_menu(array('theme_location' => 'footer1', 'container' => '', 'items_wrap' => '<ul>%3$s</ul>')); ?>

            </div>

            <div class="foot-last">

                <?php wp_nav_menu(array('theme_location' => 'footer2', 'container' => '', 'items_wrap' => '<ul>%3$s</ul>')); ?>

            </div>

            <div class="foot-address">

                <div class="adress">



                    <span class="foot-phone">+1 (416) 345-9437</span>

                    <span class="foot-mail"> info@futureisontario.com</span>

                </div>

                <div class="social-icon">

                    <ul>



                        <!-- <li><a href="#">

                                        <img src="images/twitter.png" alt="twitter">

                                    </a></li> -->

                        <li><a href="https://www.linkedin.com/showcase/oinp-esi/?viewAsMember=true" target="_blank">

                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/linkdin.png" alt="linkdin">

                            </a></li>

                        <li><a href="https://www.facebook.com/Torontobusinessdevelopmentcentre/" target="_blank">

                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.png" alt="facebook">

                            </a></li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="foot-copy-right">

            <div class="terms">

                <ul>

                    <li><a href="<?php echo get_permalink( get_page_by_path( 'privacy-policy' ) ); ?>"><?php echo __( 'Privacy Policy', 'oinp' ); ?></a></li>

                    <!-- <li><a href="#">Terms of use</a></li> -->

                </ul>

            </div>

            <div class="copy">

                © <?php echo __( '2023 OINP ESI', 'oinp' ); ?>

                <?php echo __( 'All rights reserved.', 'oinp' ); ?>

            </div>



        </div>

    </div>

</footer>

<div class="sticky-btns">

    <div class="talk"><a href="https://calendly.com/rhea-tbdc/30min" target="_blank"><?php echo __( "Let's Talk", 'oinp' ); ?></a></div>

    <div class="apply"><a href="<?php echo get_permalink( get_page_by_path( 'contact' ) ); ?>"><?php echo __( 'Apply Now', 'oinp' ); ?></a></div>

</div>



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/utils/Draggable.min.js"></script>

<script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>

 <script>
//         if ($(window).width() < 768) {
//       console.log("clicked");
//       $(".owl-carousel").owlCarousel({        

//         items:1,

//         nav:true,

//          navText: [
//                       '<i class="fa fa-angle-left" aria-hidden="true"></i>',
//                       '<i class="fa fa-angle-right" aria-hidden="true"></i>'
//                   ],

//         loop:false,

//         autoplay:true,

//         margin:20
       

//     });

//    }
 </script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/owl.carousel.min.js"></script>
<?php 
if(get_the_ID()==5 || get_the_ID()==93){
	?>
<script type="text/javascript">

    mapboxgl.accessToken = 'pk.eyJ1IjoiYW51dml2aW4iLCJhIjoiY2xiZzF1amc5MGJzazN2bGp0aXl1OWllcSJ9.yPt63yB9Vui5y2pOAd2OBg';

    const map = new mapboxgl.Map({

        container: 'map', // container ID

        style: 'mapbox://styles/anuvivin/clcu5rvna000814mk3ng7whcr', // style URL

        center: [-84.161693, 49.417610], // starting position [lng, lat]49.4051/-84.2457

        zoom: 8.8 // starting zoom

    });
</script>
<?php } ?>
<?php 
if(get_the_ID()==95){
	?>
<script>
        $(document).ready(function(){
            
            var URL = window.location.href;

            var split = URL.split("#");

            var type = split[1];

            showDiv(type);

            //alert(type);
            if(type==1 || type==2)
                window.location.href = "#sections";
            
            //yoyo();
        });
    </script>
<?php } ?>
<?php 
if(get_the_ID()==91){
	?>
<script>
    $(document).ready(function() {

        var URL = window.location.href;

        var split = URL.split("#");

        var type = split[1];

        showDiv1(type);
//alert(URL);
        if (type == 1 || type == 2)

            window.location.href = "#areyou";

    });

</script>
<?php } ?>
<?php //echo get_the_ID(); ?>
<?php wp_footer(); ?>

</body>



</html>