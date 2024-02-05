<?php

namespace Startmeup;

use Timber\Menu;
use Timber\Site as TimberSite;

class Site extends TimberSite
{
    public function __construct()
    {
        parent::__construct();

        add_action('after_setup_theme', [$this, 'themeSupports']);
        add_action('after_setup_theme', [$this, 'addImageSizes']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);

        add_filter('timber/context', [$this, 'addToContext']);
        add_filter('timber/twig', [$this, 'addToTwig']);
        add_filter('render_block', [$this, 'renderBlock'], 10, 2);

        // Set allowed blocks
        add_filter('allowed_block_types_all', [$this, 'allowedBlocks']);

        // Add custom blocks
        add_action('acf/init', [$this, 'registerBlocks']);
    }

    /**
    * Enqueue scripts and stylesheets.
    */
    public function enqueueScripts()
    {
        wp_enqueue_style('vendor_css', get_template_directory_uri() .  '/public/css/vendor.css');
        wp_enqueue_style('app_css', get_template_directory_uri() .  '/public/css/app.css');

        // Load main script with PHP variables.
        wp_register_script('vendor_js', get_template_directory_uri() .  '/public/js/vendor.js' );
        wp_register_script('app_js', get_template_directory_uri() .  '/public/js/app.js' );
        wp_localize_script('app_js', 'Wordpress', $this->getJsVars());
        wp_enqueue_script('app_js', '', [], false, true);
    }

    /**
    * Add custom image sizes.
    */
    public function addImageSizes() {}

    public function registerBlocks()
    {


        acf_register_block_type([
            'name' => 'intro-text',
            'title' => __('Intro Text Block'),
            'description' => __('Text block with slightly larger text.'),
            'render_template' => 'block.php',
            'category' => 'common',
            'icon' => 'media-text',
            'enqueue_style' => get_template_directory_uri() . '/public/css/backend.css',
            'mode' => 'edit',
            'supports' => [
                'align' => false
            ]
        ]);

        acf_register_block_type([
            'name' => 'button-block',
            'title' => __('Button Block'),
            'render_template' => 'block.php',
            'category' => 'common',
            'icon' => 'button',
            'mode' => 'edit',
            'enqueue_style' => get_template_directory_uri() . '/public/css/backend.css',
            'supports' => [
                'align' => false
            ]
        ]);

        acf_register_block_type([
            'name' => 'video-slider-block',
            'title' => __('Video Slider Block'),
            'description' => __('Video Slider Blocks.'),
            'render_template' => 'block.php',
            'category' => 'common',
            'icon' => 'video-alt3',
            'enqueue_style' => get_template_directory_uri() . '/public/css/backend.css',
            'mode' => 'edit',
            'supports' => [
                'align' => false
            ]
        ]);


        acf_register_block_type([
            'name' => 'spacing',
            'title' => __('Spacing'),
            'render_template' => 'block.php',
            'category' => 'common',
            'icon' => 'image-flip-vertical',
            'enqueue_style' => get_template_directory_uri() . '/public/css/backend.css',
            'mode' => 'edit',
            'supports' => [
                'align' => false
            ]
        ]);

    }

    /**
     * Set allowed Gutenberg blocks
     */
    public function allowedBlocks()
    {
        return [
            'acf/intro-text',
            'acf/button-block',
            'acf/video-slider-block',
            'acf/tabbed-content-block',
            'acf/spacing',
            'core/table',
            'core/paragraph',
            'core/shortcode',
            'core/heading',
            'core/list',
            'core/list-item',
            'core/image',
            'core/separator',
            'core/button',
            'core/html',
            'core/table',
            'core/embed',
            'core/columns',
        ];
    }

    /**
    * Sent Javascript variables to the front end.
    */
    public function getJsVars()
    {
        return [];
    }

    /**
     * Get brand colors for the Wordpress backend.
     */
    public function getColors()
    {
      return [];
    }

  /**
   * Render the core block with twig
   * @param $block_content
   * @param $block
   * @return mixed
   */
    public function renderBlock($block_content, $block)
    {

      // ACF block? Forget about it
      $block['blockName'] = (isset($block['blockName'])) ? $block['blockName'] : '';

      if (stristr($block['blockName'], 'acf')) {
        return $block_content;
      }
      else if (stristr($block['blockName'], 'core') && trim($block_content)) {
        $output = $block_content;

        if ($this->templateExists('block/core.twig')) {
          $context = Timber::context();

          $classes = [
            'block',
            'block--' . sanitize_title($block['blockName'])
          ];

          $context['block'] = [
            'name' => $block['blockName'],
            'classes' => $classes,
            'attributes' => $block['attrs'],
            'content' => $block['blockName'] == 'core/shortcode'
              ? do_shortcode($block['innerHTML'])
              : $block_content
          ];

          $output = Timber::compile('block/core.twig', $context);
        }

        return $output;
      }
    }

    /** This is where you add some context
     *
     * @param string $context context['this'] Being the Twig's {{ this }}.
     */
    public function addToContext($context)
    {
        $main_menu = new Menu();
        $context['menu']['main'] = $main_menu->get_items();

        $context['site']  = $this;

        $context['options'] = get_fields('option');

        return $context;
    }

    public function themeSupports()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Disable Custom Colors
        add_theme_support('disable-custom-colors');

        // Load brand colors.
        if ($colors = $this->getColors()) {
            $colors_formatted = [];
            foreach ($colors as $name => $code) {
                $colors_formatted[] = [
                    'name' => $name,
                    'slug' => sanitize_title($name),
                    'color' => $code
                ];
            }

            add_theme_support('editor-color-palette', $colors_formatted);
        }

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
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'audio',
            )
        );

        add_theme_support( 'menus' );
    }

    /**
     * This is where you can add your own functions to twig.
     * @param string $twig get extension.
     */
    public function addToTwig($twig)
    {
        // $twig->addExtension( new \Twig\Extension\StringLoaderExtension() );
        $twig->addFunction(new \Twig\TwigFunction('get_blocks', [$this, 'getBlocks']));
        $twig->addFilter( new \Twig\TwigFilter( 'relative_links', [$this, 'relativeLinks'] ) );
        return $twig;
    }

    /**
     * Get properly formatted Gutenberg blocks
     *
     * @param $conten Post content
     */
    public function getBlocks($content)
    {
        $output = '';
        $blocks = parse_blocks($content);

        foreach ($blocks as $b) {
            $output .= render_block($b);
        }

        return $output;
    }

    /**
     * Make all links in the text relative to the site,
     * if they match the pattern.
     */
    public function relativeLinks($text)
    {
        // $targets = [
        //   'https://live-NAME.pantheonsite.io',
        //   'https://test-NAME.pantheonsite.io',
        //   'https://dev-NAME.pantheonsite.io',
        //   'https://NAME.lndo.site',
        // ];

        // $text = str_replace($targets, '', $text);

        return $text;
    }
}
