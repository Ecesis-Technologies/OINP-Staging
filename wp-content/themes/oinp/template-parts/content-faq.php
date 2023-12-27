<?php



/**

 * Template part for displaying page content in page.php.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package oinp

 */



?>

<?php if (have_rows('faqs')) :

	while (have_rows('faqs')) : the_row();

		if (get_sub_field('title')) :

?>

			<section class="faq-main">

				<div class="faq-logo">

					<div class="container">

						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/faq-logo.svg" alt="faq section logo">

					</div>



				</div>

				<div class="frequently-asked-questions">

					<h3 class="h3-titles"><?php _ol(get_sub_field('title')); ?></h3>

					<p class="h3-content"><?php _ol(get_sub_field('sub_title')); ?></p>

				</div>



				<section class="question-section">

					<div class="container">

						<div class="toggle-section-faq">

							<?php if (have_rows('faq_items')) :

								$flag = true;

								while (have_rows('faq_items')) : the_row(); ?>

									<div class="toggle-contents-faq <?php if ($flag) echo 'open'; ?>">

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

			</section>



<?php

		endif;

	endwhile;

endif; ?>