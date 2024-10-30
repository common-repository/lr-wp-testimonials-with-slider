<?php
/**
 * Plugin Name: LR WP Testimonials with slider
 * Version: 1.0
 * Description: Easy and best way to display client's testimonial on your website with slider. 
 * Author: Logicrays
 * Text Domain: lrwp-testimonial-slider
 */ 
define("lrwp-testimonial-slider","lrwp-testimonial-slider" );
define('lrwp_plugin_url', plugins_url('', __FILE__));
ini_set('allow_url_fopen',1);

add_action('admin_menu' , 'lrwp_settings_page');
function lrwp_settings_page() {
	 add_submenu_page(
        'edit.php?post_type=lrwp_testimonial',
        __('Settings', 'lrwp-testimonial-slider'),
        __('Settings', 'lrwp-testimonial-slider'),
        'manage_options',
        'lrwp-setting-page',
       'lrwp_setting_page');
}
function lrwp_action_links( $links ) {
 $links = array_merge( array(
  '<a href="' . esc_url( admin_url( '/edit.php?post_type=lrwp_testimonial&page=lrwp-setting-page' ) ) . '">' . __( 'Settings', 'lrwp-testimonial-slider' ) . '</a>'
 ), $links );
 return $links;
}
add_action( 'plugin_action_links_' . plugin_basename(__FILE__), 'lrwp_action_links' );
function lrwp_setting_page(){?>
<div class="wrap">
  <div class="icon32" id="icon-options-general"><br>
  </div>
  <h2>Logicrays WP Testimonials Settings</h2>
  <h3>== Shortcode ==</h3>
  <h4><strong style="font-weight:700">For style 1:</strong> [LRWP-STYLE1] &nbsp; <strong style="font-weight:700">For style 2:</strong> [LRWP-STYLE2] &nbsp; <strong style="font-weight:700">For style 3:</strong> [LRWP-STYLE3] &nbsp; <strong style="font-weight:700">For style 4:</strong> [LRWP-STYLE4] </h4>
  <form action="options.php" method="post">
    <?php
	settings_fields("section");
	?>
    <?php
	do_settings_sections("testimon-options");
	submit_button();
	?>
  </form>
</div>
<?php
}
add_action("admin_init", "lrwp_team_fields");
function lrwp_team_fields()
{
add_settings_section("section", "", null, "testimon-options");	
add_settings_field("lrwp_layout_type", "Select style", "lrwp_layout_type_element", "testimon-options", "section");
add_settings_field("lrwp_loop_value", "Loop", "lrwp_loop_element", "testimon-options", "section");
add_settings_field("lrwp_set_margin", "Set margin", "lrwp_set_margin_element", "testimon-options", "section");
add_settings_field("lrwp_show_nav_true", "Show pagination(dots)?", "lrwp_show_nav_element", "testimon-options", "section");
add_settings_field("lrwp_smartspeed", "Auto play Timeout", "lrwp_smartspeed_element", "testimon-options", "section");
add_settings_field("lrwp_autoplay", "Autoplay?", "lrwp_autoplay_element", "testimon-options", "section");
	
	register_setting("section", "lrwp_layout_type");
	register_setting("section", "lrwp_loop_value");
	register_setting("section", "lrwp_set_margin");
	register_setting("section", "lrwp_show_nav_true");
	register_setting("section", "lrwp_smartspeed");
	register_setting("section", "lrwp_autoplay");	
}
$lrwp_layout_type = get_option('lrwp_layout_type');
if($lrwp_layout_type['lrwp_layout_type'] == '1'){
	include_once 'includes/lrwp-style1.php';
	add_action( 'wp_head', 'lrwp_style1' );
}
if($lrwp_layout_type['lrwp_layout_type'] == '2'){
	include_once 'includes/lrwp-style2.php';
	add_action( 'wp_head', 'lrwp_style2' );
}
if($lrwp_layout_type['lrwp_layout_type'] == '3'){
	include_once 'includes/lrwp-style3.php';
	add_action( 'wp_head', 'lrwp_style3' );
}
if($lrwp_layout_type['lrwp_layout_type'] == '4'){
	include_once 'includes/lrwp-style4.php';
	add_action( 'wp_head', 'lrwp_style4' );
}
function lrwp_style() {
	wp_enqueue_script('jquery');
    wp_enqueue_script('owl-carousel-pack',lrwp_plugin_url.'/js/owl.carousel.min.js', array('jquery'));
	wp_enqueue_style('bootstrap-grid-min', lrwp_plugin_url.'/css/bootstrap-grid.min.css');
	wp_enqueue_style('owl-carousel-min', lrwp_plugin_url.'/css/owl.carousel.min.css');
	wp_enqueue_style('owl-theme-min', lrwp_plugin_url.'/css/owl.theme.default.min.css');
	wp_enqueue_style('font-awesome-min', lrwp_plugin_url.'/css/font-awesome.min.css');
}
add_action( 'wp_head', 'lrwp_style' );
function lrwp_style1() {
	wp_enqueue_style('testimonials-style1', lrwp_plugin_url.'/css/style1.css');	
}
function lrwp_style2() {
	wp_enqueue_style('testimonials-style2', lrwp_plugin_url.'/css/style2.css');
}
function lrwp_style3() {
	wp_enqueue_style('testimonials-style3', lrwp_plugin_url.'/css/style3.css');
}
function lrwp_style4() {
	wp_enqueue_style('testimonials-style4', lrwp_plugin_url.'/css/style4.css');
}
add_action( 'init', 'lrwp_teams_post_type' );
function lrwp_teams_post_type() {
    $labels = array(
        'name' => 'LR Testimonial',
        'singular_name' => 'LR Testimonial',
        'add_new' => 'Add New Testimonial',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Teams Testimonial',
        'not_found' =>  'No Testimonial found',
        'not_found_in_trash' => 'No TeaTestimonialms in the trash',
		'featured_image' => __( 'Client Image' ),
		'set_featured_image' => __( 'Set Client Image' ),
		'remove_featured_image' => __( 'Remove Client Image' ),
		'use_featured_image' => __( 'Use as Client Image' )
    );
    register_post_type( 'lrwp_testimonial', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 10,
        'supports' => array( 'title', 'thumbnail','editor' ),
  		'register_meta_box_cb' => 'lrwp_add_testimonials_metaboxes',
    ) );
}
function lrwp_add_testimonials_metaboxes(){
 add_meta_box('lrwp_client_details','Client Details','lrwp_client_details_callback','lrwp_testimonial','normal','high');
}
add_action('add_meta_boxes', 'lrwp_add_testimonials_metaboxes');

