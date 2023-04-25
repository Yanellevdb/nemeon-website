<?php

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';

if (file_exists($composer_autoload)) {
  require_once $composer_autoload;
  $timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {

  add_action(
    'admin_notices',
    function () {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    }
  );

  add_filter(
    'template_include',
    function ($template) {
      return get_stylesheet_directory() . '/static/no-timber.html';
    }
  );
  return;
}

if (!defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '0.0.11');
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
  /** Add timber support. */
  public function __construct()
  {
    add_action('after_setup_theme', array($this, 'theme_supports'));
    add_filter('timber/context', array($this, 'add_to_context'));
    add_filter('timber/twig', array($this, 'add_to_twig'));
    add_action('init', array($this, 'register_post_types'));
    add_action('init', array($this, 'register_taxonomies'));
    add_action('wp_enqueue_scripts', array($this, 'timber_enqueue'));
    add_action('wp_enqueue_scripts', array($this, 'timber_dequeue'), 100);
    add_action('wp_enqueue_scripts', array($this, 'remove_head_scripts'));
    add_action('wp_head', array($this, 'timber_wp_head'));
    add_action('wp_footer', array($this, 'timber_wp_footer'));
    add_action('wp_body_open', array($this, 'timber_wp_body_open'));
    add_filter('body_class', array($this, 'timber_body_classes'));
    // add_filter( 'acfe/fields/advanced_link/sub_fields/name=link', array($this, 'rdlk_acfe_add_options'), 10, 3 );

    // remove_filter( 'wp_robots', 'wp_robots_noindex' );
    // add_filter( 'wpseo_robots', '__return_false' );
    // add_filter( 'wpseo_googlebot', '__return_false' ); // Yoast SEO 14.x or newer
    // add_filter( 'wpseo_bingbot', '__return_false' ); // Yoast SEO 14.x or newer

    parent::__construct();
  }
  /** This is where you can register custom post types. */
  public function register_post_types()
  {
    require get_template_directory() . '/inc/cpt-jobs.php';
  }
  /** This is where you can register custom taxonomies. */
  public function register_taxonomies()
  {
  }

  public function timber_body_classes($classes)
  {
    global $post;
    if (is_page()) {
      if (get_field('header_text_color', $post->ID)) {
        $header_text_color = get_field('header_text_color', $post->ID);
        $classes[] = 'header-text-color-' . $header_text_color;
      }
    }
    return $classes;
  }
}

  /** This is where you add some context
   *
   * @param string $context context['this'] Being the Twig's {{ this }}.
   */


  public function add_to_context($context)
  {
    $args = array(
      'depth' => 2,
    );

    $context['menu'] = new Timber\Menu('primary-menu', $args);
    $context['footer_menu']  = new Timber\Menu('footer-menu');
    $context['topbar_menu']  = new Timber\Menu('topbar-menu');
    $context['foo']   = 'bar';
    $context['stuff'] = 'I am a value set in your functions.php file';
    $context['notes'] = 'These values are available everytime you call Timber::context();';
    $context['post_per_page'] = get_option('posts_per_page');
    $context['_S_VERSION'] = _S_VERSION;
    $context['is_mobile'] = wp_is_mobile();
    $context['contact_info'] = get_field('contact_information', 'options');
    $context['socials'] = get_field('socials', 'options');
    $context['tagline'] = get_field('tagline', 'options');
    $context['part_of'] = get_field('part_of', 'options');
    $context['part_of'] = get_field('part_of', 'options');
  

    if (function_exists('icl_object_id')) {
      $context['language'] = apply_filters('wpml_current_language', NULL);
    } else {
      $context['language'] = get_locale();
    }

    $context['site']  = $this;
    return $context;
  }

  public function theme_supports()
  {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
    add_theme_support('title-tag');

    /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
    add_theme_support('post-thumbnails');

    /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
    add_theme_support(
      'html5',
      array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      )
    );

    /*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
    // add_theme_support(
    // 	'post-formats',
    // 	array(
    // 		'aside',
    // 		'image',
    // 		'video',
    // 		'quote',
    // 		'link',
    // 		'gallery',
    // 		'audio',
    // 	)
    // );

    add_theme_support('menus');

    register_nav_menus(
      array(
        'primary-menu' => __('Primary Menu'),
        'footer-menu' => __('Footer Menu'),
        'legal-menu' => __('Legal Menu'),
        'topbar-menu' => __('Top Bar Menu')
      )
    );

    add_action('init', 'register_nav_menus');


    // add_image_size( 'square_medium', 430, 430, true );
  }

  /** This Would return 'foo bar!'.
   *
   * @param string $text being 'foo', then returned 'foo bar!'.
   */
  public function myfoo($text)
  {
    $text .= ' bar!';
    return $text;
  }

  /**
   * The custom language switcher for wpml
   * To call in theme: {{ langSwitch() }}
   */
  public function langSwitch()
  {
    if (function_exists('icl_object_id')) {
      do_action('wpml_add_language_selector');
    }
  }


  /** This is where you can add your own functions to twig.
   *
   * @param string $twig get extension.
   */
  public function add_to_twig($twig)
  {
    $twig->addExtension(new Twig\Extension\StringLoaderExtension());
    $twig->addFunction(new Timber\Twig_Function('langSwitch', array($this, 'langSwitch')));
    // $twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
    return $twig;
  }



  /** This is where you can enqueue your scripts and styles.
   *
   */
  public function timber_enqueue()
  {
    wp_enqueue_style('timber-styles', get_template_directory_uri() . '/static/assets/css/style.min.css', array(), _S_VERSION);
    wp_deregister_script('jquery');
    wp_enqueue_script('timber-vendor', get_template_directory_uri() . '/static/assets/js/vendor.bundle.js', array(), _S_VERSION, true);
    wp_enqueue_script('timber-app', get_template_directory_uri() . '/static/assets/js/app.bundle.js', array(), _S_VERSION, true);
    wp_enqueue_script('timber-radikal', get_template_directory_uri() . '/static/assets/js/radikal.min.js', array(), _S_VERSION, true);

    global $wp_query;

    $load_more = array(
      'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
      'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
      'max_page' => $wp_query->max_num_pages,
      'button_text' => __('More', 'timber'),
      'loading_text' => __('Loading', 'timber'),
      'is_search' => isset($_GET["s"]) ? $_GET["s"] : false,
      'lang' => function_exists('icl_object_id') ? apply_filters('wpml_current_language', NULL) : get_locale()
    );

    $params_array = array(
      'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
      'loadmore' => $load_more,
      'pdf_link' => $this->get_pdf_link(),
      'download' => array(
        'download_title' => __('Download your pdf below', 'timber'),
        'download_text' => __('Thanks for filling in the form! You can download the article below.', 'timber'),
        'download_button' => __('Download your article', 'timber'),
      )
    );

    wp_localize_script('timber-app', 'nucleon_params', $params_array);
  }

  public function get_pdf_link()
  {
    global $post;
    return (get_field('pdf', $post->ID) ? base64_encode(get_field('pdf', $post->ID)) : null);
  }

  public function timber_dequeue()
  {
    wp_dequeue_style('cookie-notice-front');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
    wp_dequeue_style('style');
  }

  /** This is where you can add your inline scripts and styles that needs to go inside head tag.
   *
   */
  public function timber_wp_head()
  {
  }

  /** This is where you can add your scripts and styles that needs to go right after the opening body tag.
   *
   */
  public function timber_wp_body_open()
  {
  }


  /** This is where you can add your inline scripts that needs to go right before the closing body tag.
   *
   */
  public function timber_wp_footer()
  {
  }


  // Custom Scripting to Move JavaScript from the Head to the Footer
  public function remove_head_scripts()
  {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
  }


  /** ACFE Link field nofollow option.
   *
   */
  public function rdlk_acfe_add_options($sub_fields, $field, $value)
  {
    /**
     * @array $sub_fields   Sub fields array
     * @array $field        Advanced Link field
     * @array $value        Advanced Link values
     */
    $sub_fields[] = array(
      'name'      => 'no_follow',
      'label'     => 'No follow',
      'type'      => 'true_false',
      'message'   => 'Add rel="nofollow"',
      'ui'        => false
    );

    $sub_fields[] = array(
      'name'      => 'is_button',
      'label'     => 'Is button',
      'type'      => 'true_false',
      'message'   => 'shows link as button',
      'ui'        => false
    );

    return $sub_fields;
  }


  /** Admin scripts and styles.
   *
   */
  public function rdkl_admin_enqueue_scripts()
  {
    wp_enqueue_script('rdkl-admin-js', get_template_directory_uri() . '/static/admin/acf.js', array(), _S_VERSION, true);
  }

  /** ACF custom styles css.
   *
   */
  public function rdkl_acf_custom_css()
  {
    echo '<style>
      .acf-flexible-content .layout.-collapsed {
        opacity: .5;
      }
      .acf-flexible-content .layout.-collapsed:hover {
        opacity: 1;
      }
      .acf-flexible-content .layout:not(.-collapsed):hover {
        box-shadow: 0 0 40px rgba(0,0,0, .5);
      }
    </style>';
  }
}

new StarterSite();


/**
 * ACF Flexible Content
 */
require get_template_directory() . '/inc/acf-flexible-content.php';
require get_template_directory() . '/inc/acf-options-pages.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load More
 */
require get_template_directory() . '/inc/loadmore.php';
