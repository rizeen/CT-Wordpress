<?php
/**
 * CT Custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CT_Custom
 */

add_filter('use_block_editor_for_post', '__return_false', 10);

// Enqueue CSS for homepage.php template
function enqueue_homepage_styles() {
    if (is_page_template('homepage.php')) {
        wp_enqueue_style('homepage-style', get_template_directory_uri() . '/css/homepage.css', array(), '1.0', 'all');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_homepage_styles');

// Register Theme Settings including Logo Image
add_action('admin_init', 'register_theme_settings');
function register_theme_settings(){
    register_setting('theme-settings-group', 'logo_image');
    register_setting('theme-settings-group', 'phone_number');
    register_setting('theme-settings-group', 'address_info');
    register_setting('theme-settings-group', 'fax_number');

	register_setting('theme-settings-group', 'facebook_url');
    register_setting('theme-settings-group', 'twitter_url');
    register_setting('theme-settings-group', 'linkedin_url');
    register_setting('theme-settings-group', 'pinterest_url');
}

// Define a shortcode to display the phone number option
function display_phone_number_shortcode() {
    return get_option('phone_number');
}
add_shortcode('display_phone_number', 'display_phone_number_shortcode');

// Define a shortcode to display the address option
function display_address_shortcode() {
    $address = get_option('address_info');
    $address_with_line_breaks = nl2br($address); // Convert line breaks to <br> tags
    return $address_with_line_breaks;
}
add_shortcode('display_address', 'display_address_shortcode');

// Define a shortcode to display the fax number option
function display_fax_number_shortcode() {
    return get_option('fax_number');
}
add_shortcode('display_fax_number', 'display_fax_number_shortcode');

// Add Theme Support for Custom Logo
add_theme_support('custom-logo');

// Add Theme Options Page to Admin Menu
add_action('admin_menu', 'theme_settings_menu');
function theme_settings_menu(){
    add_menu_page('Theme Settings', 'Theme Settings', 'manage_options', 'theme-settings', 'theme_settings_page');
}

// Enqueue Media Scripts
add_action('admin_enqueue_scripts', 'enqueue_media_scripts');
function enqueue_media_scripts(){
    if(isset($_GET['page']) && $_GET['page'] === 'theme-settings'){
        wp_enqueue_media(); // Enqueue media scripts for image upload
    }
}

// Define Theme Settings Page Content
function theme_settings_page(){
    ?>
    <div class="wrap" id="theme_settings_page">
        <h1>Theme Settings</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php settings_fields('theme-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Logo Image</th>
                    <td>
                        <?php
                        $logo_image_id = get_option('logo_image');
                        $logo_image_url = wp_get_attachment_image_src($logo_image_id, 'full');
                        ?>
                        <img id="logo_preview" src="<?php echo esc_url($logo_image_url[0]); ?>" style="max-width: 200px;" />
                        <input type="hidden" name="logo_image" id="logo_image" value="<?php echo esc_attr($logo_image_id); ?>" />
                        <button type="button" class="button button-secondary" id="upload_logo_image">Upload Image</button>
                        <button type="button" class="button button-secondary" id="remove_logo_image">Remove Image</button>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row">Phone Number</th>
                    <td><input style="width: 100%; max-width: 500px;" type="text" name="phone_number" value="<?php echo esc_attr(get_option('phone_number')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Address Information</th>
                    <td><textarea style="width: 100%; max-width: 500px;" name="address_info" rows="4"><?php echo esc_textarea(get_option('address_info')); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Fax Number</th>
                    <td><input style="width: 100%; max-width: 500px;" type="text" name="fax_number" value="<?php echo esc_attr(get_option('fax_number')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Social Media Links</th>
                    <td>
                        <input style="width: 100%; max-width: 500px;" type="text" name="facebook_url" placeholder="Facebook URL" value="<?php echo esc_attr(get_option('facebook_url')); ?>" /><br>
                        <input style="width: 100%; max-width: 500px;" type="text" name="twitter_url" placeholder="Twitter URL" value="<?php echo esc_attr(get_option('twitter_url')); ?>" /><br>
                        <input style="width: 100%; max-width: 500px;" type="text" name="linkedin_url" placeholder="LinkedIn URL" value="<?php echo esc_attr(get_option('linkedin_url')); ?>" /><br>
                        <input style="width: 100%; max-width: 500px;" type="text" name="pinterest_url" placeholder="Pinterest URL" value="<?php echo esc_attr(get_option('pinterest_url')); ?>" /><br>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($){
        $('#upload_logo_image').click(function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('#logo_image').val(uploaded_image.toJSON().id);
                $('#logo_preview').attr('src', image_url);
            });
        });

        $('#remove_logo_image').click(function(e){
            e.preventDefault();
            $('#logo_image').val('');
            $('#logo_preview').attr('src', '');
        });
    });
    </script>
    <?php
}

if ( ! function_exists( 'ct_custom_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ct_custom_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CT Custom, use a find and replace
		 * to change 'ct-custom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ct-custom', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ct-custom' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ct_custom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ct_custom_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ct_custom_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ct_custom_content_width', 640 );
}
add_action( 'after_setup_theme', 'ct_custom_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ct_custom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ct-custom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ct-custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ct_custom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ct_custom_scripts() {
	wp_enqueue_style( 'ct-custom-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ct-custom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ct-custom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_custom_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
