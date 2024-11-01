<?php
/**
 *
 * Plugin Name: TeamShowcase
 * Description: Simple but effective team show off plugin for wordPress.
 * Version: 1.0.0
 * Author: tosagor
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * */
// Security Check
if (!defined('ABSPATH'))
    die();

// OS independent directory seperator shortning
if (!defined('DS'))
    define('DS', DIRECTORY_SEPARATOR);

// Signature Macro of the plugin
define('TEAM_SHOWCASE', true);

/**
 *
 * @class WordPressPluginBoilerplage
 * @description Main class of the plugin
 * 
 * */
class TeamShowcase { // Edit Identifier

    /**
     *
     * @var string $name
     * @description Name of the plugin
     * 
     * */

    public $name;

    /**
     *
     * @var string $prefix
     * @description Unique Identifier of the plugin
     *
     * */
    public $prefix;

    /**
     *
     * @var string $version
     * @description Version number of the plugin
     *
     * */
    public $version;

    /**
     *
     * @var string $path
     * @description Root path of this plugin
     * 
     * */
    public $path;

    /**
     *
     * @var string $url
     * @description Root URL of the plugin
     *
     * */
    public $url;

    /**
     *
     * @var string $upload_path
     * @description Upload directory path of the plugin
     *
     * */
    public $upload_path; // Use this if you need upload directory

    /**
     *
     * @var string $upload_url
     * @description Upload directory URL of the plugin
     *
     * */
    public $upload_url; // Use this if you need upload directory

    /**
     *
     * @var mixed $options
     * @description Options store for the plugin
     *
     * */
    public $options;

    /**
     * 
     * @var array $shortcode_data
     * @description Shortcode Data to be stored.
     * 
     * */
    public $shortcode_data;

    /**
     * 
     * @var string $shortcode_html
     * @description Shortcode return html data storage.
     * 
     * */
    public $shortcode_html;

    /**
     *
     * @var string $website
     * @description Website of the plugin
     *
     * */
    public $website;

    /**
     *
     * @var string $support
     * @description Support page URL
     *
     * */
    public $support;

    /**
     *
     * @var string $feedback
     * @description Feedback/Review Page URL
     * 
     * */
    public $feedback;

    /**
     *
     * @var string $logo_url
     * @description URL of the logo
     *
     * */
    public $logo_url;

