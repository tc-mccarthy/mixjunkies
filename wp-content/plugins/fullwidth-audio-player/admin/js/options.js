jQuery(document).ready(function() {
	
	//custom form fields with uniform
	jQuery("select, input:checkbox, input:radio").uniform();
	
	//set color pickers
	jQuery('.colorSelector').each(function(index, elem) {
	
		jQuery(elem).ColorPicker({ color: colorToHex(jQuery(elem).children('div').css('backgroundColor')),
			onShow: function (colpkr) {
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onSubmit: function (hsb, hex, rgb, el) {
				jQuery(elem).children('div').css('backgroundColor', '#' + hex);
				jQuery(elem).children('input').val('#' + hex);
				jQuery(el).ColorPickerHide();
			}
		});
	});
	
	//convert rgba color to hex color
	function colorToHex(color) {
	    if (color.substr(0, 1) === '#') {
	        return color;
	    }
	    var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);
	    
	    var red = parseInt(digits[2]);
	    var green = parseInt(digits[3]);
	    var blue = parseInt(digits[4]);
	    
	    var rgb = blue | (green << 8) | (red << 16);
	    return digits[1] + '#' + rgb.toString(16);
	};
	
});

