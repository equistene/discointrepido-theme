<?php

/* NED FUNCTIONS */

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}


// Load Styles
function nedwp_enqueue_assets()
{
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    
    wp_enqueue_style('slick', get_template_directory_uri() . '/css/lib/slick.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style('base', get_template_directory_uri() . '/css/main.min.css', array(), '1.1.1', 'all');

    wp_enqueue_script('slick', get_template_directory_uri() . '/js/lib/slick.min.js', array('jquery'), '1.1.2');
    wp_enqueue_script('px-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.1.2');
  }
}


// REMOVE SHORTLINK
add_filter( 'get_shortlink', 'disable_stuff' );
function disable_stuff( $data ) {
return false;
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
//add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'nedwp_enqueue_assets');
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('user_can_richedit', '__return_true');

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


// Page Options
if( function_exists('acf_add_options_page') ) {
    
	acf_add_options_page(array(
			'page_title'    => 'Opciones de Tema',
			'menu_title'    => 'Opciones',
			'menu_slug'     => 'theme-general-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
	));
	
}

// Register Custom Post Type
function artistas() {

	$labels = array(
		'name'                  => _x( 'Artistas', 'Post Type General Name', 'artistas' ),
		'singular_name'         => _x( 'Artista', 'Post Type Singular Name', 'artistas' ),
		'menu_name'             => __( 'Artistas', 'artistas' ),
		'name_admin_bar'        => __( 'Artistas', 'artistas' ),
		'archives'              => __( 'Artistas Archive', 'artistas' ),
		'attributes'            => __( 'Item Attributes', 'artistas' ),
		'parent_item_colon'     => __( 'Parent Item:', 'artistas' ),
		'all_items'             => __( 'All Items', 'artistas' ),
		'add_new_item'          => __( 'Add New Item', 'artistas' ),
		'add_new'               => __( 'Agregar Artista', 'artistas' ),
		'new_item'              => __( 'Nuevo Artistas', 'artistas' ),
		'edit_item'             => __( 'Editar Artista', 'artistas' ),
		'update_item'           => __( 'Update Item', 'artistas' ),
		'view_item'             => __( 'View Item', 'artistas' ),
		'view_items'            => __( 'View Items', 'artistas' ),
		'search_items'          => __( 'Search Item', 'artistas' ),
		'not_found'             => __( 'Not found', 'artistas' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'artistas' ),
		'featured_image'        => __( 'Featured Image', 'artistas' ),
		'set_featured_image'    => __( 'Set featured image', 'artistas' ),
		'remove_featured_image' => __( 'Remove featured image', 'artistas' ),
		'use_featured_image'    => __( 'Use as featured image', 'artistas' ),
		'insert_into_item'      => __( 'Insert into item', 'artistas' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'artistas' ),
		'items_list'            => __( 'Items list', 'artistas' ),
		'items_list_navigation' => __( 'Items list navigation', 'artistas' ),
		'filter_items_list'     => __( 'Filter items list', 'artistas' ),
	);
	$args = array(
		'label'                 => __( 'Artista', 'artistas' ),
		'description'           => __( 'Artistas', 'artistas' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-star-empty',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'artistas', $args );

}
add_action( 'init', 'artistas', 0 );

// Sellos
function Sello() {

	$labels = array(
		'name'                       => _x( 'Sellos', 'Taxonomy General Name', 'sello' ),
		'singular_name'              => _x( 'Sello', 'Taxonomy Singular Name', 'sello' ),
		'menu_name'                  => __( 'Sello', 'sello' ),
		'all_items'                  => __( 'Todos los sellos', 'sello' ),
		'parent_item'                => __( 'Parent Item', 'sello' ),
		'parent_item_colon'          => __( 'Parent Item:', 'sello' ),
		'new_item_name'              => __( 'Nuevo Sello', 'sello' ),
		'add_new_item'               => __( 'Agregar Sello', 'sello' ),
		'edit_item'                  => __( 'Editar Sello', 'sello' ),
		'update_item'                => __( 'Update Item', 'sello' ),
		'view_item'                  => __( 'View Item', 'sello' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'sello' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'sello' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'sello' ),
		'popular_items'              => __( 'Popular Items', 'sello' ),
		'search_items'               => __( 'Search Items', 'sello' ),
		'not_found'                  => __( 'Not Found', 'sello' ),
		'no_terms'                   => __( 'No items', 'sello' ),
		'items_list'                 => __( 'Items list', 'sello' ),
		'items_list_navigation'      => __( 'Items list navigation', 'sello' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'sello', array( 'product' ), $args );

}
add_action( 'init', 'Sello', 0 );

// Register Custom Taxonomy
function Artista() {

	$labels = array(
		'name'                       => _x( 'Artistas', 'Taxonomy General Name', 'Artista' ),
		'singular_name'              => _x( 'Artista', 'Taxonomy Singular Name', 'Artista' ),
		'menu_name'                  => __( 'Artista', 'Artista' ),
		'all_items'                  => __( 'Artistas', 'Artista' ),
		'parent_item'                => __( 'Parent Item', 'Artista' ),
		'parent_item_colon'          => __( 'Parent Item:', 'Artista' ),
		'new_item_name'              => __( 'Nuevo Artista', 'Artista' ),
		'add_new_item'               => __( 'Nuevos Artistas', 'Artista' ),
		'edit_item'                  => __( 'Edit Item', 'Artista' ),
		'update_item'                => __( 'Update Item', 'Artista' ),
		'view_item'                  => __( 'View Item', 'Artista' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'Artista' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'Artista' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'Artista' ),
		'popular_items'              => __( 'Popular Items', 'Artista' ),
		'search_items'               => __( 'Search Items', 'Artista' ),
		'not_found'                  => __( 'Not Found', 'Artista' ),
		'no_terms'                   => __( 'No items', 'Artista' ),
		'items_list'                 => __( 'Items list', 'Artista' ),
		'items_list_navigation'      => __( 'Items list navigation', 'Artista' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'Artista', array( 'product' ), $args );

}
add_action( 'init', 'Artista', 0 );

// Register Custom Taxonomy
function Género() {

	$labels = array(
		'name'                       => _x( 'Géneros', 'Taxonomy General Name', 'genero' ),
		'singular_name'              => _x( 'Género', 'Taxonomy Singular Name', 'genero' ),
		'menu_name'                  => __( 'Género', 'genero' ),
		'all_items'                  => __( 'Géneros', 'genero' ),
		'parent_item'                => __( 'Parent Item', 'genero' ),
		'parent_item_colon'          => __( 'Parent Item:', 'genero' ),
		'new_item_name'              => __( 'Nuevo Género', 'genero' ),
		'add_new_item'               => __( 'Agregar Género', 'genero' ),
		'edit_item'                  => __( 'Edit Item', 'genero' ),
		'update_item'                => __( 'Update Item', 'genero' ),
		'view_item'                  => __( 'View Item', 'genero' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'genero' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'genero' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'genero' ),
		'popular_items'              => __( 'Popular Items', 'genero' ),
		'search_items'               => __( 'Search Items', 'genero' ),
		'not_found'                  => __( 'Not Found', 'genero' ),
		'no_terms'                   => __( 'No items', 'genero' ),
		'items_list'                 => __( 'Items list', 'genero' ),
		'items_list_navigation'      => __( 'Items list navigation', 'genero' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'genero', array( 'product' ), $args );

}
add_action( 'init', 'Género', 0 );

// Register Custom Taxonomy
function condicion() {

	$labels = array(
		'name'                       => _x( 'Condición', 'Taxonomy General Name', 'condicion' ),
		'singular_name'              => _x( 'Condición', 'Taxonomy Singular Name', 'condicion' ),
		'menu_name'                  => __( 'Condición', 'condicion' ),
		'all_items'                  => __( 'All Items', 'condicion' ),
		'parent_item'                => __( 'Parent Item', 'condicion' ),
		'parent_item_colon'          => __( 'Parent Item:', 'condicion' ),
		'new_item_name'              => __( 'Nueva Condición', 'condicion' ),
		'add_new_item'               => __( 'Agregar Condición', 'condicion' ),
		'edit_item'                  => __( 'Edit Item', 'condicion' ),
		'update_item'                => __( 'Update Item', 'condicion' ),
		'view_item'                  => __( 'View Item', 'condicion' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'condicion' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'condicion' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'condicion' ),
		'popular_items'              => __( 'Popular Items', 'condicion' ),
		'search_items'               => __( 'Search Items', 'condicion' ),
		'not_found'                  => __( 'Not Found', 'condicion' ),
		'no_terms'                   => __( 'No items', 'condicion' ),
		'items_list'                 => __( 'Items list', 'condicion' ),
		'items_list_navigation'      => __( 'Items list navigation', 'condicion' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'condicion', array( 'product' ), $args );

}
add_action( 'init', 'condicion', 0 );

add_shortcode( 'product_description', 'display_product_description' );
function display_product_description( $atts ){
    $atts = shortcode_atts( array(
        'id' => get_the_id(),
    ), $atts, 'product_description' );

    global $product;

    if ( ! is_a( $product, 'WC_Product') )
        $product = wc_get_product($atts['id']);

    return $product->get_description();
}

?>
