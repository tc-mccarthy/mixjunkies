<?php get_header(); ?>

<?php require('lib/inc/page-styling.php'); ?>	

<div id="content-wrapper" class="404-page <?php echo($layout); ?>">
	
	<div id="main-content" class="single-wrapper">

		<h1 class="page-title"><?php echo gp_error_404; ?></h1>
	
		<div class="single-wrapper">
			
			<h4><?php echo gp_error_404_message; ?></h4>
	
			<div class="divider"></div>
			
			<h3><?php echo gp_search_site; ?></h3>
			<?php get_search_form(); ?>

		</div>		

	</div>
	
	<?php if($theme_layout_other == "Fullwidth") {} else { ?><?php get_sidebar(); ?><?php } ?>
	
	<div class="clear"></div>
	
</div>

<?php get_footer(); ?>