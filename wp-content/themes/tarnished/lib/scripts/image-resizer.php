<?php
/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize($thumb, '', 140, 110, true);
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */

if(!function_exists('vt_resize')) {
	
	function vt_resize($attach_id = null, $img_url = null, $width, $height, $crop = false) {
		
			$img = ($attach_id) ? wp_get_attachment_image_src($attach_id, 'full') : $img_url;
			
			// default output - without resizing
			$vt_image = array (
				'url' => get_stylesheet_directory_uri() . "/thumb.php?src={$img}&h={$height}&w={$width}&c={$crop}",
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}
} 

?>