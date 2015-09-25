function jbExists(postContent) {
		var pattern = new RegExp('\\[juicebox gallery_id="[0-9]+"\\]', 'g');
		return pattern.exec(postContent);
} 

var JB = window.JB || {};

JB.Gallery = function() {
	return {
		embed : function() {

			var win = window.parent || window;

			var postContent = '';

			if (typeof win.tinyMCE !== 'undefined' && (win.ed = win.tinyMCE.activeEditor) && !win.ed.isHidden()) {
				postContent=win.ed.getContent();
			} else {
				postContent=jQuery(win.edCanvas).val();
			}

			if (jbExists(postContent)) {
				alert('This ' + jbPostType + ' already contains a Juicebox gallery.');
				return;
			}

			if (typeof this.configUrl !== 'string' || typeof tb_show !== 'function') {
				return;
			}

			var url = this.configUrl + ((this.configUrl.match(/\?/)) ? '&' : '?') + 'TB_iframe=1';
			tb_show('Add Juicebox Gallery', url , false);
		}
	};
}();

JB.Gallery.Generator = function() {

	var buildTag = function() {

		jQuery.post(JB.Gallery.Generator.postUrl, jQuery('#build-form-generate').serialize(), function (result) {
			if (result !== '') {
				var tag = '[juicebox ' + result + ']';
				insertTag(tag);
			}
		});
	};

	var insertTag = function(tag) {

		tag = tag || '';
		var win = window.parent || window;

		if (typeof win.tinyMCE !== 'undefined' && (win.ed = win.tinyMCE.activeEditor) && !win.ed.isHidden()) {
			win.ed.focus();
			if (win.tinyMCE.isIE) {
				win.ed.selection.moveToBookmark(win.tinyMCE.EditorManager.activeEditor.windowManager.bookmark);
			}
			win.ed.execCommand('mceInsertContent', false, tag);
		} else {
			win.edInsertContent(win.edCanvas, tag);
		}

		win.tb_remove();
	};

	return {

		initialize : function() {

			if (typeof jQuery === 'undefined') {
				return;
			}

			jQuery('#generate').click(function(e) {
				e.preventDefault();
				buildTag();
			});

			jQuery('#do-not-generate').click(function(e) {
				e.preventDefault();
				var win = window.parent || window;
				win.tb_remove();
			});
		}
	};
}();