function lrwp_client_details_callback( $post ) {
    wp_nonce_field( 'lrwp_testimonials_metabox_nonce', 'lrwp_testimonials_nonce'); ?>
<?php         
    $lrwp_cname = get_post_meta( $post->ID, 'lrwp_cname', true );
    $lrwp_cemail   = get_post_meta( $post->ID, 'lrwp_cemail', true );
	$lrwp_compname   = get_post_meta( $post->ID, 'lrwp_compname', true );
	$lrwp_comwebsite   = get_post_meta( $post->ID, 'lrwp_comwebsite', true );
  ?>
  <p>
  <label for="lrwp_position">
    <?php _e('Client Fullname', 'lrwp-testimonial-slider' ); ?>
  </label>
  <br/>
  <input type="text" class="widefat" name="lrwp_cname" value="<?php echo esc_attr( $lrwp_cname ); ?>" />
</p>
<p>
  <label for="lrwp_position">
    <?php _e('Email', 'lrwp-testimonial-slider' ); ?>
  </label>
  <br/>
  <input type="text" class="widefat" name="lrwp_cemail" value="<?php echo esc_attr( $lrwp_cemail ); ?>" />
</p>
<p>
  <label for="lrwp_position">
    <?php _e('Comapny name', 'lrwp-testimonial-slider' ); ?>
  </label>
  <br/>
  <input type="text" class="widefat" name="lrwp_compname" value="<?php echo esc_attr( $lrwp_compname ); ?>" />
</p>
<p>
  <label for="lrwp_position">
    <?php _e('Company website', 'lrwp-testimonial-slider' ); ?>
  </label>
  <br/>
  <input type="text" class="widefat" name="lrwp_comwebsite" value="<?php echo esc_attr( $lrwp_comwebsite ); ?>" />
</p>
<?php }

