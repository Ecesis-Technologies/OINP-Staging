<?php



/**

 * Template part for displaying page content in page.php.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package oinp

 */


$fimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
?>



<div class="in-banner-img <?php echo sanitize_title(get_the_title()); ?>">

	<?php

	/*if (has_post_thumbnail()) {

		the_post_thumbnail('full', array());;

	}*/

	?>
<img src="<?php echo $fimage[0]; ?>" alt=" <?php the_title(); ?> page banner">
</div>

<div class="in-banner-content">

	<div class="container">

		<div class="banner-in banner-responsive">

			<?php if (have_rows('hero')) :

				while (have_rows('hero')) : the_row(); ?>

					<div class="left-side">

						<span class="caption"><?php _ol(get_sub_field('title')); ?></span>

						<div class="banner-titles"><?php _ol(get_sub_field('sub_title')); ?></div>

						<div class="banner-subtext"><?php _ol(get_sub_field('intro_text')); ?></div>

					</div>

			<?php

				endwhile;

			endif; ?>

			<div class="right-side">

				<?php

				the_content();



				wp_link_pages(array(

					'before' => '<div class="page-links">' . esc_html__('Pages:', 'mysite'),

					'after'  => '</div>',

				));

				?>

			</div>

		</div>

	</div>

</div>