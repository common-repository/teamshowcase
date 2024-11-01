<?php
/**
 * 
 * @file sidebar.php
 * @description Sidebar section for the admin page
 * */
// Security Check
if (!defined('ABSPATH')) die();
global $wp_team_showcase;
?>
<div class='row'>
    <div class='col-sm-12'>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="text-align: center"><strong>General Settings Detail</strong></h4>
                <hr>
                <p>
                    General settings mainly concerns of tuning the general information showing in the visitor frontend.
                    The informations of your team members you want to show, just check out to display them. Two different 
                    panel is placed in the settings panel to control general and group type.
                </p>
            </div>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="text-align: center"><strong>About The Themes</strong></h4>
                <hr>
                <p>
                    Themes are the main decoration kit to show off your team members in eye catchy way. With the plugin you have some 
                    themes with it and you can use them that suites your site very much or love to play with designs. General and Group 
                    themes are placed in separate panels.  
                </p>
            </div>
        </div>
    </div>
    <div class='col-sm-12'>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="text-align: center"><strong>Shortcode Detail</strong></h4>
                <hr>
                <p>
                    Shortcodes are the easy way to place your Team Showcases in different place in your site. There are two different 
                    shortcode type to display general and grouped Team Show available for you.<br>
                    <strong>General Shortcode</strong> <code>[gb_mtt]</code><br>
                    <strong>Grouped Shortcode</strong> <code>[gb_mtt group_id='36']</code>
                </p>
            </div>
        </div>
    </div>
</div>
