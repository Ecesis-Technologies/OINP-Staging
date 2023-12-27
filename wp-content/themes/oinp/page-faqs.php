<?php get_header(); ?>



<section class="faq-main">

    <div class="faq-banner">

        <?php

        while (have_posts()) : the_post(); ?>

            <div class="in-banner-img">

                <?php

                if (has_post_thumbnail()) {

                    the_post_thumbnail('full', array());;

                }

                ?>

            </div>

        <?php

        endwhile; // End of the loop.

        ?>

    </div>

    <?php if (have_rows('faqs')) :

        while (have_rows('faqs')) : the_row(); ?>



            <h3 class="h3-titles"><?php _ol(get_sub_field('title')); ?></h3>

            <span class="h3-content"><?php _ol(get_sub_field('sub_title')); ?></span>

            <section class="question-section">

                <div class="container">

                    <div class="toggle-section-faq">

                        <?php if (have_rows('faq_items')) :

                            $flag = true;

                            while (have_rows('faq_items')) : the_row(); ?>

                                <div class="toggle-contents-faq  <?php if ($flag) echo 'open'; ?>">



                                    <div class="question-toggle">

                                        <span class="toggle-title-faq"><?php _ol(get_sub_field('question')); ?></span>

                                        <div class="plus-minus-icon"></div>

                                    </div>

                                    <div class="toggle-texts-faq " <?php if (!$flag)  echo 'style="display:none"'; ?>>
									<?php //_ol(get_sub_field('answer'));
									echo preg_replace("/<p[^>]*>(?:\s|&nbsp;)*<\/p>/", '', get_sub_field('answer'));
									 ?>
                                    
                                    </div>

                                </div>

                        <?php

                                $flag = false;

                            endwhile;

                        endif; ?>



                    </div>

                </div>

            </section>

    <?php

        endwhile;

    endif; ?>

</section>

<!-- Footer section 2-->

<?php if (have_rows('contact_banner')) : ?>

    <?php

    get_template_part('template-parts/content', 'contactBanner'); ?>

<?php

endif; ?>

<?php get_footer();  ?>