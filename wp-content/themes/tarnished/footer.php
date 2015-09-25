<?php require(ghostpool_inc . 'options.php'); ?>

	<div id="footer-bar">
		
		<div id="copyright">
			<?php if($theme_footer_content) { echo stripslashes($theme_footer_content); } else { ?>Copyright &copy; Mixjunkies.com | <a href="mailto:press@mixjunkies.com">Press</a> | <a href="mailto:ads@mixjunkies.com">Advertise</a> | <a href="http://download.mixjunkies.com/media/Mixjunkies-Media-Kit-2012.pdf">Media Kit</a><?php } ?>
		</div>
		
		<?php require_once('lib/inc/social-icons.php'); ?>
		
	</div>

</div>
<!--End Page Wrapper-->

<!--Begin Footer Widgets-->
<?php if(is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4')) { ?>
	
	<div class="clear"></div>
	
	<div id="footer-border"></div>
	
	<div id="footer">
	
		<div id="footer-widgets">
			
			<?php
			if(is_active_sidebar('footer-1') && is_active_sidebar('footer-2') && is_active_sidebar('footer-3') && is_active_sidebar('footer-4')) { $footer_widgets = "footer-fourth"; }
			elseif(is_active_sidebar('footer-1') && is_active_sidebar('footer-2') && is_active_sidebar('footer-3')) { $footer_widgets = "footer-third"; }
			elseif(is_active_sidebar('footer-1') && is_active_sidebar('footer-2')) {
			$footer_widgets = "footer-half"; }	
			elseif(is_active_sidebar('footer-1')) { $footer_widgets = "footer-whole"; }
			?>
		
			<?php if(is_active_sidebar('footer-1')) { ?>
				<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
					<?php dynamic_sidebar('footer-1'); ?>
				</div>
			<?php } ?>
		
			<?php if(is_active_sidebar('footer-2')) { ?>
				<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
					<?php dynamic_sidebar('footer-2'); ?>
				</div>
			<?php } ?>
			
			<?php if(is_active_sidebar('footer-3')) { ?>
				<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
					<?php dynamic_sidebar('footer-3'); ?>
				</div>
			<?php } ?>
			
			<?php if(is_active_sidebar('footer-4')) { ?>
				<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
					<?php dynamic_sidebar('footer-4'); ?>
				</div>
			<?php } ?>
			
			<div class="clear"></div>
	
		</div>
	
	</div>

<?php } ?>
<!--End Footer Widgets-->		

<?php wp_footer(); ?>
<?php 

?>
<?php 



?>



<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-sK7rC3uAQG8xJ"
});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-sK7rC3uAQG8xJ.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<script type="text/javascript">
  var _sf_async_config = { uid: 53026, domain: 'mixjunkies.com', useCanonical: true };
  (function() {
    function loadChartbeat() {
      window._sf_endpt = (new Date()).getTime();
      var e = document.createElement('script');
      e.setAttribute('language', 'javascript');
      e.setAttribute('type', 'text/javascript');
      e.setAttribute('src','//static.chartbeat.com/js/chartbeat.js');
      document.body.appendChild(e);
    };
    var oldonload = window.onload;
    window.onload = (typeof window.onload != 'function') ?
      loadChartbeat : function() { oldonload(); loadChartbeat(); };
  })();
</script>
</body>
</html>