<style>

/* Body Text Size */
<?php if($theme_body_text_size) { ?>
body {
font-size: <?php echo $theme_body_text_size; ?>px;
}
<?php } ?>

/* Heading Text Size */
<?php if($theme_h1_text_size) { ?>
h1 {
font-size: <?php echo $theme_h1_text_size; ?>px;
}
<?php } ?>
<?php if($theme_h2_text_size) { ?>
h2,
.portfolio-three-col h2,
.portfolio-two-col h2,
.portfolio-large h2,
.portfolio-grid h2 {
font-size: <?php echo $theme_h2_text_size; ?>px;
}
<?php } ?>
<?php if($theme_h3_text_size) { ?>
h3 {
font-size: <?php echo $theme_h3_text_size; ?>px;
}
<?php } ?>
<?php if($theme_h4_text_size) { ?>
h4 {
font-size: <?php echo $theme_h4_text_size; ?>px;
}
<?php } ?>
<?php if($theme_h5_text_size) { ?>
h5 {
font-size: <?php echo $theme_h5_text_size; ?>px;
}
<?php } ?>
<?php if($theme_h6_text_size) { ?>
h6 {
font-size: <?php echo $theme_h6_text_size; ?>px;
}
<?php } ?>

/* Logo Text Size */
<?php if($theme_logo_text_size) { ?>
#logo h1 a {
font-size: <?php echo $theme_logo_text_size; ?>px;
}
<?php } ?>

/* Sidebar Heading Text Size */
<?php if($theme_sidebar_heading_text_size) { ?>
.widget h3 {
font-size: <?php echo $theme_sidebar_heading_text_size; ?>px;
}
<?php } ?>

/* Sidebar Text Size */
<?php if($theme_sidebar_text_size) { ?>
.widget {
font-size: <?php echo $theme_sidebar_text_size; ?>px;
}
<?php } ?>

/* Footer Heading Text Size */
<?php if($theme_footer_heading_text_size) { ?>
.footer-widget-inner h3 {
font-size: <?php echo $theme_footer_heading_text_size; ?>px;
}
<?php } ?>

/* Footer Text Size */
<?php if($theme_footer_text_size) { ?>
.footer-widget-inner {
font-size: <?php echo $theme_footer_text_size; ?>px;
}
<?php } ?>

/* Footer Copyright Text Size */
<?php if($theme_footer_copyright_text_size) { ?>
#copyright {
font-size: <?php echo $theme_footer_copyright_text_size; ?>px;
}
<?php } ?>

/* Nav Text Size */
<?php if($theme_nav_text_size) { ?>
#nav ul li a {
font-size: <?php echo $theme_nav_text_size; ?>px;
}
<?php } ?>

/* Dropdown Text Size */
<?php if($theme_dropdown_text_size) { ?>
#nav .sub-menu a {
font-size: <?php echo $theme_dropdown_text_size; ?>px;
}
<?php } ?>

/* Meta Text Size */
<?php if($theme_meta_text_size) { ?>
.post-meta,
.related-date,
.comment-date {
font-size: <?php echo $theme_meta_text_size; ?>px;
}
<?php } ?>

/* Post Author Text Size */
<?php if($theme_post_author_text_size) { ?>
.post-creator {
font-size: <?php echo $theme_post_author_text_size; ?>px;
}
<?php }


/*******************************************************************************/

?>

/* Header Background Image */
<?php if($theme_header_bg_image) { ?>
#header-background {
background: url(<?php echo $theme_header_bg_image; ?>) repeat;
}
<?php } ?>

/* Header Border Color */
<?php if($theme_header_border_color) { ?>
#header-border {
background-color: <?php echo $theme_header_border_color; ?>;
}
<?php } ?>

/* Body Text Color */
<?php if($theme_body_text_color) { ?>
body {
color: <?php echo $theme_body_text_color; ?>;
}
<?php } ?>

