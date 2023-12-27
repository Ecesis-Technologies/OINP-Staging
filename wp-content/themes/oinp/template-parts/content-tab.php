<?php



    /**

     * Template part for displaying page content in page.php.

     *

     * @link https://codex.wordpress.org/Template_Hierarchy

     *

     * @package oinp

     */



    ?>

<?php if (have_rows('tab_section')) :

    while (have_rows('tab_section')) : the_row();

        if (have_rows('tab_item')) :

            while (have_rows('tab_item')) : the_row();

                $toggleData = [];

                $k = 0;

                if (have_rows('toggle_items')) :

                    while (have_rows('toggle_items')) : the_row();

                        $toggleData[$k++] = array("heading" => get_sub_field('heading'), "description" => get_sub_field('description'));

                    endwhile;

                endif;

                $tab_tag = str_replace(' ', '-', strtolower(get_sub_field('title')));

                $tab_head[$tab_tag] = get_sub_field('title');

                $tab_body[$tab_tag] = array("title" => get_sub_field('title'),"content_title" => get_sub_field('content_title'), "description" => get_sub_field('description'), "toggle_items" => $toggleData, "image" => get_sub_field('image'));

            endwhile;

        endif;

?>
<?php 
//print_r($tab_head);
if($tab_head){ ?>
        <section class="ontario-details <?php _ol(get_sub_field('section_class')); ?>" id='communityprofile'>

            <div class="container">

                <div class="are-tab-main">
                <?php if(get_sub_field('section_heading')){ ?>
                <h2 class="text-center bntitle"><?php _ol(get_sub_field('section_heading')); ?></h2>
					<?php } ?>
                    <?php if (sizeof($tab_head) > 1) { ?>

                        <div class="are-tab-head">

                            <ul>

                                <?php
								$kk=1;
                                foreach ($tab_head as $key => $val) {

                                ?>

                                    <li <?php if($kk==1){ echo 'class="active"'; } ?>><a href="#tb<?php echo $kk; ?>"><?php _ol($val); ?> </a></li>

                                <?php $kk++; } ?>

                            </ul>

                        </div>

                    <?php } ?>

                    <div class="are-tab-content">

                        <?php

                        $flagOut = true;
						$kkk=1;
                        foreach ($tab_body as $key => $val) {
//print_r($tab_body);
                        ?>

                            <div class="tab-content-txts" id="tb<?php echo $kkk; ?>" <?php echo (!$flagOut) ? 'style="display:none"' : ''; ?>>

                                <div class="content-list">

                                    <div class="ontario-left">

                                        <h2><?php _ol($val['content_title']); ?></h2>

                                        <div class="scroll">

                                            <?php 
											//_ol($val['description']); 
											echo preg_replace("/<p[^>]*>(?:\s|&nbsp;)*<\/p>/", '', $val['description']);
											?>

                                            <!--  -->

                                            <?php if (sizeof($val['toggle_items']) > 0) { ?>

                                                <section class="question-section">

                                                    <div class="container">

                                                        <div class="toggle-section-faq">

                                                            <?php

                                                            $flag = true;

                                                            foreach ($val['toggle_items'] as $qa) {

                                                            ?>

                                                                <div class="toggle-contents-faq  <?php //echo ($flag) ? 'open' : ''; ?> ">

                                                                    <div class="question-toggle">

                                                                        <span class="toggle-title-faq"><?php _ol($qa['heading']); ?></span>

                                                                        <div class="plus-minus-icon"></div>

                                                                    </div>



                                                                    <div class="toggle-texts-faq " style="display:none"  <?php //echo (!$flag) ? 'style="display:none"' : ''; ?>>

                                                                        <?php 
																		//$dcontent = preg_replace('/<p [^>]*></p>/', _ol($qa['description']));
																		echo preg_replace("/<p[^>]*>(?:\s|&nbsp;)*<\/p>/", '', $qa['description']);
																		?>

                                                                    </div>

                                                                </div>

                                                            <?php $flag = false;

                                                            } ?>

                                                        </div>

                                                    </div>

                                                </section>



                                            <?php  } ?>

                                            <!--  -->

                                        </div>

                                    </div>

                                    <div class="ontario-right">

                                        <div class="ontario-img-brd">

                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/border-image.png" alt="border-image" class="border-img">
                                            <div class="ontario-image-box">

                                                <img src="<?php echo $val['image']['url']; ?>" alt="banner">

                                            </div>

                                        </div>

                                        <!-- <img src="./images/business-img.png" alt="banner"> -->

                                    </div>

                                </div>

                            </div>

                        <?php

                            $flagOut = false;
$kkk++;
                        } ?>

                    </div>

                </div>

            </div>

        </section>
<?php } ?>


<?php

    endwhile;

endif; ?>