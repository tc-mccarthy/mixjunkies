<?php
/*
Plugin Name: Fullwidth Audio Player
Plugin URI: http://dj-templates.com/
Description: Add a fixed audio player to any page on your wordpress site. Create your playlists and add them into the player or anywhere in your wordpress site.
Version: 1.1
Author: Rafael Dery
Author URI: http://dj-templates.com/
*/


if(!class_exists('FullwidthAudioPlayer')) {
	class FullwidthAudioPlayer {
		
		private $default_general_options = array( 'player_visibility' => 1,
												  'play_css_class' => 'fap-play-button',
												  'referral_css_class' => 'fap-referral-button',
												  'play_button_text' => 'Play',
												  'referral_button_text' => 'Buy',
												  'login_text' => 'Log in to download',
												  'login_to_download' => 0,
												  'list_image_width' => 100,
												  'list_image_height' => 100,
												  'grid_image_width' => 200,
												  'grid_image_height' => 200,
												  'base64' => 0,
												  'public_posts' => 0
		                                		);
		                                		
		private $default_audioplayer_options = array( 'default_playlist' => 'none',
		        									  'wrapper_position' => 'bottom',
		        									  'main_position' => 'center',
		        									  'wrapper_color' => '#2B2B2B',
		        									  'main_color' => '#ffffff',
		        									  'fill_color' => '#ec0537',
		        									  'fill_hover_color' => '#101010',
		        									  'meta_color' => '#666666',
		        									  'stroke_color' => '#373737',
		        									  'active_track_color' => '#191919',
		        									  'wrapper_height' => 70,
		        									  'playlist_height' => 210,
		        									  'cover_width' => 50,
		        									  'cover_height' => 50,
		        									  'offset' => 20,
		        									  'facebook_text' => 'Share on Facebook',
		        									  'twitter_text' => 'Share on Twitter',
		        									  'soundcloud_text' => 'Check on Souncloud',
		        									  'download_text' => 'Download',
		        									  'opened' => 1,
		        									  'volume' => 1,
		        									  'playlist' => 1,
		        									  'autoPlay' => 0,
		        									  'autoLoad' => 1,
		        									  'playNextWhenFinished' => 1,
		        									  'keyboard' => 1,
		        									  'socials' => 1,
		        									  'auto_popup' => 0,
		        									  'randomize' => 0,
		        									  'shuffle' => 1,
		        									  'init_on_window' => 0,
		        									  'sortable' => 0,
		        									  'responsive_layout' => 0
		                                		);
		private $default_playlist;
		private $activate_demo = false;
				
		//constants
		const CAPABILITY = 'edit_fullwidth_audio_player';
		const VERSION = '1.0.5';
		const VERSION_FIELD_NAME = 'fullwidth_audio_player_version';
						
		//Constructer
		public function __construct() {
								
			register_activation_hook( __FILE__, array( &$this, 'activate_fap_plugin' ) );
		
			//action hooks
			add_action( 'after_setup_theme', array( &$this, 'setup_fap' ) );
			add_action( 'init', array( &$this,'init_plugin') );
			add_action( 'admin_init', array( &$this,'init_admin' ) );
			add_action( 'plugins_loaded', array( &$this,'check_version' ) );
			add_action( 'admin_menu', array( &$this,'add_pp_sub_pages' ) );
			add_action( 'add_meta_boxes', array( &$this, 'add_custom_box' ) );
			add_action( 'save_post', array( &$this,'update_custom_meta_fields' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'posts_custom_column' ), 10, 2 );
			add_action( 'wp_enqueue_scripts', array( &$this,'add_scripts_styles' ) );
			add_action( 'wp_footer', array( &$this,'include_fap_frontend' ) );
			
			//filters
			add_filter( 'manage_track_posts_columns', array( &$this, 'add_custom_columns' ) );
			
			//shortcodes
			add_shortcode( 'fap_track', array( &$this, 'create_single_track' ) );
			add_shortcode( 'fap_playlist', array( &$this, 'create_playlist' ) );
			add_shortcode( 'fap_default_playlist', array( &$this, 'change_default_playlist' ) );
			add_shortcode( 'fap', array( &$this, 'add_player' ) );
			
			//uncomment next line to delete the options from the DB
			//delete_option('fap_options');
			/*----------meta box-------*/
			//add_action('admin_menu', 'mytheme_add_box'); 
			//if ( is_admin() )
			//	add_action( 'load-post.php', 'call_someClass' );
			
			/* Fire our meta box setup function on the post editor screen. */
			/*-----------------------------------------*/
			/*----------------------------------*/
			//self::initialize();
		}
		
		public function activate_fap_plugin() {
			
			if( !get_option('fap_options') ) {
					                                				        
		        $default_fap_options = array( 'general' => $this->default_general_options,
		        							  'audioplayer' => $this->default_audioplayer_options
		                                	);
				
				add_option('fap_options', $default_fap_options );
			}
		
		}
		
		public function check_version() {
			
			if( get_option(FullwidthAudioPlayer::VERSION_FIELD_NAME) != FullwidthAudioPlayer::VERSION_FIELD_NAME) {
				//upgrade
				
				global $wpdb;
				$wpdb->query("UPDATE $wpdb->posts SET post_type='track' WHERE post_type='fap_track'");
			}
			    
		}
		
		public function setup_fap() {
		
			$fap_options = get_option('fap_options');
			$general_options = $fap_options['general'];
			
			add_theme_support('post-thumbnails');
			
			//CUSTOM POST TYPES
			$pp_labels = array(
			  'name' => _x('Tracks', 'post type general name', 'radykal'),
			  'singular_name' => _x('Track', 'post type singular name', 'radykal'),
			  'add_new' => _x('Add New', 'track', 'radykal'),
			  'add_new_item' => __('Add New Track', 'radykal'),
			  'edit_item' => __('Edit Track', 'radykal'),
			  'new_item' => __('New Track', 'radykal'),
			  'all_items' => __('All Tracks', 'radykal'),
			  'view_item' => __('View Track', 'radykal'),
			  'search_items' => __('Search Tracks', 'radykal'),
			  'not_found' =>  __('No Tracks found', 'radykal'),
			  'not_found_in_trash' => __('No Tracks found in Trash', 'radykal'), 
			  'parent_item_colon' => '',
			  'menu_name' => 'Fullwidth Audio Player'
		  
			);
		
			$pp_args = array(
			  'labels' => $pp_labels,
			  'public' => $this->int_to_bool($general_options['public_posts']),
			  'exclude_from_search' => false,
			  'show_ui' => true, 
			  'show_in_menu' => true, 
			  'has_archive' => true, 
			  'hierarchical' => false,
			  'menu_icon' => plugins_url( '/admin/images/menu_icon.png', __FILE__ ),
			  'supports' => array('title','editor','thumbnail', 'page-attributes', 'comments', 'custom_fields'),
			  'register_meta_box_cb' => array(&$this, 'add_meta_boxes')
			);
			
			register_post_type( 'track', $pp_args );
			
			
			//TAXONOMIES
			$tax_playlists_labels = array(
			  'name' => _x( 'Playlists', 'taxonomy general name', 'radykal' ),
			  'singular_name' => _x( 'Playlist', 'taxonomy singular name', 'radykal' ),
			  'search_items' =>  __( 'Search Playlists', 'radykal' ),
			  'all_items' => __( 'All Playlists', 'radykal' ),
			  'parent_item' => __( 'Parent Playlist', 'radykal' ),
			  'parent_item_colon' => __( 'Parent Playlist:', 'radykal' ),
			  'edit_item' => __( 'Edit Playlist', 'radykal' ), 
			  'update_item' => __( 'Update Playlist', 'radykal' ),
			  'add_new_item' => __( 'Add New Playlist', 'radykal' ),
			  'new_item_name' => __( 'New Playlist Name', 'radykal' ),
			  'menu_name' => __( 'Playlists', 'radykal' ),
			);
			
			register_taxonomy('dt_playlist', 'track', array(
			  'hierarchical' => true,
			  'labels' => $tax_playlists_labels,
			  'show_ui' => true,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => 'playlist' ),
			));
      
      register_taxonomy('dt_playlist', 'post', array(
			  'hierarchical' => true,
			  'labels' => $tax_playlists_labels,
			  'show_ui' => true,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => 'playlist' ),
			));
			
		}
		
		public function init_plugin() {
			
			//load textdomain	
			load_plugin_textdomain('radykal', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
			
		}
		
		public function init_admin() {
		
			$role = get_role( 'administrator' );
			$role->add_cap( FullwidthAudioPlayer::CAPABILITY ); 
			
		}
		
		public function add_pp_sub_pages() {
			
			//add options page
			$options_page = add_submenu_page( 'edit.php?post_type=track', __('Options', 'radykal'), __('Options', 'radykal'), FullwidthAudioPlayer::CAPABILITY, 'fap-options', array($this, 'options_admin_page') );
			add_action( "load-{$options_page}", array( &$this,'load_options_page' ) );
	
			add_action('admin_print_styles-' . $options_page, array( &$this,'enqueue_fap_options_styles' ) );
		  add_action('admin_print_scripts-' . $options_page, array( &$this,'enqueue_fap_options_scripts' ) );
			
		   
		}
		
		//enqueue styles for the option pages
		public function enqueue_fap_options_styles() {
	
			wp_enqueue_style( 'jquery-uniform-aristo', plugins_url( "/admin/css/uniform.aristo.css", __FILE__ ) );
			wp_enqueue_style( 'eyecon-colorpicker', plugins_url( "/admin/css/colorpicker.css", __FILE__ ) );
			wp_enqueue_style( 'fap-options', plugins_url( "/admin/css/options.css", __FILE__ ), array('thickbox') );
			
		}
		
		//enqueue scripts for the option pages
		public function enqueue_fap_options_scripts() {
			
			wp_enqueue_script( 'jquery-uniform', plugins_url( " /admin/js/jquery.uniform.min.js", __FILE__ ) );
			wp_enqueue_script( 'eyecon-colorpicker', plugins_url( " /admin/js/colorpicker.js", __FILE__ ) );
			wp_enqueue_script( 'fap-options', plugins_url( " /admin/js/options.js", __FILE__ ), array('media-upload', 'thickbox') );
			
		}
		
		public function options_admin_page () {
			
			global $pagenow;
			
			//get options
			$fap_options = get_option('fap_options');
			$general_options = $fap_options['general'];
			$audioplayer_options = $fap_options['audioplayer'];
			
			?>
			
			<div class="wrap">
				<h2>Options</h2>
				
				<?php
				    //get tab
				    if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; 
							else $tab = 'general';
					
					$this->options_admin_tabs($tab);		
							
				    
					if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>'.ucfirst($tab).' Options updated.</p></div>';
				?>
		
				<div id="tab-content">
					<form method="post" action="<?php admin_url( 'edit.php?post_type=track&page=fap-options' ); ?>">
						<?php
						wp_nonce_field( "fap-options-page" );
						
						if ( $pagenow == 'edit.php' && $_GET['page'] == 'fap-options' ){ 
							//include corresponding options page
							include_once(dirname(__FILE__)  .'/admin/'.$tab.'.php');
						}
						
						if($tab != 'support') :
						?>
		                <p class="description"><?php _e('Always save before switching to another tab!', 'radykal'); ?></p>
						<p style="clear: both;">
						<input type="submit" name="save_fap_options" class="button-primary" value="<?php _e('Save Changes', 'radykal'); ?>" <?php disabled( !current_user_can(FullwidthAudioPlayer::CAPABILITY) ); ?> />
						<input type="submit" name="reset_fap_options" class="button-secondary" value="<?php _e('Reset Options', 'radykal'); ?>" <?php disabled( !current_user_can(FullwidthAudioPlayer::CAPABILITY) ); ?> />
						</p>
		                <?php endif; ?>
		                <br />
		                <p><?php _e('Check out <a href="http://dj-templates.com" target="_blank">dj-templates.com</a> for more items for Djs and Producer. Follow me at <a href="http://www.facebook.com/pages/dj-templatescom/163102803744768" target="_blank">Facebook</a> and <a href="http://twitter.com/#!/djtemplates" target="_blank">Twitter</a> for new products, updates and news!', 'radykal'); ?>
		                </p>
					</form>
				</div>
			</div>
			<?php

		}
		
		public function options_admin_tabs( $current = 'homepage' ) { 

		    $tabs = array( 'general' => 'General', 'audioplayer' => 'Audio Player', 'support' => 'Support' ); 
			
		    echo '<div id="icon-themes" class="icon32"><br></div>';
		    echo '<h2 class="nav-tab-wrapper">';
		    foreach( $tabs as $tab => $name ){
		        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
		        echo "<a class='nav-tab$class' href='?post_type=track&page=fap-options&tab=$tab'>$name</a>";
		        
		    }
		    echo '</h2>';
			
		}
		
		public function load_options_page() {
	
			if ( isset($_POST["save_fap_options"]) || isset($_POST["reset_fap_options"]) ) {
				check_admin_referer( "fap-options-page" );
				$this->save_options();
				$url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
				wp_redirect(admin_url('edit.php?post_type=track&page=fap-options&'.$url_parameters));
				exit;
			}
			
		}
		
		public function save_options() {
	
			global $pagenow;
			if ( $pagenow == 'edit.php' && $_GET['page'] == 'fap-options' ){ 
			
				if ( isset ( $_GET['tab'] ) )
			        $tab = $_GET['tab']; 
			    else
			        $tab = 'general'; 
			    
			    if( isset($_POST["reset_fap_options"]) ) {
			    	
			    	switch( $tab ){ 
				        case 'general' :
				        	$tab_options = $this->default_general_options;
						break; 
				        case 'audioplayer' :
				        	$tab_options = $this->default_audioplayer_options;
						break;
				    }
				    
			    }
			    else if( isset($_POST["save_fap_options"]) ) {
					foreach($_POST as $key => $value) {
		        		$tab_options[$key] = $value;
		        	}
			    }
			    
			}
		    
			//update options associated to the selected tab
			$options = get_option( "fap_options" );
			$options[$tab] = $tab_options;
			update_option( 'fap_options', $options );
			
		}
		
		//add meta box in the "Add New Track" page
		public function add_meta_boxes() {
		
			wp_enqueue_script('fap-admin-new-track', plugins_url('/admin/js/new-track.js', __FILE__));
			
			add_meta_box('fap-meta-box', __('Track URL & Referral Link', 'radykal'), array( &$this, 'create_meta_box'), 'track', 'normal', 'high');
			
		}
		
		//add meta box in the post and page
		public function add_custom_box() {
		
			wp_enqueue_script('fap-admin-metabox', plugins_url('/admin/js/metabox.js', __FILE__));
			
			add_meta_box( 'fap-tracklists-meta-box', __('Fullwidth Audio Player - Your Playlists', 'radykal'), array( &$this, 'create_tracklists_meta_box'), 'post', 'side' );
			add_meta_box( 'fap-tracklists-meta-box', __('Fullwidth Audio Player - Your Playlists', 'radykal'), array( &$this, 'create_tracklists_meta_box'), 'page', 'side' );
			
			add_meta_box( 'post-tracklists-meta-box-1', __('Track Meta Box', 'radykal'), array( &$this, 'create_track_meta_box'), 'post', 'normal' );
			//add_action( 'save_post', 'scmsg_save_post_class_meta', 10, 2 );
		}
		/* Save the meta box's post metadata. */
		/*function scmsg_save_post_class_meta( $post_id, $post ) {
		
			die('post type:.....>');
			$post_type = get_post_type_object( $post->post_type );
			die('post type:------>'.$post_type);
			
		}*/
		//added scm 
		//HTML meta box for the post
		public function create_track_meta_box() {
				global $post;
				$custom_fields = get_post_custom($post->ID);
				?>
        <label for="post_track_url"></label><?php _e('<strong>Required</strong> - Set here the URL of the MP3 or the Soundcloud track(s):', 'radykal') ?></label>
        	<!--<input type="text" name="post_track_url" value="<?//php echo esc_attr( get_post_meta( $object->ID, 'speed', true ) ); ?>" class="widefat" /><br /><br />-->
          <input type="text" name="post_track_url" value="<?php echo $custom_fields["wpfap_track_url"][0]; ?>" class="widefat" /><br /><br />
          
        <label for="post_tweet_opt"></label><?php _e('<strong>Required</strong> - Tweet Text:', 'radykal') ?></label>
        	<input type="text" name="post_tweet_opt" value="<?php echo $custom_fields["wpfap_tweet_text"][0]; ?>" class="widefat" /><br /><br />  
        
        <label for="post_player_shortcode"></label><?php _e('<strong>Required</strong> - Short Code to Initialize Player in Post:', 'radykal') ?></label>
          <input type="text" name="post_player_shortcode" readonly="readonly" value="[fap_track layout='list' enqueue='no']" class="widefat" /><br /><br />  
        <?
				//add_action( 'save_post', 'scmsg_save_post_class_meta', 10, 2 );		
		}
		//HTML meta box for the "Add New Track" page
		public function create_meta_box() {
			
			global $post;
			$custom_fields = get_post_custom($post->ID);
			
			?>
			
			<label for="fap_track_url"></label><?php _e('<strong>Required</strong> - Set here the URL of the MP3 or the Soundcloud track(s):', 'radykal') ?></label>
			<input type="text" name="fap_track_url" value="<?php echo $custom_fields["fap_track_url"][0]; ?>" class="widefat" /><br /><br />
			
			<label  for="fap_referral_link"></label><?php _e('<strong>Optional</strong> - Set here the referral link that should be shared on facebook and twitter:', 'radykal') ?></label>
			<input type="text" name="fap_referral_link" value="<?php echo $custom_fields["fap_referral_link"][0]; ?>" class="widefat" />
			
			<?php
		}
		
		//HTML meta box for the post and page
		public function create_tracklists_meta_box() {
			
			?>
			<p class="description"><?php _e('Here you can add a playlist to your page or change the default playlist for the player.', 'radykal'); ?></p>
			<p>
				<p><strong><?php _e('1. Select a playlist', 'radykal'); ?></strong></p>
				<select id="fap-playlists">
	      			<?php 
	      			$playlists = get_terms('dt_playlist');
					if ( count($playlists) > 0 ){
						echo "<ul>";
					    foreach ( $playlists as $playlist ) {
					    	echo '<option value="'.$playlist->term_id.'">' . $playlist->name . '</option>';
					    }
					    echo "</ul>";
					}
	      			?>
	      		</select>
      		</p>
      		<hr />
      		<p>
      			<p><strong><?php _e('2.1 Add a playlist to this page', 'radykal'); ?></strong></p>
      			<p class="description"><?php _e('Choice a layout:', 'radykal'); ?></p>
	      		<input type="radio" name="fap_layout" value="list" checked="checked" style="margin-right: 5px;" />
	          	<img src="<?php echo plugins_url('/admin/images/list.png', __FILE__); ?>" alt="List Icon" />
	          	<input type="radio" name="fap_layout" value="grid" style="margin: 0 5px 0 10px;" />
	          	<img src="<?php echo plugins_url('/admin/images/grid.png', __FILE__); ?>" alt="Grid Icon" />
	          	<input type="radio" name="fap_layout" value="simple" style="margin: 0 5px 0 10px;" />
	          	<img src="<?php echo plugins_url('/admin/images/simple_list.png', __FILE__); ?>" alt="Simple List Icon" />
	          	<input type="radio" name="fap_layout" value="hidden" style="margin: 0 5px 0 10px;" />
	          	<span>Hide</span>
	          	<br /><br />
	          	<input type="checkbox" name="fap_enqueue" value="1" /> <span class="description"><?php _e('Enqueue playlist into the player', 'radykal'); ?></span>
	          	<br /><br />
	          	<span class="description"><?php _e('Set a text for the playlist play button. If you do not want this button, just leave it empty:', 'radykal'); ?></span>
	          	<input type="text" name="fap_play_playlist" value="" class="widefat" />
          	</p>
      		<a href="#" id="fap-add-playlist" class="button-secondary"><?php _e('Add Playlist', 'radykal') ?></a><br /><br />
      		<hr />
      		<p><strong><?php _e('2.2 Change the default playlist for this page', 'radykal'); ?></strong></p>
      		<a href="#" id="fap-change-default-playlist" class="button-secondary"><?php _e('Change Default Playlist', 'radykal') ?></a>
      		<br /><br />
      		<?php
		}
		
		public function update_custom_meta_fields()	{
	
			//disable autosave,so custom fields will not be empty
			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		        return $post_id;
			
			global $post;
			update_post_meta($post->ID, "fap_track_url", trim($_POST["fap_track_url"]));
			update_post_meta($post->ID, "fap_referral_link", trim($_POST["fap_referral_link"]));
			update_post_meta($post->ID, "fap_track_shortcode", '[fap_track id="'.$post->ID.'" layout="list" enqueue="no"]');
      update_post_meta($post->ID, "wpfap_track_url", trim($_POST["post_track_url"]));
      update_post_meta($post->ID, "wpfap_tweet_text", trim($_POST["post_tweet_opt"]));
			///
			//added scm 
			//update_post_meta($post->ID, "post_track_url", trim($_POST["post_track_url"]));
			/*$track_url = trim($_POST["post_track_url"]);
			if($track_url != "" || $track_url == NULL){
				update_option('wpfap_track_url_'.$post->ID,$track_url);
			}
			else{
				add_option('wpfap_track_url_'.$post->ID,$track_url);
			}
			///
			$tweet_text = trim($_POST["post_tweet_opt"]);
			if($tweet_text != "" || $tweet_text == NULL){
				update_option('wpfap_tweet_text_'.$post->ID,$tweet_text);
			}
			else{
				add_option('wpfap_tweet_text_'.$post->ID,$tweet_text);
			}*/
			//die('pt-'.trim($_POST["post_track_url"]));
			///
		}
		
		//create custom column shortcode
		public function add_custom_columns( $defaults ) {
			
			unset($defaults['date']);
		    $defaults['shortcode'] = __('Shortcode', 'radykal');
			$defaults['date'] = __('Date', 'radykal');
		    return $defaults;
			
		}
		
		//add associated data to column
		public function posts_custom_column( $column_name, $id ) {
			
			global $typenow;
		    if ( $typenow=='track' ) {
		        echo get_post_meta( $id, 'fap_track_shortcode', true );
		    }
		    			
		}
		
		//include all styles and scripts for the player
		public function add_scripts_styles() {
			
			if( !is_admin() ) {
				
				$options = get_option('fap_options');
				$audio_player_options = $options['audioplayer'];
				
				wp_enqueue_style( 'fullwidth-audio-player-tracks', plugins_url('/css/fullwidthAudioPlayer-tracks-up.css', __FILE__) );
				wp_enqueue_style( 'fullwidth-audio-player', plugins_url('/css/jquery.fullwidthAudioPlayer.min.css', __FILE__) );
				
				if($this->int_to_bool($audio_player_options['responsive_layout']))
					wp_enqueue_style( 'fullwidth-audio-player-responsive', plugins_url('/css/jquery.fullwidthAudioPlayer-responsive.css', __FILE__) );
				
				wp_enqueue_script( 'soundmanager-2', plugins_url('/js/soundmanager2-nodebug-jsmin.js', __FILE__) );
				//wp_enqueue_script( 'fullwidth-audio-player', plugins_url('/js/jquery.fullwidthAudioPlayer.min.js', __FILE__), array('jquery', 'jquery-ui-draggable', 'jquery-ui-sortable'), '1.1' );
				wp_enqueue_script( 'fullwidth-audio-player', plugins_url('/js/jquery.fullwidthAudioPlayer.js', __FILE__), array('jquery', 'jquery-ui-draggable', 'jquery-ui-sortable'), '1.1' );
        wp_enqueue_script( 'jquery-popup-window', plugins_url('/js/jquery-popup.js', __FILE__) );
			}
		
		}
		
		//shorcode handler for a single track container
		public function create_single_track( $atts ) {
			//die(print_r($atts));
			global $post;
			
			//die('id-'.$post->ID);
			extract( shortcode_atts( array(
				//'id' => 0,
				'id' => $post->ID,
				'layout' => 'grid',
				'enqueue' => false
			), $atts ) );
			
			$this->demo_panel();
	  //die('ID:'.$id);
		//die(print_r($this->get_track_wrapper( $id, $layout, $enqueue )));
			///return $this->get_track_wrapper( $id, $layout, $enqueue );///
			return $this->get_track_wrapper_post( $id, $layout, $enqueue );
		}
		
		//shortcode handler for a tracklist
		public function create_playlist( $atts ) {
		
			extract( shortcode_atts( array(
				'id' => 0,
				'layout' => 'grid', //grid,list,simple,hide
				'enqueue' => 'no', //yes,no
				'play_playlist_button' => '' //empty or custom text for the button
			), $atts ) );
			
			$args = array(
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'dt_playlist',
						'field' => 'id',
						'terms' => $id
					)
				)
			);
			
			$options = get_option('fap_options');
			$general_options = $options['general'];
			
			$query = new WP_Query( $args );
			$output = '';
			if($play_playlist_button != '')
				$output .= '<input type="submit" value="'.$play_playlist_button.'" class="fap-play-playlist '.$general_options['play_css_class'].'" />';
						
			$output .= '<ul class="fap-external-tracklist-'.$layout.' clearfix">';
			
			//loop starts
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					//die(print_r($this->get_track_wrapper( get_the_ID(), $layout, $enqueue )));
					$output .= '<li>'.$this->get_track_wrapper( get_the_ID(), $layout, $enqueue ).'</li>';
				}
			} 
			
			wp_reset_query();	
			
			$output .= '</ul>';
			//loop ends
			
			$this->demo_panel();
		
			return $output;
			
		}
		
		//shorcode handler for a add the player into a page, just return nothing
		public function add_player() {

			return '';
		}
		
		//shorcode handler for changing the default playlist
		public function change_default_playlist( $atts ) {
		
			extract( shortcode_atts( array(
				'id' => 0
			), $atts ) );
			
			$this->default_playlist = $id;
			
			$this->demo_panel();

			return '';
		}
		// added by scm
		//returns a track container
		public function get_track_wrapper_post( $post_id, $layout, $enqueue ) {
			//die('post_id='.$post_id);
			global $post;
			//die(print_r($post));
			$thumbnail_image="";
			if ( has_post_thumbnail( $post->ID) ) {
				$thumbnail_image = get_the_post_thumbnail($post->ID, $layout == 'list' ? array($general_options['list_image_width'], $general_options['list_image_height']) : array($general_options['grid_image_width'], $general_options['grid_image_height']) );
				
			}
			
			if(!get_post($post_id))
				return;
			///
			//$track = get_option('wpfap_track_url_'.$post_id);
			//$post_text = get_option('wpfap_tweet_text_'.$post_id);
			//die('T='.$post_text);
			///				
			$options = get_option('fap_options');
			$general_options = $options['general'];
			
			$track_post = get_post( $post_id );
			///die(print_r($track_post));
			$custom_fields = get_post_custom( $post_id );
			$track = $custom_fields['wpfap_track_url'][0];
      //print_r($track);
      $post_text = $custom_fields["wpfap_tweet_text"][0];
			$enqueue_class = $enqueue == "yes" ? 'fap-enqueue-track' : '';
			
			$title = str_replace('-', '&ndash;', $track_post->post_title);
			$image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ), 'thumbnail');
	        $cover = $image_attributes[0];
            //$cover = $custom_fields['ghostpool_thumbnail'][0];
			$meta = '';
			$referral_link = '';
			$post_img_src = '';
			//die();
			if( !empty( $track_post->post_content ) ) {
        $post_cont = str_replace('[fap_track layout=\'list\' enqueue=\'no\']', '', $track_post->post_content);
        $post_cont = str_replace('[fap_track layout=\'list\' enqueue=\'yes\']', '', $post_cont);
        $post_cont = preg_replace('[fap_playlist id="(?P<digit>\d+)" layout="list" enqueue="(?P<name>\w+)" play_playlist_button=""]', 'wpfaptckcont', $post_cont);
        $post_cont = str_replace('[wpfaptckcont]', '', $post_cont);
				//$meta = '<span id="fap-meta-'.$post_id.'" style="display: none;">'.$track_post->post_content.'</span>';
				preg_match( "/<img src=[\"'](.+?)[\"']/", $post_cont, $matches);
				$post_img_src =  $matches[1];
				//die(print_r($matches[1]));  // this print out the link to the image 
				$meta = '<input type="hidden" id="hdnimgsrc" value="'.$custom_fields['ghostpool_thumbnail'][0].'" \>';
				//
				$post_cont = preg_replace("/<img[^>]+\>/i", " ", $post_cont); 
				//
        $meta .= '<span id="fap-meta-'.$post_id.'" style="display: none;">'.$post_cont.'</span>';
			}
			
			if( !empty( $custom_fields['fap_referral_link'][0] ) ) {
				if( !is_user_logged_in() && $general_options['login_to_download'] ) {
					$referral_link = '<a href="'.wp_login_url( "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'] ).'" title="'.$general_options['login_text'].'" class="'.$general_options['referral_css_class'].'">'.$general_options['login_text'].'</a>';
				}
				else {
					$referral_link = '<a href="'.$custom_fields['fap_referral_link'][0].'" target="_blank" class="'.$general_options['referral_css_class'].'">'.$general_options['referral_button_text'].'</a>';
				}				
			}
			
			if($layout == 'list' || $layout == 'grid') {
				$thumbnail_dom = '';
				
				if ( has_post_thumbnail( $post_id ) ) {
					$thumbnail_dom = get_the_post_thumbnail($post_id, $layout == 'list' ? array($general_options['list_image_width'], $general_options['list_image_height']) : array($general_options['grid_image_width'], $general_options['grid_image_height']) );
					
				}
				
				 $post_cont = str_replace('[fap_track layout=\'list\' enqueue=\'no\']', '', $track_post->post_content);
				 $post_cont = preg_replace("/<img[^>]+\>/i", " ", $post_cont); 
				 $post_cont = str_replace(' ', '', $post_cont);
				 
				 $output .= "<div id='fb-root'></div>";
				$trckqr = array('postid' => urlencode($post_id));
        $newtrk = base64_encode(serialize($trckqr));
        $ppurl = plugins_url('pwap-sc1.php?id='.$newtrk, __FILE__);
        
        $output .= '<div class="fap-track-'.$layout.' playit">
				
					<div id="player">
					'.do_shortcode('[audio src="'.$track.'"]').'</div>
					<!--a href="'.($this->int_to_bool($general_options['base64']) ? base64_encode($track) : $track).'" title="'.$title .'" rel="'.$cover.'" target="'.$track.'" data-meta="#fap-meta-'.$post_id.'" class="'.$general_options['play_css_class'].' '.$enqueue_class.' fap-single-track play"></a-->'.$referral_link.'
					<a href="'.$ppurl.'" class="popupwindow blkBtn download"><span></span> DOWNLOAD NOW</a>
					<!-- <div id="tweetdv" class="fap-track-buttons" style="width:170px; float:left;">
            <a href="http://twitter.com/intent/tweet?text=test%20text">pay with a tweet</a>
					</div>
					<div class="fap-track-buttons" style="width:150px; float: left; border: solid 1px #CCCCCC;">
						<img src="'.plugins_url('/admin/images/fb-icon.jpg', __FILE__).'" style="margin-bottom:-3px;margin-left:3px;" />
						<a class="competition-fb-share" onclick="postToFeed(); return false;" href=""> <span class="FBConnectButton FBConnectButton_Small" style="cursor:pointer;"><span class="FBConnectButton_Text">pay with a share</span></span></a>
					</div> -->
					
					'.$meta.'
				</div>
				<p class="notWork"><span>Now working? Please tweet or contact us and we will fix it.</span>
				<a href="https://twitter.com/share" class="twitter-share-button" data-text="#mjbroke please fix" data-via="mixjunkies" data-count="none">Tweet</a>
				</p>
				';
        return $output;
				
			}
			else {
				return '<a href="'.($this->int_to_bool($general_options['base64']) ? base64_encode($track) : $track).'" title="'.$title.'" rel="'.$cover.'" target="'.$track.'" data-meta="#fap-meta-'.$post_id.'" class="fap-track-'.$layout.' '.$enqueue_class.' fap-single-track">'.$title .'</a>'.$meta.'';
			}
		
		}
		
		//returns a track container
		public function get_track_wrapper( $post_id, $layout, $enqueue ) {
			//die('post_id='.$post_id);
			
			if(!get_post($post_id))
				return;
			///
			//$track = get_option('wpfap_track_url_'.$post_id);
			//$post_text = get_option('wpfap_tweet_text_'.$post_id);
			//die('T='.$post_text);
			///				
			$options = get_option('fap_options');
			$general_options = $options['general'];
			
			$track_post = get_post( $post_id );
			///die(print_r($track_post));
			$custom_fields = get_post_custom( $post_id );
      $track = $custom_fields["wpfap_track_url"][0];
      $post_text = $custom_fields["wpfap_tweet_text"][0];
			
			$enqueue_class = $enqueue == "yes" ? 'fap-enqueue-track' : '';
			
			$title = str_replace('-', '&ndash;', $track_post->post_title);
			$image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post_id ), 'thumbnail');
	        //$cover = $image_attributes[0];
      $cover = $custom_fields['ghostpool_thumbnail'][0];
			$meta = '';
			$referral_link = '';
			//die();
			if( !empty( $track_post->post_content ) ) {
				$ntrccont = preg_replace('[fap_playlist id="(?P<digit>\d+)" layout="list" enqueue="(?P<name>\w+)" play_playlist_button=""]', 'wpfaptckcont', $track_post->post_content);
        $ntrccont = str_replace('[wpfaptckcont]', '', $ntrccont);
        $ntrccont = str_replace('[fap_track layout=\'list\' enqueue=\'no\']', '', $ntrccont);
        $ntrccont = str_replace('[fap_track layout=\'list\' enqueue=\'yes\']', '', $ntrccont);
        $ntrccont = preg_replace("/<img[^>]+\>/i", "", $ntrccont);
				$meta = '<span id="fap-meta-'.$post_id.'" style="display: none;">'.$ntrccont.'</span>';
			}
			
			if( !empty( $custom_fields['fap_referral_link'][0] ) ) {
				if( !is_user_logged_in() && $general_options['login_to_download'] ) {
					$referral_link = '<a href="'.wp_login_url( "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'] ).'" title="'.$general_options['login_text'].'" class="'.$general_options['referral_css_class'].'">'.$general_options['login_text'].'</a>';
				}
				else {
					$referral_link = '<a href="'.$custom_fields['fap_referral_link'][0].'" target="_blank" class="'.$general_options['referral_css_class'].'">'.$general_options['referral_button_text'].'</a>';
				}				
			}
			
			if($layout == 'list' || $layout == 'grid') {
				$thumbnail_dom = '';
				
				if ( has_post_thumbnail( $post_id ) ) {
					$thumbnail_dom = get_the_post_thumbnail($post_id, $layout == 'list' ? array($general_options['list_image_width'], $general_options['list_image_height']) : array($general_options['grid_image_width'], $general_options['grid_image_height']) );
					
				}
        $trccont = preg_replace('[fap_playlist id="(?P<digit>\d+)" layout="list" enqueue="(?P<name>\w+)" play_playlist_button=""]', 'wpfaptckcont', $track_post->post_content);
        $trccont = str_replace('[wpfaptckcont]', '', $trccont);
        $trccont = str_replace('[fap_track layout=\'list\' enqueue=\'no\']', '', $trccont);
        $trccont = str_replace('[fap_track layout=\'list\' enqueue=\'yes\']', '', $trccont);
        $trccont = preg_replace("/<img[^>]+\>/i", "", $trccont);
				return '<div class="fap-track-'.$layout.' clearfix">
				'.$thumbnail_dom.'
				<div>
					<h3>'.$track_post->post_title.'</h3>
					<div>'.$trccont.'</div>
					<div class="fap-track-buttons"><a href="'.($this->int_to_bool($general_options['base64']) ? base64_encode($custom_fields['wpfap_track_url'][0]) : $custom_fields['wpfap_track_url'][0]).'" title="'.$title .'" rel="'.$cover.'" target="'.$custom_fields['fap_referral_link'][0].'" data-meta="#fap-meta-'.$post_id.'" class="'.$general_options['play_css_class'].' '.$enqueue_class.' fap-single-track">'.$general_options['play_button_text'].'</a>'.$referral_link.'
					</div>
					'.$meta.'
				</div>
				</div>';
				
			}
			else {
				return '<a href="'.($this->int_to_bool($general_options['base64']) ? base64_encode($custom_fields['wpfap_track_url'][0]) : $custom_fields['wpfap_track_url'][0]).'" title="'.$title.'" rel="'.$cover.'" target="'.$custom_fields['fap_referral_link'][0].'" data-meta="#fap-meta-'.$post_id.'" class="fap-track-'.$layout.' '.$enqueue_class.' fap-single-track">'.$title .'</a>'.$meta.'';
			}
		
		}
		//setup player in frontend
		public function include_fap_frontend() {
		
		?>
			<script type="text/javascript">
				//config soundmanager
				soundManager.url = "<?php echo plugins_url('/swf/', __FILE__); ?>"; 
			 	soundManager.flashVersion = 9; 
			 	soundManager.useHTML5Audio = true;
			</script>
		
		<?php
			
			$options = get_option('fap_options');
			$general_options = $options['general'];
			
			global $post;
			
			//add player only in frontend, when player visibility is set to true or a shortcode for this plugin are found			
			if( !is_admin() && ( !empty($general_options['player_visibility']) || strpos($post->post_content,'[fap') !== false ) ) {
				?>
				<!-- HTML starts here -->
				<div id="fullwidthAudioPlayer" style="display: none;">
				
				<?php
				//get options
				
				$audio_player_options = $options['audioplayer'];
				
				if($this->activate_demo && isset($_POST['enable_popup'])) {
					$audio_player_options['wrapper_position'] = 'popup';
					$audio_player_options['auto_popup'] = $this->int_to_bool($_POST['demo_auto_popup']);
				}
				
				$args = array(
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'posts_per_page' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'dt_playlist',
							'field' => 'id',
							'terms' => $this->default_playlist ? $this->default_playlist : $audio_player_options['default_playlist']
						)
					)
				);
				$query = new WP_Query( $args );
				
				//loop starts
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
				
				//get custom fields
                $custom_fields = get_post_custom( get_the_ID() );

                //get cover if one is set
                $cover = '';
                if( has_post_thumbnail() ) {
                	$image_attributes = wp_get_attachment_image_src ( get_post_thumbnail_id ( get_the_ID() ), 'thumbnail');
                	$cover = $image_attributes[0];
                }
                
                //get description text
                $content = get_the_content();
                $meta_id = 'fap-meta-'.get_the_ID();
				?>
				<a href="<?php echo $this->int_to_bool($general_options['base64']) ? base64_encode($custom_fields['fap_track_url'][0]) : $custom_fields['fap_track_url'][0]; ?>" title="<?php the_title(); ?>" target="<?php echo $custom_fields['fap_referral_link'][0]; ?>" 
				rel="<?php echo $cover; ?>" data-meta="#<?php echo $meta_id; ?>"></a>
				
				<!-- Set description text if track has one -->
				<?php if( !empty($content) ): ?>
				<span id="<?php echo $meta_id; ?>" ><?php the_content(); ?></span>
				<?php endif; ?>
				
				<?php endwhile; endif; wp_reset_query(); ?>				
				</div>
				<!-- HTML ends here -->
				<?php
        $post_id= get_the_ID();        
        $trckqr = array('postid' => urlencode($post_id));
        $newtrk = base64_encode(serialize($trckqr));
        $ppurl = plugins_url('pwap-sc1.php?id='.$newtrk, __FILE__);
        ?>
				<script type="text/javascript">
				
					<?php if($this->int_to_bool($audio_player_options['init_on_window'])): ?>
					jQuery(window).load(function(){
					<?php else: ?>
					jQuery(document).ready(function(){
					<?php endif; ?>
					$ = jQuery.noConflict();
					
					setTimeout(function() {
						
						jQuery('#fullwidthAudioPlayer').fullwidthAudioPlayer({
							opened: <?php echo $this->int_to_bool($audio_player_options['opened']); ?>,
							volume: <?php echo $this->int_to_bool($audio_player_options['volume']); ?>,
							playlist: <?php echo $this->int_to_bool($audio_player_options['playlist']); ?>, 
							autoPlay: <?php echo $this->int_to_bool($audio_player_options['autoPlay']); ?>, 
							autoLoad:<?php echo $this->int_to_bool($audio_player_options['autoLoad']); ?>,
							playNextWhenFinished: <?php echo $this->int_to_bool($audio_player_options['playNextWhenFinished']); ?>,
							keyboard: <?php echo $this->int_to_bool($audio_player_options['keyboard']); ?>,
							socials: <?php echo $this->int_to_bool($audio_player_options['socials']); ?>, 
							wrapperColor: '<?php echo $audio_player_options['wrapper_color']; ?>',
							mainColor: '<?php echo $audio_player_options['main_color']; ?>',
							fillColor: '<?php echo $audio_player_options['fill_color']; ?>',
							metaColor: '<?php echo $audio_player_options['meta_color']; ?>',
							strokeColor: '<?php echo $audio_player_options['stroke_color']; ?>',
							fillColorHover: '<?php echo $audio_player_options['fill_hover_color']; ?>',
							activeTrackColor: '<?php echo $audio_player_options['active_track_color']; ?>',
							wrapperPosition: window.fapPopupWin ? 'popup' : '<?php echo $audio_player_options['wrapper_position']; ?>', 
							mainPosition: '<?php echo $audio_player_options['main_position']; ?>',
							height: <?php echo $audio_player_options['wrapper_height']; ?>,
							playlistHeight: <?php echo $audio_player_options['playlist_height']; ?>,
							coverSize: [<?php echo $audio_player_options['cover_width']; ?>,<?php echo $audio_player_options['cover_height']; ?>],
							offset: <?php echo $audio_player_options['offset']; ?>,
							twitterText: '<?php echo $audio_player_options['twitter_text']; ?>',
							facebookText: '<?php echo $audio_player_options['facebook_text']; ?>',
							soundcloudText: '<?php echo $audio_player_options['soundcloud_text']; ?>',
							downloadText: '<?php echo $audio_player_options['download_text']; ?>',
							popupUrl: '<?php echo plugins_url('popup.html', __FILE__);  ?>',
							autoPopup: <?php echo $this->int_to_bool($audio_player_options['auto_popup']); ?>,
							randomize: <?php echo $this->int_to_bool($audio_player_options['randomize']); ?>,
							shuffle:<?php echo $this->int_to_bool($audio_player_options['shuffle']); ?>,
							base64: <?php echo $this->int_to_bool($general_options['base64']); ?>,
							sortable: <?php echo $this->int_to_bool($audio_player_options['sortable']); ?>,
              posturls: <?php echo json_encode(get_permalink(get_the_ID()));?>
						});
					}, <?php echo $this->activate_demo ? 201 : 0; ?>);
						
						$('#fullwidthAudioPlayer').bind('onFapReady', function(evt, trackData) { 
							jQuery('.fap-play-playlist').click(function() {
								var tracks = jQuery(this).next('ul').children('li').find('.fap-single-track');
								tracks.each(function(i, track) {
									var $track = $(track);
									$.fullwidthAudioPlayer.addTrack($track.attr('href'), $track.attr('title'), $('body').find($track.data('meta')).html(), $track.attr('rel'), $track.attr('target'), i == 0);
								});
							});
						});
					
					});
          function mixpopup(){
              var w = 760;
              var h = 450;
              var left = (screen.width/2)-(w/2);
              var top = (screen.height/2)-(h/2);

              window.open('<?php echo $ppurl;?>', "mixjunkies","width="+w+", height="+h+", top="+top+", left="+left+"");
              return false;
          }
          
          function facebookpopup(){
              var w = 760;
              var h = 330;
              var left = (screen.width/2)-(w/2);
              var top = (screen.height/2)-(h/2);
              window.open('http://www.facebook.com/sharer.php?u=<?php echo get_permalink(get_the_ID());?>&t=<?php echo get_the_title(get_the_ID());?>', "mixjunkies","width="+w+", height="+h+", top="+top+", left="+left+"");
              return false;
          }
          
          function twtpopup(){
              var w = 760;
              var h = 450;
              var left = (screen.width/2)-(w/2);
              var top = (screen.height/2)-(h/2);
              window.open('http://twitter.com/share?url=<?php echo get_permalink(get_the_ID());?>&text=<?php echo get_the_title(get_the_ID());?>', "mixjunkies","width="+w+", height="+h+", top="+top+", left="+left+"");
              return false;
          }
				</script>

				<?php
			}
		
		}
		
		public function redirect_to_template() {
			global $wp, $post;
			if($wp->query_vars['post_type'] == 'track') {
				include(dirname(__FILE__). '/single-track.php');
				die();
			}
		}
		
		private function int_to_bool( $value ) {
			return empty($value) ? 0 : 1;
		}
		
		private function demo_panel() {
			if($this->activate_demo && !$this->demo_executed && !isset($_POST['enable_popup'])) {
			 	$this->demo_executed = true;
			 	
				?>
				<form action="" method="post" id="fap-demo-form">
					<h3>Try Pop-Up Player!</h3>
					<input type="checkbox" name="demo_auto_popup" value="1" /><label for="demo_auto_popup"> Auto Pop-Up</label><br />
					<input type="submit" name="enable_popup" value="Enable Pop-Up Player" class="fap-play-button" />
				</form>
				
				<?php
			}
		}
	}
}

//init Fullwidth Audio Player
if(class_exists('FullwidthAudioPlayer')) {
	$fap = new FullwidthAudioPlayer();
}

?>