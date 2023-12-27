<?php 
/**

 * Template Name: Theme 2

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

get_header('hamilton'); 
$fimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
$mobile_banner=get_field('mobile_banner');
/*if(!mobilecheck()){
	$fmg=$fimage[0];
}else{
	
	if($mobile_banner!=""){
	$fmg=$mobile_banner;
	}else{
	$fmg=$fimage[0];	
	}
}*/
$fmg=$fimage[0];
if($mobile_banner!=""){
	$mfmg=$mobile_banner;
	}else{
	$mfmg=$fimage[0];	
	}
?>

<!-- template banner -->
        <section class="inner-banner">
            <div class="in-banner-img">
                <img src="<?php echo $fmg; ?>" alt=" <?php the_title(); ?> page banner" class="only-pc">
                <img src="<?php echo $mfmg; ?>" alt=" <?php the_title(); ?> page banner" class="only-mobile">
                <div class="bnrtxt"><div class="container"><h1><?php the_title(); ?></h1></div></div>
            </div>
            
        </section>
        <!-- template banner end -->
        
        
   <?php if (have_rows('section_1')) :     
     while (have_rows('section_1')) : the_row(); 
	 $youtube_cover_image=get_sub_field('youtube_cover_image');
	 //print_r($youtube_cover_image);
	 ?>   
        
        <section class="introsect" id="introsect">
            <div class="are-bg-left"></div>
            <div class="are-bg-right"></div>
            <div class="container">
            <div class="introtoptxt row">
            <div class="col-md-5 vlft">
            <h4 class="intrtitle"><?php _ol(get_sub_field('title')); ?></h4>
            <?php _ol(get_sub_field('intro_text')); ?>
            </div>
            <div class="col-md-7 viddiv">
            <?php 
				if(get_sub_field('vimeo_code')=="" && get_sub_field('youtube_code')==""){
					?>
                    <img src="<?php echo $youtube_cover_image['url']; ?>" alt="" >
                    <?php }else{ ?>
            <img src="<?php echo $youtube_cover_image['url']; ?>" alt="" id="vidcvr">
            <?php } ?>
			<?php 
				if(get_sub_field('vimeo_code')!=""){
					?>
				<iframe src="https://player.vimeo.com/video/<?php _ol(get_sub_field('vimeo_code')); ?>" width="100%" height="99%" frameborder="0" allow="autoplay; fullscreen" id="vid1" allowfullscreen></iframe>
				<?php
				}else{
					?>
                    <?php 
					if(get_sub_field('youtube_code')!=""){
					?>
            <iframe width="100%" height="99%" id="vid1" src="https://www.youtube.com/embed/<?php _ol(get_sub_field('youtube_code')); ?>?rel=0" frameborder="0" allowfullscreen></iframe>
            <?php } ?>
				<?php } ?>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 text-center inttxt">
            <?php _ol(get_sub_field('extra_content')); ?>
            </div>
            </div>
            
            <div class="rankingdiv row">
            <?php while (have_rows('box_1')) : the_row(); ?>
            <?php if(get_sub_field('title')!=""){ ?>
            <div class="col-md-4">
            <div class="rnkgbox box1">           
            <img src="<?php echo get_template_directory_uri();?>/assets/images/theme2/ranking.svg" alt="">
            <h5><?php _ol(get_sub_field('title')); ?></h5>
            <p><?php _ol(get_sub_field('sub_title')); ?></p>
            <p><span><?php _ol(get_sub_field('source')); ?></span></p>
            <?php if(get_sub_field('link')){ ?>
				<p><span><a href="<?php _ol(get_sub_field('link')); ?>" target="_blank"><strong><u><?php _ol(get_sub_field('link')); ?></u></strong></a></span></p>
            <?php } ?>            
            </div>
            </div>
            <?php } endwhile; ?>
            <?php while (have_rows('box_2')) : the_row(); ?>
            <?php if(get_sub_field('title')!=""){ ?>
            <div class="col-md-4">
            <div class="rnkgbox box2">            
            <img src="<?php echo get_template_directory_uri();?>/assets/images/theme2/midsized.svg" alt="">
            <h5><?php _ol(get_sub_field('title')); ?></h5>
            <p><?php _ol(get_sub_field('sub_title')); ?></p>
            <p><span><?php _ol(get_sub_field('source')); ?></span></p>
            <?php if(get_sub_field('link')){ ?>
            <p><span><a href="<?php _ol(get_sub_field('link')); ?>" target="_blank"><strong><u><?php _ol(get_sub_field('link')); ?></u></strong></a></span></p>
            <?php } ?>            
            </div>
            </div>
            <?php } endwhile; ?>
            <?php while (have_rows('box_3')) : the_row(); ?>
            <?php if(get_sub_field('title')!=""){ ?>
            <div class="col-md-4">
            <div class="rnkgbox box3">            
            <img src="<?php echo get_template_directory_uri();?>/assets/images/theme2/growing.svg" alt="">
            <h5><?php _ol(get_sub_field('title')); ?></h5>
            <p><?php _ol(get_sub_field('sub_title')); ?></p>
            <p><span><?php _ol(get_sub_field('source')); ?></span></p>
            <?php if(get_sub_field('link')){ ?>
            <p><span><a href="<?php _ol(get_sub_field('link')); ?>" target="_blank"><strong><u><?php _ol(get_sub_field('link')); ?></u></strong></a></span></p>
            <?php } ?>           
            </div>
            </div>
            <?php } endwhile; ?>
            
            <?php while (have_rows('box_4')) : the_row(); ?>
            <?php if(get_sub_field('title')!=""){ ?>
            <div class="col-md-4">
            <div class="rnkgbox box4">            
            <img src="<?php echo get_template_directory_uri();?>/assets/images/theme2/ranking.svg" alt="">
            <h5><?php _ol(get_sub_field('title')); ?></h5>
            <p><?php _ol(get_sub_field('sub_title')); ?></p>
            <p><span><?php _ol(get_sub_field('source')); ?></span></p>
            <?php if(get_sub_field('link')){ ?>
            <p><span><a href="<?php _ol(get_sub_field('link')); ?>" target="_blank"><strong><u><?php _ol(get_sub_field('link')); ?></u></strong></a></span></p>
            <?php } ?>           
            </div>
            </div>
            <?php } endwhile; ?>
            
            <?php while (have_rows('box_5')) : the_row(); ?>
            <?php if(get_sub_field('title')!=""){ ?>
            <div class="col-md-4">
            <div class="rnkgbox box5">           
            <img src="<?php echo get_template_directory_uri();?>/assets/images/theme2/growing.svg" alt="">
            <h5><?php _ol(get_sub_field('title')); ?></h5>
            <p><?php _ol(get_sub_field('sub_title')); ?></p>
            <p><span><?php _ol(get_sub_field('source')); ?></span></p>
            <?php if(get_sub_field('link')){ ?>
            <p><span><a href="<?php _ol(get_sub_field('link')); ?>" target="_blank"><strong><u><?php _ol(get_sub_field('link')); ?></u></strong></a></span></p>
            <?php } ?>
            </div>
            </div>
            <?php } endwhile; ?>
            
            
            
            </div>
            
            </div>
            </section>
      	<?php
        endwhile;
   		endif; 
		?>  
    
    
    <!-- Community Profile -->

