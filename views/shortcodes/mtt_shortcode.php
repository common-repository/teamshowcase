<?php

/**
 * 
 * @file mtt_shortcode.php
 * @description Tram Showcase Shortcode and Theme Controller 
 * 
 * */
// Security Check
if (!defined('ABSPATH'))
    die();
ob_start();
// Assets loading
wp_enqueue_style('wpb-bootstrap-main-style');
wp_enqueue_style('wpb-frontend-style');
wp_enqueue_script('wpb-bootstrap-main-script');
wp_enqueue_script('wpb-frontend-script');

global $wp_team_showcase;

if (empty($wp_team_showcase->shortcode_data)) {

    if (isset($wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_01'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_design_01' . DS . 'free_design_01.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_02'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_design_02' . DS . 'free_design_02.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_03'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_design_03' . DS . 'free_design_03.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_04'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_design_04' . DS . 'free_design_04.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_05'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_design_05' . DS . 'free_design_05.php';
    } else {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_design_01' . DS . 'free_design_01.php';
    }
}
if (isset($wp_team_showcase->shortcode_data['group_id'])) {

    
    if (isset($wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_01'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_gr_design_01' . DS . 'free_gr_design_01.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_02'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_gr_design_02' . DS . 'free_gr_design_02.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_03'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_gr_design_03' . DS . 'free_gr_design_03.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_04'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_gr_design_04' . DS . 'free_gr_design_04.php';
    } elseif (isset($wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_05'])) {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_gr_design_05' . DS . 'free_gr_design_05.php';
    } else {

        include $wp_team_showcase->path . 'views' . DS . 'templates' . DS . 'free_gr_design_01' . DS . 'free_gr_design_01.php';
    }
}
?>

<?php

$wp_team_showcase->shortcode_html = ob_get_contents();
ob_end_clean();
?>

