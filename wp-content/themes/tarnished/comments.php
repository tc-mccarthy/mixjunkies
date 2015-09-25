<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if(post_password_required()) { ?>
		
	<?php
		return;
	}
	
?>

<?php

/*************************** Comment Template ***************************/

function comment_template($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
	<div id="comment-<?php comment_ID(); ?>" class="comment-box">

		<div class="comment-avatar">
			<?php echo get_avatar($comment,$size='60',$default=get_template_directory_uri().'/images/gravatar.png'); ?>
			<span class="post-author"><?php echo gp_post_author; ?></span>
		</div>
		
		<div class="comment-body">
			
			<div class="comment-author">
				<?php printf(__('%s'), comment_author_link()) ?>
			</div>
			
			<div class="comment-date">
				<?php comment_time('d F y'); ?>, <?php comment_time('g:ia'); ?>
			</div>
		
			<div class="comment-text">
				<?php comment_text() ?>
				<?php if($comment->comment_approved == '0') { ?>
					<div class="error">
						<?php echo gp_moderation; ?>
					</div>
				<?php } ?>
			</div>
			
			<div class="reply-link">
				<?php comment_reply_link(array_merge($args, array('reply_text' => gp_reply, 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div>
			
		</div>	
		
	</div>

<?php } ?>	
				
<!--Begin Comments-->
<?php if('open' == $post->comment_status OR have_comments()) { ?>
	<div class="clear"></div><div class="divider"></div>
	
	<div id="comments">
<?php } ?>

	<?php if(have_comments()) { // If there are comments ?>
		
		<h3 class="comments"><?php comments_number(gp_no_comments, gp_one_comment, gp_more_comments); ?></h3>
		
		<ol id="commentlist">
			<?php wp_list_comments('callback=comment_template'); ?>
		</ol>
							
		<?php $total_pages = get_comment_pages_count(); if($total_pages > 1) { ?>
			<div class="wp-pagenavi"><?php paginate_comments_links(); ?></div>
		<?php } ?>	

		<?php if('open' == $post->comment_status) { // If comments are open, but there are no comments yet ?>
		
		<?php } else { // If comments are closed ?>
		
			<?php if(is_single()) { ?><h4><?php echo gp_comments_closed ?></h4><?php } ?>
	
		<?php } ?>
		
	<?php } else { // If there are no comments yet ?>
	
	<?php } ?>

	<?php if('open' == $post->comment_status) { ?>
	
		<!--Begin Comment Form-->
		<div id="commentform">
			
			<!--Begin Respond-->
			<div id="respond">
			
				<h3><?php comment_form_title(gp_leave_reply, gp_respond); ?></h3>
			
				<div class="cancel-comment-reply"><?php cancel_comment_reply_link(gp_cancel_reply); ?></div>
			
				<?php if(get_option('comment_registration') && !$user_ID) { ?>
			
					<p><?php echo gp_login_to_comment ?></p>
			
				<?php } else { ?>
			
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
			
					<?php if ($user_ID) { ?>
			
						<p><?php echo gp_logged_in_as ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> <a href="<?php echo wp_logout_url(get_permalink()); ?>">(<?php echo gp_logout ?>)</a></p>
			
					<?php } else { ?>
			
						<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /> <label for="author"><?php echo gp_name ?> <span class="required"><?php if ($req) echo "*"; ?></span></label></p>
			
						<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /> <label for="email"><?php echo gp_email ?> <span class="required"><?php if ($req) echo "*"; ?></span></label></p>
						
						<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /> <label for="url"><?php echo gp_website ?></label></p>
						
					<?php } ?>
						
					<p><textarea name="comment" id="comment" cols="5" rows="7" tabindex="4"></textarea></p>
					
					<input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo gp_post ?>" />
	
					<?php comment_id_fields(); ?>
		
					<?php do_action('comment_form', $post->ID); ?>
			
					</form>
	
				<?php } ?>
	
			</div>
			<!--End Respond-->
		
		</div>
		<!--End Comment Form-->
	
	<?php } ?>


<?php if('open' == $post->comment_status OR have_comments()) { ?>
	</div>
<?php } ?>
<!--End Comments-->