function lrwp_teams_save_meta( $post_id ) {

  if( !isset( $_POST['lrwp_testimonials_nonce'] ) || !wp_verify_nonce( $_POST['lrwp_testimonials_nonce'],'lrwp_testimonials_metabox_nonce') ) 
    return;
  if ( !current_user_can( 'edit_post', $post_id ))
    return;
  if ( isset($_POST['lrwp_cname']) ) {        
    update_post_meta($post_id, 'lrwp_cname', sanitize_text_field( $_POST['lrwp_cname']));      
  }
  if ( isset($_POST['lrwp_cemail']) ) {        
    update_post_meta($post_id, 'lrwp_cemail', sanitize_text_field( $_POST['lrwp_cemail']));      
  }
  if ( isset($_POST['lrwp_compname']) ) {        
    update_post_meta($post_id, 'lrwp_compname', sanitize_text_field( $_POST['lrwp_compname']));      
  }
  if ( isset($_POST['lrwp_comwebsite']) ) {        
    update_post_meta($post_id, 'lrwp_comwebsite', sanitize_text_field( $_POST['lrwp_comwebsite']));      
  }
}
add_action('save_post', 'lrwp_teams_save_meta');

function lrwp_layout_type_element()
{ $options = get_option('lrwp_layout_type');?>
<select id="lrwp_loop_value" name='lrwp_layout_type[lrwp_layout_type]'>
  <option value='1'<?php selected($options['lrwp_layout_type'], '1'); ?>>
  <?php _e('Style 1','lrwp-testimonial-slider'); ?>
  </option>
  <option value='2'<?php selected($options['lrwp_layout_type'], '2'); ?>>
  <?php _e('Style 2','lrwp-testimonial-slider'); ?>
  </option>
  <option value='3'<?php selected($options['lrwp_layout_type'], '3'); ?>>
  <?php _e('Style 3','lrwp-testimonial-slider'); ?>
  </option>
  <option value='4'<?php selected($options['lrwp_layout_type'], '4'); ?>>
  <?php _e('Style 4','lrwp-testimonial-slider'); ?>
  </option>
</select>
<p class="description">
  <?php _e( 'Select layout type.'); ?>
</p>
<?php
}
function lrwp_loop_element()
{ 
$options = get_option('lrwp_loop_value');
?>
<select id="lrwp_loop_value" name='lrwp_loop_value[lrwp_loop_value]'>
  <option value='true'<?php selected($options['lrwp_loop_value'], 'true'); ?>>
  <?php _e('Yes','lrwp-testimonial-slider'); ?>
  </option>
  <option value='false'<?php selected($options['lrwp_loop_value'], 'false'); ?>>
  <?php _e('No','lrwp-testimonial-slider'); ?>
  </option>
</select>
<p class="description">
  <?php _e( 'Select loop true or false.'); ?>
</p>
<?php
}
function lrwp_set_margin_element()
{	$options = get_option('lrwp_set_margin');
?>
<input type="text" name="lrwp_set_margin" size='40' id="lrwp_set_margin" value="<?php echo esc_attr(get_option('lrwp_set_margin')); ?>" />
<p class="description">
  <?php _e( 'Please enter marign Eg. 5px 10px etc' ); ?>
</p>
<?php
}

function lrwp_smartspeed_element()
{	$options = get_option('lrwp_smartspeed');
?>
<input type="text" name="lrwp_smartspeed" size='40' id="lrwp_smartspeed" value="<?php echo esc_attr(get_option('lrwp_smartspeed')); ?>" />
<p class="description">
  <?php _e( 'Please enter speed Eg. 3000, 4000, etc' ); ?>
</p>
<?php
}
function lrwp_show_nav_element()
{
$options = get_option('lrwp_show_nav_true');
?>
<select id="lrwp_show_nav_true" name='lrwp_show_nav_true[lrwp_show_nav_true]'>
  <option value='true' <?php selected( $options['lrwp_show_nav_true'], 'true' ); ?>>
  <?php _e( 'Yes', 'lrwp-testimonial-slider'); ?>
  </option>
  <option value='false' <?php selected( $options['lrwp_show_nav_true'], 'false' ); ?>>
  <?php _e( 'No', 'lrwp-testimonial-slider'); ?>
  </option>
</select>
<p class="description">
  <?php _e( 'Select pagination(dots) true or false.' ); ?>
</p>
<?php }
function lrwp_autoplay_element()
{
$options = get_option('lrwp_autoplay');
?>
<select id="lrwp_autoplay" name='lrwp_autoplay[lrwp_autoplay]'>
  <option value='true' <?php selected( $options['lrwp_autoplay'], 'true' ); ?>>
  <?php _e( 'Yes', 'lrwp-testimonial-slider'); ?>
  </option>
  <option value='false' <?php selected( $options['lrwp_autoplay'], 'false' ); ?>>
  <?php _e( 'No', 'lrwp-testimonial-slider'); ?>
  </option>
</select>
<p class="description">
  <?php _e( 'Select autoplay true or false.' ); ?>
</p>
<?php }