/* Link Color */
<?php if($theme_link_color) { ?>
a {
color: <?php echo $theme_link_color; ?>;
}
<?php } ?>

/* Link Hover Color */
<?php if($theme_link_hover_color) { ?>
a:hover {
color: <?php echo $theme_link_hover_color; ?>;
}
<?php } ?>

/* Heading Text Color */
<?php if($theme_heading_text_color) { ?>
h1, h2, h3, h4, h5, h6 {
color: <?php echo $theme_heading_text_color; ?>;
}
<?php } ?>

/* Heading Link Color */
<?php if($theme_heading_link_color) { ?>
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
color: <?php echo $theme_heading_link_color; ?>;
}
<?php } ?>

/* Heading Link Hover Color */
<?php if($theme_heading_link_hover_color) { ?>
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
color: <?php echo $theme_heading_link_hover_color; ?>;
}
<?php } ?>

/* Logo Background Color */
<?php if($theme_logo_bg_color) { ?>
#logo {
background-color: <?php echo $theme_logo_bg_color; ?>;
}
<?php } ?>

/* Logo Text Color */
<?php if($theme_logo_text_color) { ?>
#logo h1 a {
color: <?php echo $theme_logo_text_color; ?>;
}
<?php } ?>

/* Misc Color 1 */
<?php if($theme_misc_bg_color_1 OR $theme_misc_border_color_1) { ?>
.separate > div,
.joint > div,
table,
td,
.gallery img {
background-color: <?php echo $theme_misc_bg_color_1; ?>;
border-color: <?php echo $theme_misc_border_color_1; ?> !important;
}
<?php } ?>

/* Misc Color 2 */
<?php if($theme_misc_bg_color_2 OR $theme_misc_border_color_2) { ?>
th,
code,
pre {
background-color: <?php echo $theme_misc_bg_color_2; ?>;
border-color: <?php echo $theme_misc_border_color_2; ?>;
}
<?php } ?>

/* Sidebar Text Color */
<?php if($theme_sidebar_text_color) { ?>
.widget {
color: <?php echo $theme_sidebar_text_color; ?>;
}
<?php } ?>

/* Sidebar Link Color */
<?php if($theme_sidebar_link_color) { ?>
.widget a {
color: <?php echo $theme_sidebar_link_color; ?>;
}
<?php } ?>

/* Sidebar Link Hover Color */
<?php if($theme_sidebar_link_hover_color) { ?>
.widget a:hover {
color: <?php echo $theme_sidebar_link_hover_color; ?>;
}
<?php } ?>

/* Sidebar Heading Text Color */
<?php if($theme_sidebar_heading_text_color) { ?>
.widget h3, .widget h3 a, .widget h3 a:hover {
color: <?php echo $theme_sidebar_heading_text_color; ?>;
}
<?php } ?>

/* Copyright Text Color */
<?php if($theme_footer_copyright_text_color) { ?>
#copyright {
color: <?php echo $theme_footer_copyright_text_color; ?>;
}
<?php } ?>

/* Footer Wrapper Background Color */
<?php if($theme_footer_bg_color) { ?>
#footer,
#footer-border {
background-color: <?php echo $theme_footer_bg_color; ?>;
}
<?php } ?>

/* Footer Wrapper Text Color */
<?php if($theme_footer_text_color) { ?>
#footer {
color: <?php echo $theme_footer_text_color; ?>;
}
<?php } ?>

/* Footer Link Color */
<?php if($theme_footer_link_color) { ?>
#footer a {
color: <?php echo $theme_footer_link_color; ?>;
}
<?php } ?>

/* Footer Link Hover Color */
<?php if($theme_footer_link_hover_color) { ?>
#footer a:hover {
color: <?php echo $theme_footer_link_hover_color; ?>;
}
<?php } ?>

