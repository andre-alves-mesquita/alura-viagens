<?php
/**
 * Slider section
 */
$slider_image = get_theme_mod('slider_image',get_stylesheet_directory_uri() .'/images/slider/banner.jpg');
$slider_image_overlay = get_theme_mod('slider_image_overlay',true);
$slider_overlay_section_color = get_theme_mod('slider_overlay_section_color');
$slider_title = get_theme_mod('slider_title','Productive Ideas for Your Business');
$slider_discription = get_theme_mod('slider_discription','we bring the proper people along to challenge esshortblished thinking and drive transformation.');
$slider_btn_txt = get_theme_mod('slider_btn_txt','Read More');
$slider_btn_link = get_theme_mod('slider_btn_link',esc_url('#'));
$slider_btn_target = get_theme_mod('slider_btn_target',false);
$home_page_slider_enabled = get_theme_mod('home_page_slider_enabled','on');
if($home_page_slider_enabled !='off'){	
?>
<!--== Home Slider ==-->
<section class="mt-slider-warraper">
<!--== bagility-slider ==-->
<div id="mt-slider" class="owl-carousel">  
   <!--item-->
 <div class="item">
	<!--slide image-->
	<figure> <img src="<?php echo esc_url($slider_image); ?>" alt="image description"> </figure>
	<!--/slide image-->
	<!--slide inner-->
	<div class="mt-slider-inner" style="background:<?php echo esc_attr($slider_overlay_section_color);?>">
	  <div class="container inner-table">
		<div class="inner-table-cell">
		  <!--slide content area-->
		  <div class="slide-caption slide-left">
			<!--slide box style-->
			<div class="slide-inner-box-two">
				<h1><?php echo esc_html($slider_title);  ?></h1>
				<div class="description hidden-xs">
				<p><?php echo esc_html($slider_discription); ?></p>
				</div>
			 <?php if($slider_btn_txt) {?>
			  <a class="btn-theme hidden-xs" <?php if($slider_btn_link) { ?> href="<?php echo esc_url($slider_btn_link); } ?>" 
					<?php if($slider_btn_target) { ?> target="_blank" <?php } ?> class="btn btn-tislider">
					<?php if($slider_btn_txt) { echo esc_html($slider_btn_txt); } ?></a>
			 <?php } ?>	
			  <!--/slide box style-->
			</div>
		  <!--/slide content area-->
		</div>
	  </div>
	</div>
	<!--/slide inner-->
  </div>
<!--/slide inner-->
 </div>
  <!--/item-->
</div>
<!--/bagility-slider--> 
</section>
<div class="clearfix"></div>
<?php } ?>