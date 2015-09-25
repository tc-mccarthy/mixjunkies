<?php get_header(); ?>

<?php require('lib/inc/page-styling.php'); ?>	

<div id="content-wrapper" class="attachment fullwidth <?php echo($layout); ?>">
	
	<div id="main-content" class="single-wrapper">
			
		<h1 class="page-title"><?php the_title(); ?></h1>
	
		<div class="single-wrapper">
		
			<?php the_attachment_link($post->post_ID, true) ?>
			<?php the_content(); ?>

		</div>
	
	</div>
				
	<div class="clear"></div>
	
</div>

<?php get_footer(); ?>