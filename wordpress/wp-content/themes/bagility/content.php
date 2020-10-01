<?php
/**
 * The template for displaying the content.
 * @package bagility
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<article class="mt-post">
		<?php if(has_post_thumbnail()): ?>
		<figure class="mt-post-thumbnail">
			<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" >
				<?php $defalt_arg =array('class' => "img-responsive"); ?>
				<?php the_post_thumbnail('', $defalt_arg); ?>
			</a>
		</figure>	
		<?php endif; ?>
		<div class="mt-post-content">
			<div class="mt-post-meta">
				<span class="mt-date"><a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><time>
				<?php echo esc_html(get_the_date('M j, Y')); ?></time></a></a></span>
				
				<span class="byline"><span class="author vcard"><a class="url fn n" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></span>
				</span>

				<span class="cat-links"><?php   $cat_list = get_the_category_list();
				if(!empty($cat_list)) { ?>
				<?php the_category(', '); ?>
				<?php } ?>
				</span>
				<?php $tag_list = get_the_tag_list();
				if($tag_list){ ?>
				<span class="tag-links"><a href="<?php esc_url(the_permalink()); ?>"><?php the_tags('', ', ', ''); ?></a></span>
				<?php } ?>
			</div>
			<header class="mt-header">		
				<h3 class="mt-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h3>	
			</header>					
			<div class="entry-content">
				<?php the_content(__('Read More','bagility'));
				wp_link_pages( array( 'before' => '<div class="link btn-theme">' . __( 'Pages:', 'bagility' ), 'after' => '</div>' ) ); ?>
			</div>
		</div>
	</article>
</div>