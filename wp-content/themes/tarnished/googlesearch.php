<?php
/**
 * Template Name: Google Search CSE
*/

?>

<?php get_header(); ?>

<?php require('lib/inc/page-styling.php'); ?>	

<div id="content-wrapper" class="404-page <?php echo($layout); ?>">
	
	<div id="main-content" class="single-wrapper">

		<h1 class="page-title">Search Results</h1>
	
		<div class="single-wrapper">
        <div id="searchResults">
		<script>
		  (function() {
			var cx = '015027420445388443858:--x-htw3-_c';
			var gcse = document.createElement('script');
			gcse.type = 'text/javascript';
			gcse.async = true;
			gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
				'//www.google.com/cse/cse.js?cx=' + cx;
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(gcse, s);
		  })();
		</script>
		<gcse:searchresults-only linktarget="_parent"></gcse:searchresults-only> 
		</div>

		</div>		

	</div>
	
	<?php if($theme_layout_other == "Fullwidth") {} else { ?><?php get_sidebar(); ?><?php } ?>
	
	<div class="clear"></div>
	
</div>

<?php get_footer(); ?>
