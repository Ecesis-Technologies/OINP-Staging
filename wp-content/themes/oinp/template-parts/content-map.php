<?php

/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oinp
 */

?>
<?php if (have_rows('map')) :
    while (have_rows('map')) : the_row();
?>
        <section class="map-section">
            <div class="container">
                <div class="map-title">
                    <h3><?php _ol(get_sub_field('title')); ?></h3>
                </div>
                <div class="map-box">
                    <div id="map"></div>
                </div>
            </div>
        </section>

<?php
    endwhile;
endif; ?>