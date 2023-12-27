<?php
/**

 * Template Name: About Page

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