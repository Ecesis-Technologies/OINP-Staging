<?php



/**

 * Template part for displaying page content in page.php.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package oinp

 */



?><?php if (have_rows('swiper')) :

    while (have_rows('swiper')) : the_row();

?>

        <section class="slider-section">

            <div class="container">

                <div class="title">

                    <h3><?php _ol(get_sub_field('title')); ?></h3>

                </div>

                <!-- slider -->

                <div class="slider-main">

                    <div class="swiper swiper1">



                        <div class="swiper-wrapper">

                            <?php if (have_rows('items')) :

                                while (have_rows('items')) : the_row();
 								$dimage=get_sub_field('image');
                            ?>

                                    <div class="swiper-slide">

                                        <div class="swiper-image">

                                            <div class="image">

                                                <img src="<?php echo $dimage['url']; ?>" class="identify-icon" />

                                                <p class="slider-content"><?php _ol(get_sub_field('description')); ?></p>

                                            </div>

                                        </div>

                                    </div>

                            <?php

                                endwhile;

                            endif;

                            ?>

                        </div>





                        <div class="swiper-button-prev">

                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="12" viewBox="0 0 25 12" fill="none">

                                <path opacity="1" d="M0.469669 5.46967C0.176777 5.76256 0.176777 6.23744 0.469669 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.469669 5.46967ZM25 5.25L1 5.25V6.75L25 6.75V5.25Z" fill="white" />

                            </svg>



                        </div>

                        <div class="swiper-button-next"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="12" viewBox="0 0 25 12" fill="none">

                                <path d="M24.5303 6.53033C24.8232 6.23744 24.8232 5.76257 24.5303 5.46967L19.7574 0.696701C19.4645 0.403807 18.9896 0.403807 18.6967 0.696701C18.4038 0.989594 18.4038 1.46447 18.6967 1.75736L22.9393 6L18.6967 10.2426C18.4038 10.5355 18.4038 11.0104 18.6967 11.3033C18.9896 11.5962 19.4645 11.5962 19.7574 11.3033L24.5303 6.53033ZM-6.55671e-08 6.75L24 6.75L24 5.25L6.55671e-08 5.25L-6.55671e-08 6.75Z" fill="white" />

                            </svg>

                        </div>

                    </div>

                </div>



            </div>

        </section>

<?php

    endwhile;

endif;

?>