<?php



/**

 * Template part for displaying page content in page.php.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package oinp

 */



?>

<?php if (have_rows('service')) :

    while (have_rows('service')) : the_row();

?>

        <section class="key-services">

            <div class="container">

                <div class="key-title">

                    <h3><?php _ol(get_sub_field('title')); ?></h3>

                </div>

                <div class="main-box">

                    <?php if (have_rows('items')) :

                        while (have_rows('items')) : the_row();
						$icon=get_sub_field('icon');
                    ?>

                            <div class="key-box">

                                <div class="key-content">

                                    <div class="key-img">

                                        <img src="<?php echo $icon['url']; ?>" alt="" class="">

                                    </div>

                                    <h1><?php _ol(get_sub_field('title')); ?></h1>

                                    <p>

                                        <?php _ol(get_sub_field('description')); ?>

                                    </p>

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

endif; ?>