/* Footer Heading Text Color */
<?php if($theme_footer_header_text_color) { ?>
#footer h3,
#footer h3 a,
#footer h3 a:hover {
color: <?php echo $theme_footer_header_text_color; ?>;
}
<?php } ?>

/* Footer Divider Color */
<?php if($theme_footer_divider_color) { ?>
#footer li {
border-color: <?php echo $theme_footer_divider_color; ?> !important;
}
<?php } ?>

/* Nav Link Color */
<?php if($theme_nav_link_color) { ?>
#nav ul li a {
color: <?php echo $theme_nav_link_color; ?>;
}
<?php } ?>

/* Nav Link Hover Color */
<?php if($theme_nav_link_hover_color) { ?>
#nav ul li a:hover {
color: <?php echo $theme_nav_link_hover_color; ?>;
}
<?php } ?>

/* Nav Link Selected Color */
<?php if($theme_nav_link_selected_color) { ?>
#nav ul .current-menu-item > a,
#nav ul .current-menu-ancestor > a {
color: <?php echo $theme_nav_link_selected_color; ?>;
}
<?php } ?>

/* Meta Text Color */
<?php if($theme_meta_text_color) { ?>
.post-meta,
.related-date,
.comment-date {
color: <?php echo $theme_meta_text_color; ?>;
}
<?php } ?>

/* Meta Link Color */
<?php if($theme_meta_link_color) { ?>
.post-meta a,
.related-date a,
.comment-date a {
color: <?php echo $theme_meta_link_color; ?>;
}
<?php } ?>

/* Meta Link Hover Color */
<?php if($theme_meta_link_hover_color) { ?>
.post-meta a:hover,
.related-date a:hover,
.comment-date a:hover {
color: <?php echo $theme_meta_link_hover_color; ?>;
}
<?php } ?>

/* Post Author Text Color */
<?php if($theme_post_author_text_color) { ?>
.post-creator a,
.post-creator a:hover {
color: <?php echo $theme_post_author_text_color; ?>;
}
<?php } ?>

/* Divider Color */
<?php if($theme_divider_color) { ?>
ul li,
.sidebar,
.divider,
.post-meta,
#commentlist .comment {
border-color: <?php echo $theme_divider_color; ?> !important;
}
<?php } ?>

/* Input Box Background Color */
<?php if($theme_input_bg_color) { ?>
input, select, textarea {
background-color: <?php echo $theme_input_bg_color; ?>;
}
<?php } ?>

/* Input Box Text Color */
<?php if($theme_input_text_color) { ?>
input, select, textarea {
color: <?php echo $theme_input_text_color; ?>;
}
<?php } ?>

/* Input Box Border Color */
<?php if($theme_input_border_color) { ?>
input, select, textarea {
border-color: <?php echo $theme_input_border_color; ?>;
}
<?php } ?>

/* Submit Box Background Color */
<?php if($theme_submit_bg_color) { ?>
input[type="submit"],
input[type="reset"] {
background-color: <?php echo $theme_submit_bg_color; ?>;
}
<?php } ?>

/* Submit Box Background Hover Color */
<?php if($theme_submit_bg_hover_color) { ?>
input[type="submit"]:hover,
input[type="reset"]:hover {
background-color: <?php echo $theme_submit_bg_hover_color; ?>;
}
<?php } ?>

/* Submit Box Text Color */
<?php if($theme_submit_text_color) { ?>
input[type="submit"],
input[type="reset"] {
color: <?php echo $theme_submit_text_color; ?>;
}
<?php } ?>

/* Slider Caption Dark Text Color */
<?php if($theme_caption_dark_text_color) { ?>
.caption-dark h2,
.caption-dark {
color: <?php echo $theme_caption_dark_text_color; ?>;
}
<?php } ?>

/* Slider Caption Light Text Color */
<?php if($theme_caption_light_text_color) { ?>
.caption-light h2,
.caption-light {
color: <?php echo $theme_caption_light_text_color; ?>;
}
<?php } ?>

</style>