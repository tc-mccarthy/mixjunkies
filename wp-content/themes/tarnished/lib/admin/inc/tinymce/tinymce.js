function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insertghostpoolLink() {
	
	var tagtext;

	var style = document.getElementById('style_panel');
	
		var styleid = document.getElementById('style_shortcode').value;
		
		if (styleid != 0) {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";
		}

		if (styleid != 0 && styleid == 'accordion_slider') {
			tagtext = "["+ styleid + " name=\"accordionslider\" type=\"horizontal\" cat=\"\" slides=\"6\" width=\"950\" height=\"500\" max_slide=\"\" align=\"none\" sticky=\"false\" sticky_number=\"0\" expand_on=\"mouseover\" preload=\"true\" /] ";	
		}
		
		if (styleid != 0 && styleid == 'accordion') {
			tagtext = "["+ styleid + "] [panel title=\"#\"]Insert your text here[/panel] [panel title=\"#\"]Insert your text here[/panel] [panel title=\"#\"]Insert your text here[/panel] [/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'text') {
			tagtext = "["+ styleid + " size=\"13\" width=\"100%\" height=\"\" line_height=\"19px\" color=\"\" font=\"\" other=\"\" text_align=\"\" top=\"0px\" right=\"0px\" bottom=\"0px\" left=\"0px\"]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'image') {
			tagtext = "["+ styleid + " url=\"#\" width=\"#\" height=\"#\" align=\"alignnone\" link=\"\" lightbox=\"none\" alt=\"\" title=\"\" zoom=\"0\" preload=\"false\" /] ";	
		}
		
		if (styleid != 0 && styleid == 'video') {
			tagtext = "["+ styleid + " name=\"#\" url=\"#\" image=\"\" width=\"470\" height=\"320\" align=\"alignnone\" controlbar=\"bottom\" autostart=\"false\" stretching=\"fill\" icons=\"true\" /] ";	
		}
		
		if (styleid != 0 && styleid == 'fade_slider') {
			tagtext = "["+ styleid + " name=\"fadeslider\" cat=\"\" slides=\"-1\" effect=\"scrollHorz\" width=\"950\" height=\"450\" align=\"none\" nav=\"1\" timeout=\"6\" /] ";	
		}
		
     	if (styleid != 0 && styleid == 'portfolio') {
			tagtext = "["+ styleid + " type=\"three-col\" cats=\"\" col_height=\"\" image_width=\"\" image_height=\"\" per_page=\"9\" orderby=\"date\" order=\"desc\" excerpt_length=\"50\" title=\"true\" title_link=\"true\" pagination=\"true\" preload=\"false\" /] ";	
		}
		
		if (styleid != 0 && styleid == 'button') {
			tagtext = "["+ styleid + " link=\"#\" color=\"darkgrey\"]Read More[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'toggle') {
			tagtext = "["+ styleid + " title=\"#\"]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'panel') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'tabs') {
			tagtext = "["+ styleid + "] [tab title=\"#\"]Insert your text here[/tab] [tab title=\"#\"]Insert your text here[/tab] [tab title=\"#\"]Insert your text here[/tab] [/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'login') {
			tagtext = "["+ styleid + " username=\"\" password=\"\" redirect=\"\" /] ";	
		}

		if (styleid != 0 && styleid == 'register') {
			tagtext = "["+ styleid + " username=\"\" email=\"\" redirect=\"\" /] ";	
		}
		
		if (styleid != 0 && styleid == 'divider') {
			tagtext = "["+ styleid + " /] ";
		}
		
		if (styleid != 0 && styleid == 'top') {
			tagtext = "["+ styleid + " /] ";
		}
		
		if (styleid != 0 && styleid == 'clear') {
			tagtext = "["+ styleid + " /] ";
		}	
		
		if (styleid != 0 && styleid == 'bq_left') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'bq_right') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'blog') {
			tagtext = "["+ styleid + " images=\"true\" cats=\"\" image_width=\"220\" image_height=\"225\" per_page=\"9\" orderby=\"date\" order=\"desc\" offset=\"0\" excerpt_length=\"50\" meta=\"true\" full_content=\"false\" title=\"true\" pagination=\"true\" preload=\"false\" wrap=\"true\" /] ";	
		}		

		if (styleid != 0 && styleid == 'contact') {
			tagtext = "["+ styleid + " email=\"#\" /] ";	
		}		

		if (styleid != 0 && styleid == 'sidebar') {
			tagtext = "["+ styleid + " name=\"Default Sidebar\" width=\"\" align=\"none\" /]";	
		}
		
		if (styleid != 0 && styleid == 'dropcap_1') {
			tagtext = "["+ styleid + " color=\"\"] [/" + styleid + "] ";	
		}	

		if (styleid != 0 && styleid == 'dropcap_2') {
			tagtext = "["+ styleid + " color=\"\"] [/" + styleid + "] ";	
		}	
		
		if (styleid != 0 && styleid == 'dropcap_3') {
			tagtext = "["+ styleid + " color=\"\"] [/" + styleid + "] ";	
		}	
		
		if (styleid != 0 && styleid == 'dropcap_4') {
			tagtext = "["+ styleid + " color=\"\"] [/" + styleid + "] ";	
		}	
		
		if (styleid != 0 && styleid == 'dropcap_5') {
			tagtext = "["+ styleid + " color=\"\"] [/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'author') {
			tagtext = "["+ styleid + " /] ";	
		}

		if (styleid != 0 && styleid == 'related_posts') {
			tagtext = "["+ styleid + " limit=\"6\" id=\"\" /] ";	
		}

		if (styleid != 0 && styleid == 'notifcation') {
			tagtext = "["+ styleid + " type=\"star\"] [/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'two') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ["+ styleid + "_last]Insert your text here[/" + styleid + "_last] ";	
		}		

		if (styleid != 0 && styleid == 'three') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ["+ styleid + "_middle]Insert your text here[/" + styleid + "_middle] ["+ styleid + "_last]Insert your text here[/" + styleid + "_last] ";	
		}		

		if (styleid != 0 && styleid == 'four') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ["+ styleid + "_middle]Insert your text here[/" + styleid + "_middle] ["+ styleid + "_middle]Insert your text here[/" + styleid + "_middle] ["+ styleid + "_last]Insert your text here[/" + styleid + "_last] ";	
		}	

		if (styleid != 0 && styleid == 'onethird') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [twothirds_last]Insert your text here[/twothirds_last] ";	
		}	

		if (styleid != 0 && styleid == 'twothirds') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [onethird_last]Insert your text here[/onethird_last] ";	
		}
		
		if (styleid != 0 && styleid == 'onefourth') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [threefourths_last]Insert your text here[/threefourths_last] ";	
		}
		
		if (styleid != 0 && styleid == 'threefourths') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [onefourth_last]Insert your text here[/onefourth_last] ";	
		}	
		
		if ( styleid == 0) {
			tinyMCEPopup.close();
		}
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
