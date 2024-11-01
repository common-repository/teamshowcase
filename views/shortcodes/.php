<?php
/**
 * 
 * @file example_shortcode.php
 * @description Example shortcode outpub
 * 
 * */

// Security Check
if(!defined('ABSPATH')) die();

// Assets loading
wp_enqueue_style('mtt-frontend-style');
wp_enqueue_script('mtt-frontend-script');

global $wp_team_showcase;
ob_start();
?>
<?php //pr($wordpress_plugin_boilerplage->shortcode_data);?>

<div id='wpb-display'>Display Here</div>
<button id='wpb-click'>Click</button>

<?php
$wp_team_showcase->shortcode_html = ob_get_contents();
ob_end_clean();
?>