<?php if (have_rows('tab_section')) : 
?>

    <?php get_template_part('template-parts/content', 'tab'); ?>

<?php

endif;

?>

<?php if (have_rows('section_3')) :     
     while (have_rows('section_3')) : the_row(); 
	 $main_image=get_sub_field('main_image');
	 $youtube_cover_image=get_sub_field('youtube_cover_image');
	 //print_r($main_image);
	 if(get_sub_field('title')!=""){
	 ?>  
<section class="supportservicesect" id="supportservicesect">
            <div class="are-bg-left"></div>
            <div class="are-bg-right"></div>
            <div class="container">
            <div class="supportservicehead row">
            <div class="col-md-12"><h3><?php _ol(get_sub_field('title')); ?></h3></div>
            </div>
            <div class="supportservicecnt row">
            <div class="col-md-6 ssrvimg">
            <img src="<?php echo $main_image['url']; ?>" alt="<?php _ol(get_sub_field('title')); ?>">
            </div>
            <div class="col-md-6 ssrvtxt">
            <?php _ol(get_sub_field('content')); ?>
            </div>

            <?php if($youtube_cover_image['url']!=""){ ?>
            <div class="supportservicevid row">
            <div class="col-md-12 ssrvvid">
            <?php if(get_sub_field('youtube_code')!=""){ ?>
            <img src="<?php echo $youtube_cover_image['url']; ?>" alt="" id="vid2cvr">
            <?php }else{ ?>
            <img src="<?php echo $youtube_cover_image['url']; ?>" alt="">
            <?php } ?>
            <?php if(get_sub_field('youtube_code')!=""){ ?>
            <iframe width="100%" height="99%" id="vid2" src="https://www.youtube.com/embed/<?php _ol(get_sub_field('youtube_code')); ?>?rel=0" frameborder="0" allowfullscreen></iframe>
            <?php } ?>
            </div>
            </div>
            <?php } ?>
            </div>

        </section>
        <?php
	 }
        endwhile;
   		endif; 
		?> 
        
        
        <?php if (have_rows('section_4')) :     
     while (have_rows('section_4')) : the_row(); 
	 //$youtube_cover_image=get_sub_field('youtube_cover_image');
	 //print_r($youtube_cover_image);
	 ?>  
        <section class="keysectorssect" id="keysectorssect">
            <div class="are-bg-left"></div>
            <div class="are-bg-right"></div>
            <div class="container">
            <div class="keysectorstxt row">
            <div class="col-md-12 text-center">
            <h3 class="kstitle"><?php _ol(get_sub_field('title')); ?></h3>
            <?php _ol(get_sub_field('content')); ?>
            </div>
            </div>
            
            <div class="keysectorsdts row">
             <?php while (have_rows('key_images')) : the_row(); 
			 $kimage=get_sub_field('image');
			 ?>
            <div class="col-md-3 text-center">
            <div class="ksbox">
            <img src="<?php echo $kimage['url']; ?>" alt="">
            <div class="ksdet">
            <p><?php _ol(get_sub_field('title')); ?></p>
            </div>
            </div>
            </div>
            <?php endwhile; ?>
            <?php /*?><div class="col-md-3 text-center">
            <div class="ksbox">
            <img src="images/theme2/lifescience.png" alt="">
            <div class="ksdet">
            <p>Life Sciences</p>
            </div>
            </div>
            </div>
            <div class="col-md-3 text-center">
            <div class="ksbox">
            <img src="images/theme2/agrifood.png" alt="">
            <div class="ksdet">
            <p>Agri-Food/Food and Beverage Processing</p>
            </div>
            </div>
            </div>
            <div class="col-md-3 text-center">
            <div class="ksbox">
            <img src="images/theme2/goodmovement.png" alt="">
            <div class="ksdet">
            <p>Goods Movement</p>
            </div>
            </div>
            </div>
            <div class="col-md-3 text-center">
            <div class="ksbox">
            <img src="images/theme2/communication.png" alt="">
            <div class="ksdet">
            <p>Information, Communications, Technology (ICT) & Digital Media</p>
            </div>
            </div>
            </div>
            <div class="col-md-3 text-center">
            <div class="ksbox">
            <img src="images/theme2/creative.png" alt="">
            <div class="ksdet">
            <p>Creative Industries</p>
            </div>
            </div>
            </div>
            <div class="col-md-3 text-center">
            <div class="ksbox">
            <img src="images/theme2/finance.png" alt="">
            <div class="ksdet">
            <p>Finance, Insurance, Real-estate</p>
            </div>
            </div>
            </div><?php */?>
            </div>
            
            
            </div>
        </section>
        <?php
        endwhile;
   		endif; 
		?> 
        
        <?php if (have_rows('section_5')) :     
     while (have_rows('section_5')) : the_row(); 
	 //$youtube_cover_image=get_sub_field('youtube_cover_image');
	 //print_r($youtube_cover_image);
	 $background_image=get_sub_field('background_image');
	 ?>  
        <section class="accessmarketsect">
            <div class="bnrsct">
                <img src="<?php echo $background_image['url']; ?>" alt="Access to Markets">
                <div class="bnrtxt"><div class="container"><h3><?php _ol(get_sub_field('title')); ?></h3><div class="lne"></div></div></div>
            </div>
            <?php 
			$ff=get_field('section_5');
			//print_r($ff);
			?>
            <div class="accsscnt">
            <div class="container">
            <div class="whtecnt">
            <div class="row">
            <?php 
			if($ff['content_2']['title']==""){
				$cls="col-md-12";
			}else{
				$cls="col-md-6";
			}
			?>
            <div class="<?php echo $cls; ?>">
            <div class="dvbox">
            <?php while (have_rows('content_1')) : the_row(); 
			 ?>
            <div class="dvhd">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/theme2/lbuilding.svg" alt="">
            <h3><?php _ol(get_sub_field('title')); ?></h3>
            </div>
            <div class="dvcnt">
            <?php _ol(get_sub_field('content')); ?>
            </div>
            <?php endwhile; ?>
            </div>            
            </div>
             <?php while (have_rows('content_2')) : the_row(); 
			 if(get_sub_field('title')!=""){
			 ?>
            <div class="col-md-6">
            <div class="dvbox">
           
            <div class="dvhd">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/theme2/suitcaseg.svg" alt="">
            <h3><?php _ol(get_sub_field('title')); ?></h3>
            </div>
            <div class="dvcnt">
            <?php _ol(get_sub_field('content')); ?>
            </div>
           
            </div>
            </div>
             <?php } endwhile; ?>
            </div>
            </div>
            </div>
            </div>
            
        </section>
        <?php
        endwhile;
   		endif; 
		?> 
    
    


<!-- Footer section 2-->

<?php /*?><?php if (have_rows('contact_banner')) : ?>

    <?php

    get_template_part('template-parts/content', 'contactBanner'); ?>

<?php

endif; ?><?php */?>

<?php get_footer();  ?>