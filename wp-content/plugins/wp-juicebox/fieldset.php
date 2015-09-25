<fieldset>

	<div id="toggleable">

		<div class="col1">
			<label for="galleryTitle" class="info">Gallery Title</label>
		</div>
		<div class="col2">
			<input type="text" id="galleryTitle" name="galleryTitle" value="<?php echo htmlspecialchars($custom_values['galleryTitle']); ?>" />
		</div>

		<div class="clear">&nbsp;</div>

		<div class="col1">
			<label for="e_library" class="info">Image Source</label>
		</div>
		<div class="col3">
			<select id="e_library" name="e_library">
				<option <?php selected('media', $custom_values['e_library']); ?> value="media">Media Library</option>
				<option <?php selected('flickr', $custom_values['e_library']); ?> value="flickr">Flickr</option>
				<option <?php selected('nextgen', $custom_values['e_library']); ?> value="nextgen">NextGEN Gallery</option>
				<option <?php selected('picasa', $custom_values['e_library']); ?> value="picasa">Picasa Web Album</option>
			</select>
		</div>

		<div class="clear">&nbsp;</div>

		<div id="toggle-media">
			<div class="col1">
				<label for="e_featuredImage" class="info">Include Featured Image</label>
			</div>
			<div class="col3">
<?php
				$checked='';
				if (isset($custom_values['e_featuredImage']) && ($custom_values['e_featuredImage'] === 'true' || $custom_values['e_featuredImage'] === '')) {
					$checked = ' checked=\'checked\'';
				}
?>
				<input type="checkbox" id="e_featuredImage" name="e_featuredImage" value="true" <?php echo $checked; ?> />
			</div>

			<div class="col1">
				<span>Use the Upload/Insert&nbsp;&nbsp;<img src="<?php echo get_bloginfo('wpurl') . '/wp-admin/images/media-button.png'; ?>" width="15" height="15" alt="Add Media" />&nbsp;&nbsp;button to add images</span>
			</div>
		</div>

		<div id="toggle-flickr">
			<div class="col1">
				<label for="flickrUserName" class="info">Flickr Username</label>
			</div>
			<div class="col3">
				<input type="text" id="flickrUserName" name="flickrUserName" value="<?php echo $custom_values['flickrUserName']; ?>" />
			</div>

			<div class="col1">
				<label for="flickrTags" class="info">Flickr Tags</label>
			</div>
			<div class="col3">
				<input type="text" id="flickrTags" name="flickrTags" value="<?php echo $custom_values['flickrTags']; ?>" />
			</div>
		</div>

		<div id="toggle-nextgen">
			<div class="col1">
				<label for="e_nextgenGalleryId" class="info">NextGEN Gallery Id</label>
			</div>
			<div class="col3">
				<input type="text" id="e_nextgenGalleryId" name="e_nextgenGalleryId" value="<?php echo $custom_values['e_nextgenGalleryId']; ?>" />
			</div>
		</div>

		<div id="toggle-picasa">
			<div class="col1">
				<label for="e_picasaUserId" class="info">Picasa User Id</label>
			</div>
			<div class="col3">
				<input type="text" id="e_picasaUserId" name="e_picasaUserId" value="<?php echo $custom_values['e_picasaUserId']; ?>" />
			</div>

			<div class="col1">
				<label for="e_picasaAlbumName" class="info">Picasa Album Name</label>
			</div>
			<div class="col3">
				<input type="text" id="e_picasaAlbumName" name="e_picasaAlbumName" value="<?php echo $custom_values['e_picasaAlbumName']; ?>" />
			</div>
		</div>

		<div class="clear">&nbsp;</div>

		<div class="col1">
			<label for="e_galleryWidth" class="info">Gallery Width</label>
		</div>
		<div class="col3">
			<input type="text" id="e_galleryWidth" name="e_galleryWidth" value="<?php echo $custom_values['e_galleryWidth']; ?>" />
		</div>

		<div class="col1">
			<label for="e_galleryHeight" class="info">Gallery Height</label>
		</div>
		<div class="col3">
			<input type="text" id="e_galleryHeight" name="e_galleryHeight" value="<?php echo $custom_values['e_galleryHeight']; ?>" />
		</div>

		<div class="clear">&nbsp;</div>

		<div class="col1">
			<label for="e_backgroundColor" class="info">Background Color</label>
		</div>
		<div class="col3">
			<input type="text" id="e_backgroundColor" name="e_backgroundColor" value="<?php echo $custom_values['e_backgroundColor']; ?>" />
		</div>

		<div class="col1">
			<label for="e_backgroundOpacity" class="info">Background Opacity</label>
		</div>
		<div class="col3">
			<input type="text" id="e_backgroundOpacity" name="e_backgroundOpacity" value="<?php echo $custom_values['e_backgroundOpacity']; ?>" />
		</div>

		<div class="clear">&nbsp;</div>

		<div class="col1">
			<label for="showOpenButton" class="info">Show Open Button</label>
		</div>
		<div class="col3">
			<input type="checkbox" id="showOpenButton" name="showOpenButton" value="true" <?php checked($custom_values['showOpenButton'], 'true'); ?> />
		</div>

		<div class="clear">&nbsp;</div>

		<div class="col1">
			<label for="showExpandButton" class="info">Show Expand Button</label>
		</div>
		<div class="col3">
			<input type="checkbox" id="showExpandButton" name="showExpandButton" value="true" <?php checked($custom_values['showExpandButton'], 'true'); ?> />
		</div>

		<div class="col1">
			<label for="showThumbsButton" class="info">Show Thumbs Button</label>
		</div>
		<div class="col3">
			<input type="checkbox" id="showThumbsButton" name="showThumbsButton" value="true" <?php checked($custom_values['showThumbsButton'], 'true'); ?> />
		</div>

		<div class="clear">&nbsp;</div>

		<div class="col1">
			<label for="proOptions" class="info">Pro Options</label>
		</div>
		<div class="col2">
			<textarea id="proOptions" name="proOptions" cols="50" rows="5" ><?php echo $pro_options; ?></textarea>
		</div>

		<div class="clear">&nbsp;</div>

	</div>

</fieldset>