    /**
     *
     * @function __construct
     * @description Main constructor function of the plugin
     * @param string $name Name of the plugin
     * @return void
     * 
     * */
    public function __construct($name) {

        // Plugin data initialization
        $this->name = trim($name);
        $this->prefix = 'gb_' . str_replace(' ', '-', strtolower($this->name));
        $this->path = plugin_dir_path(__FILE__);
        $this->url = plugin_dir_url(__FILE__);

        // URLS and extras
        $this->version = '1.0.0';
        $this->website = '';
        $this->support = '';
        $this->feedback = '';
        $this->logo_url = '';

        // Options
        $this->options = get_option($this->prefix);
        if (empty($this->options))
        $this->options = array();
        register_shutdown_function(array(&$this, 'gb_save_options')); // Works as destructor for the object
        
        // Working with upload directory
        $upload = wp_upload_dir(); // Upload Directory
        $this->upload_path = $upload['basedir'] . DS . $this->prefix; // Path
        $this->upload_url = $upload['baseurl'] . '/' . $this->prefix; // URL
        if (!is_dir($this->upload_path))
            mkdir($this->upload_path, 0755); // Creates the upload directory if it is not their


            
        // Plugin Action Links on plugin.php page
        //auto::  add_filter('plugin_action_links', array(&$this, 'plugin_page_links'), 10, 2);
        // Adding hooks
        // add_action('hook_name', array(&$this, 'function_name'));
        
        // Frontend assets Registration
        add_action('wp_enqueue_scripts', array(&$this, 'assets'));

        // Admin assets Registration
        add_action('admin_enqueue_scripts', array(&$this, 'admin_assets'));

        // Custom post
        add_action('init', array(&$this, 'meet_the_team'));

        // Adding menu
        add_action('admin_menu', array(&$this, 'menu'));

        // Adding Shortcode
        add_shortcode('gb_mtt', array(&$this, 'gb_mtt')); // Mega Testimonial Shortcode
        
        // Ajax Call
        add_action('wp_ajax_ajax_backend_example', array(&$this, 'ajax_backend_general_example')); // Logged in users
        add_action('wp_ajax_ajax_frontend_example', array(&$this, 'ajax_frontend_general_example')); // Logged in users
        add_action('wp_ajax_nopriv_ajax_frontend_example', array(&$this, 'ajax_frontend_general_example')); // Guest in users
        // Widget
        include($this->path . 'views' . DS . 'widget' . DS . 'test-widget.php'); // Including widget file
        add_action('widgets_init', create_function('', 'register_widget("GBTestWidget");'));

        // Save Testimonial post
        add_action('save_post', array(&$this, 'save_meta_boxes'));

        // Change MTT Custom Post Title
        add_filter('enter_title_here', array(&$this, 'change_title_text_mtt'));

        // MTT custom colum in CTP
        add_filter('manage_meet_the_team_posts_columns', array(&$this, 'custom_mtt_columns_head'));
        add_action('manage_meet_the_team_posts_custom_column', array(&$this, 'custom_mtt_columns_content'), 10, 2);
        add_action('the_content', array(&$this, 'mtt_limit_the_content'));
        
        // Custom Post Taxenomy
        add_action('init', array(&$this, 'create_gb_mtt_taxonomies'));
        
        // Create an Extra Colum in MTT Group Taxenomy
        add_filter('manage_edit-mtt_group_columns', array(&$this, 'add_group_tax_columns'));
        add_filter('manage_mtt_group_custom_column', array(&$this, 'add_group_tax_column_content'),10,3);
        
        // Team Showcase Plugin call to action link 
        add_action('plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'mtt_action_links'), 10, 2);
    }

    /**
     * 
     * @function assets
     * @description Registers assets to be loaded later where needed.
     * @param void
     * @return null
     * 
     * */
    public function assets() {

        // Style Sheets
        wp_register_style('mtt-bootstrap-main-style', $this->url . 'external/bootstrap-3.3.7/css/bootstrap.min.css', array(), '3.3.7'); // Bootstrap Main File.
        wp_register_style('mtt-owl-style', $this->url . 'assets/css/owl.carousel.min.css'); // Owl Carousel CSS.
        wp_register_style('mtt-owl-theme-style', $this->url . 'assets/css/owl.theme.min.css'); // Owl Theme CSS.
        wp_register_style('mtt-font-awsome-style', $this->url . 'external/bootstrap-3.3.7/css/font-awesome.min.css', array('mtt-bootstrap-main-style'), '4.7.0'); // Font Awsome Main File.
        wp_register_style('mtt-frontend-style', $this->url . 'assets/css/frontend-style.css'); // Custom style for the frontend.
        
        // Templete CSS
        wp_register_style('mtt-free-one-style', $this->url . 'views/templates/free_design_01/css/free_design_01.css'); // Free Templete 01 CSS
        wp_register_style('mtt-free-two-style', $this->url . 'views/templates/free_design_02/css/free_design_02.css'); // Free Templete 02 CSS
        wp_register_style('mtt-free-three-style', $this->url . 'views/templates/free_design_03/css/free_design_03.css'); // Free Templete 03 CSS
        wp_register_style('mtt-free-four-style', $this->url . 'views/templates/free_design_04/css/free_design_04.css'); // Free Templete 04 CSS
        wp_register_style('mtt-free-five-style', $this->url . 'views/templates/free_design_05/css/free_design_05.css'); // Free Templete 05 CSS
        
        // Javascript
        wp_register_script('mtt-bootstrap-main-script', $this->url . 'external/bootstrap-3.3.7/js/bootstrap.min.js', array('jquery'), '3.3.7'); // Custom script for the frontend.
        wp_register_script('mtt-owl-script', $this->url . 'assets/js/owl.carousel.min.js', array('jquery')); // Custom script for the frontend.
        wp_register_script('mtt-frontend-script', $this->url . 'assets/js/frontend-script.js', array('jquery')); // Custom script for the frontend.
        wp_localize_script('mtt-frontend-script', 'GB_AJAXURL', array(admin_url('admin-ajax.php'))); // Assigning GB_AJAXURL on the frontend
        wp_localize_script('mtt-frontend-script', '_GB_SECURITY', array(wp_create_nonce("gb-ajax-nonce"))); // Assigning GB_AJAXURL on the frontend
    }

    /**
     * 
     * @function admin_assets
     * @description Loads admin assets
     * @param void
     * @return void
     * 
     * */
    public function admin_assets() {

        // Style Sheets
        wp_register_style('mtt-bootstrap-main-style', $this->url . 'external/bootstrap-3.3.7/css/bootstrap.min.css', array(), '3.3.7'); // Bootstrap Main File.
        wp_register_style('mtt-bootstrap-material-theme-style', $this->url . 'external/bootstrap-3.3.7/css/bootstrap-theme.min.css', array('mtt-bootstrap-main-style'), '4.0.2'); // Bootstrap Material Theme.
        wp_register_style('mtt-custom-main-style', $this->url . 'external/bootstrap-3.3.7/css/custom.css', array(), '1.1.1.0'); // Custom Main File.
        wp_register_style('mtt-bootstrap-material-theme-ripples-style', $this->url . 'external/bootstrap-3.3.7/css/ripples.min.css', array('mtt-bootstrap-material-theme-style'), '4.0.2'); // Bootstrap Material Theme.
        wp_register_style('mtt-admin-style', $this->url . 'assets/css/admin-style.css', array('mtt-bootstrap-material-theme-ripples-style')); // Custom style for the frontend.
        
        // Fonts and Icons
        wp_register_style('mtt-font-awsome-style', $this->url . 'external/bootstrap-3.3.7/css/font-awesome.min.css', array('mtt-bootstrap-main-style'), '4.7.0'); // Font Awsome Main File.
        
        // Javascript
        wp_register_script('mtt-bootstrap-main-script', $this->url . 'external/bootstrap-3.3.7/js/bootstrap.min.js', array('jquery'), '3.3.7'); // Custom script for the frontend.
        wp_register_script('mtt-admin-script', $this->url . 'assets/js/admin-script.js', array('mtt-bootstrap-main-script')); // Custom script for the frontend.
        wp_register_script('mtt-material-script', $this->url . 'external/bootstrap-3.3.7/js/material.min.js', array('mtt-bootstrap-main-script', array('jquery'), '1.1.1.0')); // Material script for the frontend.
        wp_register_script('mtt-material-kit-script', $this->url . 'external/bootstrap-3.3.7/js/material-kit.js', array('mtt-bootstrap-main-script', array('jquery'), '1.1.1.0')); // Material Script script for the frontend.
        wp_register_script('mtt-nouislider-script', $this->url . 'external/bootstrap-3.3.7/js/nouislider.min.js', array('mtt-bootstrap-main-script', array('jquery'), '1.1.1.0')); // Nouislider script for the frontend.
        wp_localize_script('mtt-admin-script', 'GB_AJAXURL', array(admin_url('admin-ajax.php'))); // Assigning GB_AJAXURL on the frontend
        wp_localize_script('mtt-admin-script', '_GB_SECURITY', array(wp_create_nonce("gb-ajax-nonce"))); // Assigning GB_AJAXURL on the frontend
    }

    /**
     *
     * @function gb_save_options
     * @description Saves the option when the object closes
     * @param void
     * @return void
     *
     * */
    public function gb_save_options() {
        update_option($this->prefix, $this->options);
    }

    /**
     * 
     * @function meet_the_team
     * @description Adds a custom post type to wordpress
     * @param void
     * @return void
     * 
     * */
    public function meet_the_team() {

        register_post_type(
                'meet_the_team', array(
                'labels' => array(
                'name' => __('Meet The Team'),
                'singular_name' => __('Meet The Team'),
                'add_new' => __('Add New Member'),
                'add_new_item' => __('Add New Team Member'),
                'all_items' => __('All Member'),
            ),
            'description' => 'This Custom Post Manages the Team Member Cretancials',
            'public' => true,
            'hierarchical' => true,
            'exclude_from_search' => false,
            'capability_type' => 'post', // Adding capability for custom post
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menu' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-groups',
            'taxonomies' => array('mtt_group'),
            'has_archive' => true,
            'featured_image' => true,
            'supports' => array('title', 'editor', 'author', 'thumbnail'),
            'register_meta_box_cb' => array(&$this, 'add_mtt_metaboxes'),
                )
        );
    }

    /**
     * 
     * @function change_title_text_mtt
     * @description Change the custom post title placeholder
     * @param $title
     * @return $title
     * 
     * */
    function change_title_text_mtt($title) {
        $screen = get_current_screen();
        if ('meet_the_team' == $screen->post_type) {
            $title = 'Enter Member Name';
        }
        return $title;
    }

    /**
     * 
     * @function menu
     * @description Adding admin menu to the WordPress admin dashboard
     * 
     * */
    public function menu() {

        // Adding Setting submenu
        add_submenu_page(
                'edit.php?post_type=meet_the_team', // Parent Slug
                'Meet The Team Settings', // Page title
                'Settings', // Submenu title
                'administrator', // User capabilities
                'mtt-submenu', // Menu Slug
                create_function('', 'require_once( plugin_dir_path( __FILE__ ) . "views" . DS . "admin" . DS . "settings.php" );')
        );
    }

    /**
     *
     * @function gb_mtt
     * @description Shortcode example for the plugin
     * @param array $data
     * @return html
     *
     * */
    public function gb_mtt($data) {
        $this->shortcode_data = $data;
        // Including file for shortcode
        include $this->path . 'views' . DS . 'shortcodes' . DS . 'mtt_shortcode.php';
        return $this->shortcode_html;
    }

    /**
     * 
     * @function ajax_frontend_general_example
     * @description Example of ajax call for non logged in and logged in users
     * @param void
     * @return void
     * 
     * */
    public function ajax_frontend_general_example() {
        check_ajax_referer('gb-ajax-nonce', '_gb_security');
        echo 'Response Content';
        wp_die();
    }

    /**
     * 
     * @function ajax_backend_general_example
     * @description Example of ajax call for logged in users
     * @param void
     * @return void
     * 
     * */
    public function ajax_backend_general_example() {
        check_ajax_referer('gb-ajax-nonce', '_gb_security');
        echo 'Response Content';
        wp_die();
    }

    /**
     * 
     * @function test_template
     * @description Example of template functions
     * @param array $data
     * @return void
     * @usage
     * 	global $wordpress_plugin_boilerplage;
     * 	$wordpress_plugin_boilerplage->test_template();
     * */
    public function test_template($data = array(1, 2, 3, 5)) {
        pr($data);
    }

    /**
     *
     * @function custom_metabox_testimonial
     * @description adds custom metabox for testimonial options
     * @param array $post
     * @return void
     *
     * */
    public function add_mtt_metaboxes($post) {
        add_meta_box(
                'mtt_metabox', __('Member Information', 'mtt_plugin'), array(&$this, 'render_meta_boxes'), 'meet_the_team', 'normal', 'high'
        );
    }

    /**
     *
     * @function render_meta_boxes
     * @description render metabox for testimonial provider options
     * @param array $post
     * @return void
     *
     * */
    public function render_meta_boxes($post) {

        $meta = get_post_custom($post->ID);
        $job_desc = !isset($meta['profile_job_desc'][0]) ? '' : $meta['profile_job_desc'][0];
        $location = !isset($meta['profile_location'][0]) ? '' : $meta['profile_location'][0];
        $company = !isset($meta['profile_company'][0]) ? '' : $meta['profile_company'][0];
        $email = !isset($meta['profile_email'][0]) ? '' : $meta['profile_email'][0];
        $facebook = !isset($meta['profile_facebook'][0]) ? '' : $meta['profile_facebook'][0];
        $google_plus = !isset($meta['profile_google_plus'][0]) ? '' : $meta['profile_google_plus'][0];
        $twitter = !isset($meta['profile_twitter'][0]) ? '' : $meta['profile_twitter'][0];
        $linkedin = !isset($meta['profile_linkedin'][0]) ? '' : $meta['profile_linkedin'][0];
        $url = !isset($meta['profile_url'][0]) ? '' : $meta['profile_url'][0];

        wp_nonce_field(basename(__FILE__), 'profile_fields');
        ?>

        <table class="form-table">

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_job_desc"><strong><?php _e('Job Description', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_job_desc" class="regular-text" value="<?php echo $job_desc; ?>">
                    <p class="description"><?php _e('Save Member Job Description', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_location"><strong><?php _e('Location', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_location" class="regular-text" value="<?php echo $location; ?>">
                    <p class="description"><?php _e('Save Member location', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_company"><strong><?php _e('Company', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_company" class="regular-text" value="<?php echo $company; ?>">
                    <p class="description"><?php _e('Save Member Current Company', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_email"><strong><?php _e('Email', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_email" class="regular-text" value="<?php echo $email; ?>">
                    <p class="description"><?php _e('Save Member Email ID', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_facebook"><strong><?php _e('Facebook', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_facebook" class="regular-text" value="<?php echo $facebook; ?>">
                    <p class="description"><?php _e('Save Member Facebook Link', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_google_plus"><strong><?php _e('Google Plus', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_google_plus" class="regular-text" value="<?php echo $google_plus; ?>">
                    <p class="description"><?php _e('Save Member Google Plus Link', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_twitter"><strong><?php _e('Twitter', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_twitter" class="regular-text" value="<?php echo $twitter; ?>">
                    <p class="description"><?php _e('Save Member Twitter Link', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_linkedin"><strong><?php _e('LinkedIn', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_linkedin" class="regular-text" value="<?php echo $linkedin; ?>">
                    <p class="description"><?php _e('Save Member LinkedIN Link', 'team-post-type'); ?></p>
                </td>
            </tr>

            <tr>
                <td class="team_meta_box_td" colspan="2">
                    <label for="profile_url"><strong><?php _e('Link URL', 'team-post-type'); ?></strong></label>
                </td>
                <td colspan="4">
                    <input type="text" name="profile_url" class="regular-text" value="<?php echo $url; ?>">
                    <p class="description"><?php _e('Save Member Personal link', 'team-post-type'); ?></p>
                </td>
            </tr>

        </table>

        <?php
    }

    /**
     *
     * @function custom_metabox_testimonial
     * @description adds custom metabox for testimonial options
     * @param array $post
     * @return void
     *
     * */
    public function save_meta_boxes($post_id) {

        global $post;
        pr($post);

        // Verify nonce
        if (!isset($_POST['profile_fields']) || !wp_verify_nonce($_POST['profile_fields'], basename(__FILE__))) {
            return $post_id;
        }

        // Check Autosave
        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit'])) {
            return $post_id;
        }

        // Don't save if only a revision
        if (isset($post->post_type) && $post->post_type == 'revision') {
            return $post_id;
        }

        // Check permissions
        if (!current_user_can('edit_post', $post->ID)) {
            return $post_id;
        }

        $meta['profile_location'] = ( isset($_POST['profile_location']) ? esc_textarea($_POST['profile_location']) : '' );

        $meta['profile_job_desc'] = ( isset($_POST['profile_job_desc']) ? esc_textarea($_POST['profile_job_desc']) : '' );

        $meta['profile_company'] = ( isset($_POST['profile_company']) ? esc_textarea($_POST['profile_company']) : '' );

        $meta['profile_email'] = ( isset($_POST['profile_email']) ? esc_textarea($_POST['profile_email']) : '' );

        $meta['profile_facebook'] = ( isset($_POST['profile_facebook']) ? esc_textarea($_POST['profile_facebook']) : '' );

        $meta['profile_google_plus'] = ( isset($_POST['profile_google_plus']) ? esc_textarea($_POST['profile_google_plus']) : '' );

        $meta['profile_twitter'] = ( isset($_POST['profile_twitter']) ? esc_textarea($_POST['profile_twitter']) : '' );

        $meta['profile_linkedin'] = ( isset($_POST['profile_linkedin']) ? esc_textarea($_POST['profile_linkedin']) : '' );

        $meta['profile_url'] = ( isset($_POST['profile_url']) ? esc_textarea($_POST['profile_url']) : '' );

        foreach ($meta as $key => $value) {
            update_post_meta($post->ID, $key, $value);
        }
    }

    /**
     *
     * @function custom_mtt_get_featured_image
     * @description adds custom testimonial featured image
     * @param array $post
     * @return $thumbnail post id
     *
     * */
    public function custom_mtt_get_featured_image($post_ID) {
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
            return $post_thumbnail_img[0];
        }
    }

    /**
     *
     * @function custom_mtt_columns_head
     * @description adds custom post colums
     * @param array $post
     * @return $defaults
     *
     * */
    public function custom_mtt_columns_head($defaults) {
        $defaults = array();
        $defaults['cb'] = '<input type="checkbox" />';
        $defaults['thumbnail'] = 'Avatar';
        $defaults['title'] = 'Title';
        $defaults['detail'] = 'Detail';
        $defaults['mtt_group'] = 'Groups';
        $defaults['author'] = 'Author';
        $defaults['date'] = 'Date';
        return $defaults;
    }

    /**
     *
     * @function custom_mtt_columns_content
     * @description get the contents for the cuatom colums
     * @param array $colum_name , $post_ID
     * @return $defaults
     *
     * */
    public function custom_mtt_columns_content($column_name, $post_ID) {

        switch ($column_name) {
            case 'thumbnail':
                the_post_thumbnail(array('100px', '100px'));
                break;

            case 'detail':
                the_excerpt();
                break;

            case 'mtt_group':
                the_terms($post_ID, 'mtt_group');
                break;

            case 'short_code':
                echo "[gb_mtt id='{$post_ID}']";
                break;

            default:
                # Something ...
                break;
        }
    }

    /**
     *
     * @function mtt_limit_the_content
     * @description View limited range of post detail for the contents
     * @param array $content
     * @return $string
     *
     * */
    public function mtt_limit_the_content($content) {
        $word_limit = 15;
        $words = explode(' ', $content);
        return implode(' ', array_slice($words, 0, $word_limit)) . ' ...';
    }
    
    /**
     *
     * @function create_gb_mtt_taxonomies
     * @description a taxenomy for the Mega Testimonial custom post type
     * @param array none
     * @return void
     *
     * */
    function create_gb_mtt_taxonomies() {
        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => _x('Member Groups', 'taxonomy general name', 'textdomain'),
            'singular_name' => _x('Memeber Group', 'taxonomy singular name', 'textdomain'),
            'search_items' => __('Search Groups', 'textdomain'),
            'all_items' => __('All Group', 'textdomain'),
            'parent_item' => __('Parent Group', 'textdomain'),
            'parent_item_colon' => __('Parent Group:', 'textdomain'),
            'edit_item' => __('Edit Group', 'textdomain'),
            'update_item' => __('Update Group', 'textdomain'),
            'add_new_item' => __('Add New Group', 'textdomain'),
            'new_item_name' => __('New Group Name', 'textdomain'),
            'menu_name' => __('Groups', 'textdomain'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'mtt_group'),
        );

        register_taxonomy('mtt_group', array('meet_the_team'), $args);
    }
    
    /**
     *
     * @function add_group_tax_columns
     * @description add a extra shortcode colum in group taxenomy
     * @param array $columns
     * @return $columns
     *
     * */
    function add_group_tax_columns($columns){
        $columns['mtt_group_short_code'] = 'Shortcode';
        return $columns;
    }
    
    /**
     *
     * @function add_group_tax_column_content
     * @description add shortcode content at shortcode colum in group taxenomy
     * @param array none
     * @return void
     *
     * */
    function add_group_tax_column_content($content,$column_name,$term_id){
        
        switch ($column_name) {
           
            case 'mtt_group_short_code':
                echo "[gb_mtt group_id='{$term_id}']";
                break;

            default:
                # Something ...
                break;
        }
    }
    
    /**
     *
     * @function mtt_action_links
     * @description Team Showcase Plugin Call to Action function.
     * @param array link
     * @return link
     *
     * */
    function mtt_action_links( $links ) {
	$links = array_merge( array(
		'<a href="' . admin_url( 'edit.php?post_type=meet_the_team&page=mtt-submenu' ) . '">' . __( 'Settings', 'textdomain' ) . '</a>',
                '<a href="' . admin_url( 'edit-tags.php?taxonomy=mtt_group&post_type=meet_the_team' ) . '">' . __( 'Groups', 'textdomain' ). '</a>'
	), $links );
	return $links;
    }    
}

/**
 * 
 * @function pr
 * @description Formatted output of print_r function
 * @param mixed $obj
 * @return void
 * 
 * */
if (!function_exists('pr')):

    function pr($obj) {
        echo "<pre>";
        print_r($obj);
        echo "</pre>";
    }

endif;

// Declaring the global variable for this plugin
global $wp_team_showcase;
$wp_team_showcase = new TeamShowcase('WordPress Meet The Teem');
