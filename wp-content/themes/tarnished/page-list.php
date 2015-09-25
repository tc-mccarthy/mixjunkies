<?php 
/*
Template Name: Page List
*/
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php require('lib/inc/page-styling.php'); ?>

	<div id="content-wrapper" class="post-<?php the_ID(); ?> <?php echo($layout); ?>">

		<?php if(get_post_meta($post->ID, 'ghostpool_top_content', true)) { ?>
		
			<div id="top-content">
				<?php echo stripslashes(do_shortcode(get_post_meta($post->ID, 'ghostpool_top_content', true))); ?>
				<div class="clear"></div>	
			</div>

			<div class="clear"></div>
		
		<?php } ?>

		<div id="main-content" class="single-wrapper">

			<?php if(!get_post_meta($post->ID, 'ghostpool_page_title', true)) { ?>
				<?php if(get_post_meta($post->ID, 'ghostpool_reduce_title_size', true)) { ?><h2 class="page-title"><?php the_title(); ?></h2><?php } else { ?><h1 class="page-title"><?php the_title(); ?></h1><?php } ?>
			<?php } ?>

			<div class="single-wrapper">
			
				<?php
				$children = wp_list_pages('depth=1&title_li=&child_of='.$post->ID.'&echo=0');
				if ($children) { ?>
				<ul>
					<?php echo $children; ?>
				</ul>
				<?php } ?>
			
			</div>
			
		</div>
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
		
	</div>
		
<?php endwhile; endif; ?>

<?php get_footer(); ?>