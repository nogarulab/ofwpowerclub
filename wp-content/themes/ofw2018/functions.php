<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

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
    add_image_size('home-prods', 500, 375, true); 
    add_image_size('testimonials', 180, 180, true); 

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
    'default-color' => 'FFF',
    'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
    'default-image'         => get_template_directory_uri() . '/img/headers/default.jpg',
    'header-text'           => false,
    'default-text-color'        => '000',
    'width'             => 1000,
    'height'            => 198,
    'random-default'        => false,
    'wp-head-callback'      => $wphead_cb,
    'admin-head-callback'       => $adminhead_cb,
    'admin-preview-callback'    => $adminpreview_cb
    ));*/

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

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('jquery', '//code.jquery.com/jquery-3.3.1.slim.min.js', array(), '3.3.1'); // Jquery
        wp_enqueue_script('jquery'); // Enqueue it!

        wp_register_script('popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js', array(), '1.14.0'); // Popper
        wp_enqueue_script('popper'); // Enqueue it!

        wp_register_script('bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js', array(), '4.1.0'); // Bootstrap
        wp_enqueue_script('bootstrap'); // Enqueue it!

        wp_register_script('easescroll', get_template_directory_uri() . '/js/lib/jquery.easeScroll.js', array(), '1.0');  // Ease Scroll
        wp_enqueue_script('easescroll'); // Enqueue it!

        wp_register_script('matcheight', get_template_directory_uri() . '/js/lib/jquery.matchHeight.js', array(), '1.0');  // Ease Scroll
        wp_enqueue_script('matcheight'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('home')) {
        wp_register_script('load', '//unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array(), '1.0'); 
        wp_enqueue_script('load'); // Enqueue it!

        wp_register_script('masonry', '//unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array(), '4.2.1'); 
        wp_enqueue_script('masonry'); // Enqueue it!

        wp_register_script('homejs', get_template_directory_uri() . '/js/home.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('homejs'); // Enqueue it!
    }

    if (is_page('about')) {
        wp_register_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.8.1'); 
        wp_enqueue_script('slick'); // Enqueue it!

        wp_register_script('aboutjs', get_template_directory_uri() . '/js/about.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('aboutjs'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.min.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css', array(), '4.1.0', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1', 'all');
    wp_enqueue_style('slick'); // Enqueue it!

    wp_register_style('font', '//fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900', array(), '1.0', 'all');
    wp_enqueue_style('font'); // Enqueue it!

    wp_register_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css', array(), '5.1.0', 'all');
    wp_enqueue_style('fontawesome'); // Enqueue it!

    wp_register_style('main', get_template_directory_uri() . '/css/styles.css', array(), '1.0', 'all');
    wp_enqueue_style('main'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
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

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
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
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
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
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
            'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
            'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

/*------------------------------------*\
    Addding Agent Role
\*------------------------------------*/

$result = add_role( 'agent', __( 'Agent' ),
  array(

    'read' => true, // true allows this capability
    'edit_posts' => false, // Allows user to edit their own posts
    'edit_pages' => false, // Allows user to edit pages
    'edit_others_posts' => false, // Allows user to edit others posts not just their own
    'create_posts' => true, // Allows user to create new posts
    'manage_categories' => false, // Allows user to manage post categories
    'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode
    'edit_themes' => false, // false denies this capability. User can’t edit your theme
    'install_plugins' => false, // User cant add new plugins
    'update_plugin' => false, // User can’t update any plugins
    'update_core' => false // user cant perform core updates

  )

);

/*------------------------------------*\
    Addding Partner Applicant Role
\*------------------------------------*/

$result = add_role( 'partner_applicant', __( 'Partner Applicant' ),
  array(

    'read' => false,
    'edit_posts' => false, 
    'edit_pages' => false, 
    'edit_others_posts' => false, 
    'create_posts' => false, 
    'manage_categories' => false, 
    'publish_posts' => false, 
    'edit_themes' => false, 
    'install_plugins' => false, 
    'update_plugin' => false, 
    'update_core' => false 

  )

);

/*------------------------------------*\
    Addding Partner Role
\*------------------------------------*/

$result = add_role( 'partner', __( 'Partner' ),
  array(

    'read' => true,
    'edit_posts' => false, 
    'edit_pages' => false, 
    'edit_others_posts' => false, 
    'create_posts' => false, 
    'manage_categories' => false, 
    'publish_posts' => false, 
    'edit_themes' => false, 
    'install_plugins' => false, 
    'update_plugin' => false, 
    'update_core' => false 

  )

);

/*------------------------------------*\
    Restrict Dashboard to Admin Only
\*------------------------------------*/

// Could be better adds the function to the 'init' hook and check later if it's an admin page
add_action( 'init', 'my_custom_dashboard_access_handler');

function my_custom_dashboard_access_handler() {

   // Check if the current page is an admin page
   // && and ensure that this is not an ajax call
   if ( is_admin() && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ){
      
      //Get all capabilities of the current user
      $user = get_userdata( get_current_user_id() );
      $caps = ( is_object( $user) ) ? array_keys($user->allcaps) : array();

      //All capabilities/roles listed here are not able to see the dashboard
      $block_access_to = array('subscriber', 'agent', 'partner_applicant', 'partner');
      
      if(array_intersect($block_access_to, $caps)) {
         //wp_redirect( home_url() );
        $current_user   = wp_get_current_user();
        $role_name      = $current_user->roles[0];
 
        if ( 'partner' === $role_name ) {
            wp_redirect( home_url('/partner-dashboard') );
        } elseif ( 'agent' === $role_name ) {
            wp_redirect( home_url('/agent-dashboard') );
        } elseif ( 'partner_applicant' === $role_name ) {
            wp_logout();
        } else {
            wp_redirect( home_url('/account') );
        }
         exit;
      }
   }
}

function my_login_redirect( $redirect_to, $request, $user ) {
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('partner', $user->roles)) {
            $redirect_to =  home_url().'/partner-dashboard';
        } elseif (in_array('agent', $user->roles)) {
            $redirect_to =  home_url().'/agent-dashboard';
        } elseif (in_array('partner_applicant', $user->roles)) {
            wp_logout();
        }
    }

    return $redirect_to;
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

function wps_change_role_name() {
global $wp_roles;
if ( ! isset( $wp_roles ) )
$wp_roles = new WP_Roles();
$wp_roles->roles['subscriber']['name'] = 'Member';
$wp_roles->role_names['subscriber'] = 'Member';
}
add_action('init', 'wps_change_role_name');

if( get_role('contributor') ){
    remove_role( 'contributor' );
}
if( get_role('author') ){
    remove_role( 'author' );
}
if( get_role('editor') ){
    remove_role( 'editor' );
}

function benefits_form_meta_box($object) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    $benefits_offered = get_post_meta($object->ID, 'benefits_offered', true);
    $benefits = [];

    for ($i=0;$i<count($benefits_offered['name']);$i++) {
        array_push($benefits, array($benefits_offered['name'][$i]));
        array_push($benefits[$i], $benefits_offered['description'][$i]);
    }

    echo '<div class="benefit-list incremental-item" data-itemhtml="<li class=item><div><label>Name</label><input type=text name=benefitname[] placeholder=Benefit Name></div><div><label>Description</label><textarea name=benefitdesc[]></textarea></div><span class=remove>x</span></li>"><ul>';
    foreach ($benefits as $benefit) {
        echo '<li class="item">';
        echo '<div><label>Name</label><input type="text" name="benefitname[]" value="'.$benefit[0].'"></div>';
        echo '<div><label>Description</label><textarea name="benefitdesc[]">'.$benefit[1].'</textarea></div><span class=remove>x</span>';
        echo '</li>';
    }
    echo '</ul><span class="add">Add Another Benefit</button></div>';
}

function add_benefits_form_meta_box() {
    add_meta_box("benefits-list-meta-box", "Benefits/Perks", "benefits_form_meta_box", "partners", "normal", "default", null);
}
add_action("add_meta_boxes", "add_benefits_form_meta_box");

function establishmen_details_form_meta_box($object) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    $receive_sticker = get_post_meta($object->ID, "receive_sticker", true);

    echo '<div><label>Owner/CEO/Proprietor(s)</label><input type="text" name="establishment_owner" value="'.get_post_meta($object->ID, "establishment_owner", true).'"></div>';
    echo '<div><label>Website URL</label><input type="text" name="establishmentwebsite" value="'.get_post_meta($object->ID, "establishmentwebsite", true).'"></div>';
    echo '<div class="check"><input type="checkbox" name="receivesticker" '. (!empty($receive_sticker) && $receive_sticker == 1 ? 'checked="checked"' : "") .'>Agreed to receive OFW Power Club stickers.</div>';
    echo '<p>Please take note that this partner agreed to the terms and condition of our organization.</p>';
}

function add_establishment_details_meta_box() {
    add_meta_box("establishment-details-meta-box", "Additional Details", "establishmen_details_form_meta_box", "partners", "side", "default", null);
}
add_action("add_meta_boxes", "add_establishment_details_meta_box");

function branches_form_meta_box($object) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    $available_branches = get_post_meta($object->ID, 'branches', true);
    $branches = [];
    print_r($available_branches);
    
    for ($i=0;$i<count($available_branches['location']);$i++) {
        array_push($branches, array($available_branches['location'][$i]));
        array_push($branches[$i], $available_branches['address'][$i]);
        array_push($branches[$i], $available_branches['contact_no'][$i]);
        array_push($branches[$i], $available_branches['contact_person'][$i]);
    }

    echo '<div class="branch-list incremental-item" data-itemhtml="<li class=item><div><label>Address</label><input type=text name=b_address[]></div><div class=column><em><label>Location</label><input type=text name=b_location[]></em><em><label>Contact Number</label><input type=number name=b_contactnumber[]></em><em><label>Contact Person</label><input type=text name=b_contactperson[]></em></div><span class=remove>x</span></li>"><ul>';
    foreach ($branches as $branch) {
        echo '<li class="item">';
        echo '<div><label>Address</label><input type="text" name="b_address[]" value="'.$branch[1].'"></div>';
        echo '<div class="column"><em><label>Location</label><input type="text" name="b_location[]" value="'.$branch[0].'"></em><em><label>Contact Number</label><input type="number" name="b_contactnumber[]" value="'.$branch[2].'"></em><em><label>Contact Person</label><input type="text" name="b_contactperson[]" value="'.$branch[3].'"></em></div>';
        echo '<span class=remove>x</span></li>';
    }
    echo '</ul><span class="add">Add Another Branch</button></div>';

    
}

function add_branches_meta_box() {
    add_meta_box("branches-meta-box", "Branches", "branches_form_meta_box", "partners", "normal", "default", null);
}
add_action("add_meta_boxes", "add_branches_meta_box");

function remove_product_category_meta_boxes() {
    remove_meta_box( 'tagsdiv-partner_category', 'partners', 'side' );
}
add_action( 'admin_menu', 'remove_product_category_meta_boxes' ); 

function partner_category_meta_box($object) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    $terms = get_terms( array(
        'taxonomy' => 'partner_category',
        'hide_empty' => false,
    ) );
    $selected_cats = get_the_terms( $object->ID, 'partner_category' );
    if (!empty($selected_cats)) {
        $selected_cat_names = [];
        foreach($selected_cats as $selected_cat) {
            $selected_cat_names[] = $selected_cat->name;
        }
    }
    
    echo '<ul>';
    foreach ($terms as $term) {
        echo '<li><input type="checkbox" name="partner_category[]" value="'.$term->name.'" '. ( !empty($selected_cats) && in_array($term->name, $selected_cat_names) ? 'checked="checked"' : '' ) .'> '.$term->name.'</li>';
    }
    echo '</ul>';
     
}

function add_partner_category_meta_box() {
    add_meta_box("partner-category-meta-box", "Categories", "partner_category_meta_box", "partners", "side", "default", null);
}
add_action("add_meta_boxes", "add_partner_category_meta_box");

function save_benefits_meta_box($post_id, $post, $update) {
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "partners";
    if($slug != $post->post_type)
        return $post_id;

    $benefitname            = "";
    $benefitdesc            = "";
    $establishment_owner    = "";
    $establishmentwebsite   = "";
    $sticker                = isset($_POST['receivesticker']);
    $b_location             = "";
    $b_address              = "";
    $b_contactnumber        = "";
    $b_contactperson        = "";
    $partner_category       = "";

    if(isset($_POST["benefitname"])) {
        $benefitname = $_POST["benefitname"];
    }

    if(isset($_POST["benefitdesc"])) {
        $benefitdesc = $_POST["benefitdesc"];
    }

    $benefits_offered = array('name' => $benefitname, 'description' => $benefitdesc);
    update_post_meta($post_id, 'benefits_offered', $benefits_offered );

    if(isset($_POST["b_location"])) {
        $b_location = $_POST["b_location"];
    }

    if(isset($_POST["b_address"])) {
        $b_address = $_POST["b_address"];
    }

    if(isset($_POST["b_contactnumber"])) {
        $b_contactnumber = $_POST["b_contactnumber"];
    }

    if(isset($_POST["b_contactperson"])) {
        $b_contactperson = $_POST["b_contactperson"];
    }

    $branches = array('location' => $b_location, 'address' => $b_address, 'contact_no' => $b_contactnumber, 'contact_person' => $b_contactperson);
    update_post_meta($post_id, 'branches', $branches );

    if(isset($_POST["establishment_owner"])) {
        $establishment_owner = $_POST["establishment_owner"];
    }
    update_post_meta($post_id, 'establishment_owner', $establishment_owner );

    if(isset($_POST["establishmentwebsite"])) {
        $establishmentwebsite = $_POST["establishmentwebsite"];
    }
    update_post_meta($post_id, 'establishmentwebsite', $establishmentwebsite );
    update_post_meta($post_id, 'receive_sticker', $sticker );

    if (isset($_POST['partner_category'])) {
        $partner_category = $_POST['partner_category'];
    }
    wp_set_post_terms( $post_id, $partner_category, 'partner_category', false );

}
add_action("save_post", "save_benefits_meta_box", 10, 3);

function modify_contact_methods($profile_fields) {

    $profile_fields['contact_number'] = 'Contact Number';
    $profile_fields['id_number'] = 'ID Number';
    return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

function custom_admin_js() {
    $url_js     = get_template_directory_uri() . '/js/admin_scripts.js';
    $url_css    = get_template_directory_uri() . '/css/admin_css.css';
    echo '"<link type="text/css" rel="stylesheet" href="'. $url_css . '" />"';
    echo '"<script type="text/javascript" src="'. $url_js . '"></script>"';
}
add_action('admin_footer', 'custom_admin_js');

/* Adding Members */
function add_user_with_roles(){
    /* Inserting Users in WP*/
    $user_id = wp_insert_user( $_POST ) ;
    /* Checking if not error*/
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
//    return '';
    if ( ! is_wp_error( $user_id ) ) {
        /***
         * Adding additional metakey in user meta
         * agent_id ~ Current User ID
         */
        extract($_POST);

        update_user_meta( $user_id, 'agent_id', get_current_user_id());
        update_user_meta( $user_id, 'middle_name', $middle_name);
        update_user_meta( $user_id, 'ms_custom_data', "a:0:{}");
        update_user_meta( $user_id, 'ms_email', $user_email);
        update_user_meta( $user_id, 'ms_gateway_profiles', "a:0:{}");
        update_user_meta( $user_id, 'ms_id', $user_id);
        update_user_meta( $user_id, 'ms_is_member', 1);
        update_user_meta( $user_id, 'ms_first_name', $first_name);
        update_user_meta( $user_id, 'contact_number', '');
        update_user_meta( $user_id, 'ms_last_name', $last_name);
        update_user_meta( $user_id, 'ms_name', $first_name.' '.$last_name);
        update_user_meta( $user_id, 'ms_subscriptions', 'a:1:{i:0;O:21:"MS_Model_Relationship":28:{s:16:"');
        update_user_meta( $user_id, 'ms_username', $user_login);

        /***
        ms_custom_data : a:0:{}
        ms_email : user_email
        ms_first_name : first_name
        ms_gateway_profiles : a:0:{}
        ms_id : $user_id
        ms_is_member : 1
        ms_last_name : last_name
        ms_name : first_name.' '.last_name
        ms_subscriptions : a:1:{i:0;O:21:"MS_Model_Relationship":28:{s:16:"
        ms_username : user_login
         *
         * update_post_meta( $post_id, $meta_key, $meta_value, $prev_value ); ?>
         */
        $membership_id = 25;
        $membership_post = [];
        $membership_post['post_author'] = $user_id;
        $membership_post['post_content'] = "user_id: ".$user_id.", membership_id: ".$membership_id;
        $membership_post['post_title'] = "user_id-$user_id-membership_id-$membership_id";
        $membership_post['post_excerpt'] = "user_id: ".$user_id.", membership_id: ".$membership_id;
        $membership_post['post_status'] = "private";
        $membership_post['comment_status'] = "closed";
        $membership_post['ping_status'] = "closed";
        $membership_post['post_password'] = "";
        $membership_post['post_name'] = "user_id-$user_id-membership_id-$membership_id";
        $membership_post['to_ping'] = "";
        $membership_post['pinged'] = "";
        $membership_post['post_type'] = "ms_relationship";

        $post_id = wp_insert_post( $membership_post);

        $membership_post_update['id'] = $post_id;
        $membership_post_update['guid'] = "http://localhost/ofwpowerclub/ms_relationship/$post_id/";
        wp_insert_post( $membership_post_update);

        $post_meta =[];
        $post_meta['cancelled_memberships'] = '';
        $post_meta['current_invoice_number'] = 1;
        $post_meta['custom_data'] = 'a:0:{}';
        $post_meta['description'] = $membership_post['post_content'];
        $post_meta['email_log'] = 'a:0:{}';
        $post_meta['expire_date'] = date('Y-m-d',strtotime("+30 days"));
        $post_meta['gateway_id'] = 'admin';
        $post_meta['id'] = $post_id;
        $post_meta['is_simulated'] = '';
        $post_meta['membership_id'] = $membership_id;
        $post_meta['move_from_id'] = 0;
        $post_meta['cancelled_memberships'] = '';
        $post_meta['name'] = $membership_post['post_content'];
        $post_meta['payment_type'] = 'recurring';
        $post_meta['payments'] = 'a:0:{}';
        $post_meta['post_modified'] = date('Y-m-d H:i:s');
        $post_meta['source'] = '';
        $post_meta['source_id'] = '';
        $post_meta['start_date'] = date('Y-m-d');
        $post_meta['status'] = 'active';
        $post_meta['title'] = '';
        $post_meta['trial_expire_date'] = '';
        $post_meta['trial_period_completed'] = '';
        $post_meta['user_id'] = $user_id;

        foreach($post_meta as $key=>$pm){
            add_post_meta( $post_id,  $key,  $pm );
        }

        $membership_post = [];
        $membership_post['post_author'] = $user_id;
        $membership_post['post_content'] = "Has signed up to membership member.";
        $membership_post['post_title'] = "user-".$first_name."-".$last_name."-membership-member-type-signed_up";
        $membership_post['post_excerpt'] = "Has signed up to membership member.";
        $membership_post['post_status'] = "private";
        $membership_post['comment_status'] = "closed";
        $membership_post['ping_status'] = "closed";
        $membership_post['post_password'] = "";
        $membership_post['post_name'] = "user-".$first_name."-".$last_name."-membership-member-type-signed_up";
        $membership_post['to_ping'] = "";
        $membership_post['pinged'] = "";
        $membership_post['post_type'] = "ms_event";

        $post_meta_id = wp_insert_post( $membership_post);

        $post_meta =[];
        $post_meta['custom_data'] = 'a:0:{}';
        $post_meta['date'] = date('Y-m-d');
        $post_meta['description'] = 'Has signed up to membership member.';
        $post_meta['id'] = 0;
        $post_meta['ms_relationship_id'] = $post_id;
        $post_meta['membership_id'] = $membership_id;
        $post_meta['name'] = "user: ".$first_name." ".$last_name.", membership: member, type: signed_up";
        $post_meta['post_modified'] = date('Y-m-d H:i:s');
        $post_meta['title'] = '';
        $post_meta['topic'] = 'membership';
        $post_meta['type'] = 'singed_up';
        $post_meta['user_id'] = $user_id;

        foreach($post_meta as $key=>$pm){
            add_post_meta( $post_meta_id,  $key,  $pm );
        }

        /***
         * JUST AND PROMPT
         */
        echo "User created  ";
        print_r($_POST);

    }else{
        echo "there was an error";
    }
}
add_action('add_members', 'add_user_with_roles');

?>
