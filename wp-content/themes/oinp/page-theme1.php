<?php
/**

 * Template Name: Theme 3

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

?>

<?php get_header(); ?>
<style>
.inner-banner .in-banner-content .banner-in .left-side .banner-titles {
  line-height: 55px;
  font-size:40px;
}
.are-you .are-you-in .are-you-tabbox .you-select .are-box-in .are-in-content .box-title {
  max-width: 400px;
}
.are-in-image img{
	max-width:70%;
}
.extracontent-main{
	padding-bottom:70px;
}
.exttitle{
	font-size: 30px;
    font-weight: 600;
    line-height: 48px;
	margin-bottom: 20px;
    margin-top: 30px;
}
.extrimg{
	max-width:600px;
	float:right;
	margin-left:10px;
	margin-bottom:10px;
}
.extrcntoutr{
	margin-bottom:30px;
	min-height: 400px;
	background: #f9f7f7;
	padding:30px;
	border-radius: 20px;
}
.are-you {
  margin-top: 0;
  position: relative;
}
.are-you .are-you-in .are-you-content .are-select .are-tab-main .are-tab-head ul li a {
  padding: 0 50px;
}
.are-you .are-you-in .are-you-content .are-select {
  margin-top: 60px;
}
</style>
<style>
.are-you .are-you-in .are-you-tabbox {
    justify-content: center;
}
.are-you .are-you-in .are-you-tabbox .you-select {
    width: 900px ;
}
.are-select .you-selected{
	display:none !important;
}
.are-select .you-selected-cont{
	max-width: 80%;
margin: 0 auto;
}
.are-you .are-you-in .are-you-content .are-select .are-tab-main .are-tab-content {
  padding: 53px 0 50px 60px;
}
</style>

<!-- template banner -->

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

<?php if (have_rows('map')) :

?>

    <?php get_template_part('template-parts/content', 'map'); ?>

<?php

endif; ?>

<!-- map end -->



<!-- Community Profile -->

<?php if (have_rows('tab_section')) : ?>

    <?php get_template_part('template-parts/content', 'tab'); ?>

<?php

endif;

?>

<!-- Are You -->

<?php if (have_rows('are_you')) : 

        get_template_part('template-parts/content', 'areYou');

endif;

?>



<!-- business tabs end -->

<?php if (have_rows('swiper')) :

?>

    <?php get_template_part('template-parts/content', 'swiper'); ?>

<?php

endif;

?>
<?php
$content_details = get_field('content_details');
//print_r($content_details);
if($content_details){
?>

					<section class="extracontent-main">
					<div class="container">
                    <div class="row">
                    <div class="col-md-12">
                    <div class="extrcntoutr rw1">
                    <h3 class="exttitle"><?php echo $content_details['content_1']['title']; ?> </h3>
                    <div class="extrcnt">
                     <img src="<?php echo $content_details['content_1']['cover_image1']['url']; ?>" class="img-responsive extrimg" />
                    <?php echo $content_details['content_1']['content']; ?>
                   
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <div class="extrcntoutr rw2">
                    <h3 class="exttitle"><?php echo $content_details['content_2']['title']; ?> </h3>
                    <div class="extrcnt">
                    <img src="<?php echo $content_details['content_2']['cover_image']['url']; ?>" class="img-responsive extrimg" />
                    <?php echo $content_details['content_2']['content']; ?>
                    
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </section>
<?php
}
?>

<!-- FAQ content -->



<?php if (have_rows('faqs')) :

    get_template_part('template-parts/content', 'faq');

endif;

?>



<?php if (have_rows('service')) :

    get_template_part('template-parts/content', 'services');

endif;

?>



<!-- Footer section 2-->

<?php if (have_rows('contact_banner')) : ?>

    <?php

    get_template_part('template-parts/content', 'contactBanner'); ?>

<?php

endif; ?>

<!-- </section> -->



<?php get_footer();  ?>