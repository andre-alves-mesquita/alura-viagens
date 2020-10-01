<!-- =========================
     Page Breadcrumb   
============================== -->
<?php get_header(); 
bagility_theme_banner();
get_template_part('index','banner');?>
<!-- =========================
     Page Content Section      
============================== -->
<section id="section" class="site-content">
		<div class="container">
			<div class="row">
      <div class="<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?> col-sm-8 col-xs-12">
		<div class="blog">
		      <?php 
				  while(have_posts()){ the_post();
				  get_template_part('content','');
				  } ?>
				<!--Blog Author-->
				<article class="blog-author">
					<div class="media">
						<figure class="avatar">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>" class="img-responsive"> <?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?> </a>
						</figure>
					</div>	
				</article><!--/ Blog Author-->
         <?php comments_template('',true); ?>
		</div>
	  </div>
      <div class="col-md-4 col-sm-4 col-xs-12">
		<?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>