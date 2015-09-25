<?php 

/*************************** Categories, Archives etc. ***************************/

if(!is_singular() or is_attachment()) {
	
	if($theme_layout_other == "Sidebar Left") { $layout = "sb-left";
	} elseif($theme_layout_other == "Fullwidth") { $layout = "fullwidth";
	} else { $layout = "sb-right"; }


/*************************** Posts/Pages ***************************/

} else {

	if(get_post_meta($post->ID, 'ghostpool_layout_individual', true) == "Sidebar Right") { $layout = "sb-right";
	
	} elseif(get_post_meta($post->ID, 'ghostpool_layout_individual', true) == "Sidebar Left") { $layout = "sb-left";
	
	} elseif(get_post_meta($post->ID, 'ghostpool_layout_individual', true) == "Fullwidth") { $layout = "fullwidth";
	
	} else {
	
		if($theme_layout == "Sidebar Left") { $layout = "sb-left";
		} elseif($theme_layout == "Fullwidth") { $layout = "fullwidth";
		} else { $layout = "sb-right"; }
		
	}

}

?>