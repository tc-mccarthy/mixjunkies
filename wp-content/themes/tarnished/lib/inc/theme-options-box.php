<div class="theme-box">
	
	<h3>Theme Options</h3>
	
	<form name="themeoptionsform">
	
		<span class="label">Skins</span>
		<select name="themeskin" id="themeskin" OnChange="location.href=themeoptionsform.themeskin.options[selectedIndex].value">
			<option selected="selected">Choose...</option>
			<option value="<?php bloginfo('url'); ?>/?skin=blue">Blue</option>
			<option value="<?php bloginfo('url'); ?>/?skin=red">Red</option>
			<option value="<?php bloginfo('url'); ?>/?skin=green">Green</option>
			<option value="<?php bloginfo('url'); ?>/?skin=orange">Orange</option>
			<option value="<?php bloginfo('url'); ?>/?skin=pink">Pink</option>			
			<option value="<?php bloginfo('url'); ?>/?skin=brown">Brown</option>
			<option value="<?php bloginfo('url'); ?>/?skin=silver">Silver</option>
		</select>
		
		<div class="clear"></div>

		<span class="label">Backgrounds</span>
		<select name="themebg" id="themebg" OnChange="location.href=themeoptionsform.themebg.options[selectedIndex].value">
			<option selected="selected">Choose...</option>
			<option value="<?php bloginfo('url'); ?>/?bg=cream">Cream</option>
			<option value="<?php bloginfo('url'); ?>/?bg=black">Black</option>
			<option value="<?php bloginfo('url'); ?>/?bg=dark-blue">Dark Blue</option>
			<option value="<?php bloginfo('url'); ?>/?bg=royal-blue">Royal Blue</option>
			<option value="<?php bloginfo('url'); ?>/?bg=pink-stripes">Pink Stripes</option>
		</select>

		<div class="clear"></div>
		
		<span class="label">Frontpage Examples<span class="label-desc">Just some examples, but you can customize the frontpage however you want.</span></span>
		<select name="layout" id="layout" OnChange="location.href=themeoptionsform.layout.options[selectedIndex].value">
			<option selected="selected">Choose...</option>
			<option value="<?php bloginfo('url'); ?>">Fade Slider w/ Blog</option>
			<option value="<?php bloginfo('url'); ?>/homepage/homepage-fade-slider">Fade Slider</option>
			<option value="<?php bloginfo('url'); ?>/homepage/homepage-accordion-slider-w-blog">Accordion Slider w/ Blog</option>
			<option value="<?php bloginfo('url'); ?>/homepage/homepage-portfolio">Portfolio Display</option>
		</select>
		
		<div class="clear"></div>

		<a href="<?php bloginfo('url'); ?>/?style=default" class="reset-cookies">Reset Options</a>
		
	</form>

</div>

<a class="trigger" href="#"><span class="trigger-open">Theme Options +</span><span class="trigger-close">Hide</span></a>
