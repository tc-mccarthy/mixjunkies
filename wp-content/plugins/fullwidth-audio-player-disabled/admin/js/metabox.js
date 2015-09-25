jQuery(document).ready(function() {
	
	//adds a playlist into the editor
	jQuery('#fap-add-playlist').click(function() {
		tinymce.EditorManager.activeEditor.selection.setContent('[fap_playlist id="'+ jQuery('#fap-playlists').val() +'" layout="'+ jQuery('input[name=fap_layout]:checked').val() +'" enqueue="'+(jQuery('input[name=fap_enqueue]').is(':checked') ? 'yes' : 'no')+'" play_playlist_button="'+(jQuery('input[name=fap_play_playlist]').val().length > 0 ? jQuery('input[name=fap_play_playlist]').val() : '')+'"]');
		return false;
	});
	
	//changes the default playlist
	jQuery('#fap-change-default-playlist').click(function() {
		tinymce.EditorManager.activeEditor.selection.setContent('[fap_default_playlist id="'+ jQuery('#fap-playlists').val() +'"]');
		return false;
	});

});