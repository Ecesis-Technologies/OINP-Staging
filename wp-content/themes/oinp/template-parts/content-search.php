<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package oinp
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class('wrap-search-item'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title search"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php site_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php echo $trimmed = wp_trim_words( apply_filters( 'the_content', get_the_content()), $num_words = 55, ' ' );?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php site_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
