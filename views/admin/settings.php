<?php
/**
 * 
 * @file settings.php
 * @description This page is responsibe for the total settings of the plugin.
 * 
 * */
// Security Check
if (!defined('ABSPATH')) die();
global $wp_team_showcase;

if (isset($_POST['general_settings'])) {
        # General Setting Options
        echo "<br>";
        echo "<div style='max-width:98%' class='alert alert-success class='close' data-dismiss='alert' aria-label='Close'><strong> General Settings Has Been Saved Successfully ! </strong></div>";
        if(isset($_POST) && !empty($_POST)) $wp_team_showcase->options['general-settings']['general-mtt'] = $_POST;
        // pr($wp_team_showcase->options['general-settings']['general-mtt']);
    }
    elseif (isset($_POST['group_settings'])) {
        # Group Settings Options
        echo "<br>";
        echo "<div style='max-width:98%' class='alert alert-success class='close' data-dismiss='alert' aria-label='Close'><strong> Group Settings Has Been Saved Successfully ! </strong></div>";
        if(isset($_POST) && !empty($_POST)) $wp_team_showcase->options['general-settings']['group-mtt'] = $_POST;
        // pr($wp_team_showcase->options['general-settings']['group-mtt']);
    }
    elseif (isset($_POST['general_theme'])) {
        # General Theme Settings
        echo "<br>";
        echo "<div style='max-width:98%' class='alert alert-success class='close' data-dismiss='alert' aria-label='Close'><strong> General Theme Changes Has Been Saved Successfully ! </strong></div>";
        if(isset($_POST) && !empty($_POST)) $wp_team_showcase->options['general-themes']['general-mtt'] = $_POST;
        // pr($wp_team_showcase->options['general-themes']['general-mtt']);
    }
    elseif (isset($_POST['group_theme'])) {
        # Group Theme Settings
        echo "<br>";
        echo "<div style='max-width:98%' class='alert alert-success class='close' data-dismiss='alert' aria-label='Close'><strong> Group Theme Changes Has Been Saved Successfully ! </strong></div>";
        if(isset($_POST) && !empty($_POST)) $wp_team_showcase->options['general-themes']['group-mtt'] = $_POST;
        // pr($wp_team_showcase->options['general-themes']['group-mtt']);
    }

?>

<div class='row mtt-header'><?php include 'partials/header.php' ?></div>

<div class="section section-tabs">
    <div class="container">
        <div style="width:100%;" class="row">
            <div class="col-md-8">
                <!-- Tabs with icons on Card -->
                <div class="card card-nav-tabs">
                    <div class="header header-success">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="active">
                                        <a href="#general_settings" data-toggle="tab">
                                            <i class="fa fa-cog"></i>
                                            General Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#theme_options" data-toggle="tab">
                                            <i class="fa fa-picture-o"></i>
                                            Themes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#short_code" data-toggle="tab">
                                            <i class="fa fa-link"></i>
                                            Shortcode
                                        </a>

                                    </li>
                                    <li>
                                        <a href="#about_plugin" data-toggle="tab">
                                            <i class="fa fa-info-circle"></i>
                                            About
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="general_settings">
                                <h3><strong>General Settings</strong></h3>
                                <hr/>
                                <div style="text-align: left;" class="testimonial-accordion">
                                    <div class="panel-group" id="accordion1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a style="text-decoration: none" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne"><i class="glyphicon glyphicon-align-left"></i> <strong>General Team Showcase Settings Panel</strong></a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <form method="post">
                                                      <div class="tab-pane active" id="general_mtt-v">
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_title" value='gn_mtt_title' <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_title']) ) {echo 'checked';} ?> >
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member Name ?
                                                              </label>
                                                          </div>
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_desc" value="gn_mtt_desc" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_desc']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Description of Member ?
                                                              </label>
                                                          </div>
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_fimage" value="gn_mtt_fimage" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_fimage']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show author feature image ?
                                                              </label>
                                                          </div>
                                                          <hr>
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_job" value="gn_mtt_job" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_job']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member job description ?
                                                              </label>
                                                          </div>
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_location" value="gn_mtt_location" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_location']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member location ?
                                                              </label>
                                                          </div>
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_company" value="gn_mtt_company" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_company']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member company ?
                                                              </label>
                                                          </div>
                                                          <div class="checkbox">
                                                              <label>
                                                                      <input type="checkbox" name="gn_mtt_email" value="gn_mtt_email" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_email']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member email id ?
                                                              </label>
                                                          </div>
                                                          
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_facebook" value="gn_mtt_facebook" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_facebook']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member Facebook Link ?
                                                              </label>
                                                          </div>
                                                          
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_gplus" value="gn_mtt_gplus" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_gplus']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member Google Plus Link ?
                                                              </label>
                                                          </div>
                                                          
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_twitter" value="gn_mtt_twitter" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_twitter']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member Twitter Link ?
                                                              </label>
                                                          </div>
                                                          
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_linkedin" value="gn_mtt_linkedin" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_linkedin']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show Member Linked In Link ?
                                                              </label>
                                                          </div>
                                                          
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox" name="gn_mtt_url" value="gn_mtt_url" <?php if( isset( $wp_team_showcase->options['general-settings']['general-mtt']['gn_mtt_url']) ) {echo 'checked';} ?>>
                                                                  <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                  Show testimonial author link URL ?
                                                              </label>
                                                          </div>
                                                          <p>
                                                              <button type="submit" name="general_settings" class="btn btn-success"> Save Settings</button>
                                                          </p>
                                                      </div>
                                                   </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a style="text-decoration: none" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo"><i class="glyphicon glyphicon-align-left"></i> <strong>Grouped Team Showcase Settings Panel</strong></a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                    <form method="post">
                                                          <div class="tab-pane" id="group_mtt-v">
                                                              <div class="checkbox">
                                                                  <label>
                                                                      <input type="checkbox" name="gr_mtt_title" value="gr_mtt_title" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_title']) ) {echo 'checked';} ?>>
                                                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                      Show Member Name ?
                                                                  </label>
                                                              </div>
                                                              <div class="checkbox">
                                                                  <label>
                                                                      <input type="checkbox" name="gr_mtt_desc" value="gr_mtt_desc" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_desc']) ) {echo 'checked';} ?>>
                                                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                      Show Member Detail ?
                                                                  </label>
                                                              </div>
                                                              <div class="checkbox">
                                                                  <label>
                                                                      <input type="checkbox" name="gr_mtt_fimage" value="gr_mtt_fimage" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_fimage']) ) {echo 'checked';} ?>>
                                                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                      Show Member Picture ?
                                                                  </label>
                                                              </div>
                                                              <hr>
                                                              <div class="checkbox">
                                                                  <label>
                                                                      <input type="checkbox" name="gr_mtt_job" value="gr_mtt_job" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_job']) ) {echo 'checked';} ?>>
                                                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                      Show Job Description ?
                                                                  </label>
                                                              </div>
                                                              <div class="checkbox">
                                                                  <label>
                                                                      <input type="checkbox" name="gr_mtt_location" value="gr_mtt_location" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_location']) ) {echo 'checked';} ?>>
                                                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                      Show Member Location ?
                                                                  </label>
                                                              </div>
                                                              <div class="checkbox">
                                                                  <label>
                                                                      <input type="checkbox" name="gr_mtt_company" value="gr_mtt_company" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_company']) ) {echo 'checked';} ?>>
                                                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                      Show Member Company Name ?
                                                                  </label>
                                                              </div>
                                                              <div class="checkbox">
                                                                  <label>
                                                                      <input type="checkbox" name="gr_mtt_email" value="gr_mtt_email" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_email']) ) {echo 'checked';} ?>>
                                                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                      Show Member Email ID ?
                                                                  </label>
                                                              </div>
                                                              
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="gr_mtt_facebook" value="gr_mtt_facebook" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_facebook']) ) {echo 'checked';} ?>>
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                        Show Member Facebook Link ?
                                                                    </label>
                                                                </div>
                                                              
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="gr_mtt_gplus" value="gr_mtt_gplus" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_gplus']) ) {echo 'checked';} ?>>
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                        Show Member Google Plus Link ?
                                                                    </label>
                                                                </div>
                                                              
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="gr_mtt_twitter" value="gr_mtt_twitter" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_twitter']) ) {echo 'checked';} ?>>
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                        Show Member Twitter Link ?
                                                                    </label>
                                                                </div>
                                                              
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="gr_mtt_linkedin" value="gr_mtt_linkedin" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_linkedin']) ) {echo 'checked';} ?>>
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                        Show Member Linked In Link ?
                                                                    </label>
                                                                </div>
                                                              
                                                              
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="gr_mtt_url" value="gr_mtt_url" <?php if( isset( $wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_url']) ) {echo 'checked';} ?>>
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                        Show Member Personal Link ?
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    <button type="submit" name="group_settings" class="btn btn-success"> Save Settings</button>
                                                                </p>
                                                          </div>
                                                      </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="theme_options">
                                <h3><strong>Theme Settings</strong></h3>
                                <hr>
                                <div style="text-align: left;" class="testimonial-accordion">
                                    <div class="panel-group" id="accordion2">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne1"><i class="glyphicon glyphicon-blackboard"></i> <strong>General Team Showcase Gallery</strong></a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne1" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <form method="post">
                                                      <div class="tab-pane active" id="general_mtt_th-v">
                                                          <div class="row">
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/1.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">General Theme One</button>
                                                                  <input type="checkbox" id="left-item" class="hidden" name="gn_free_slide_01" value="gn_free_slide_01" <?php if( isset( $wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_01']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/2.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">General Theme Two</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gn_free_slide_02" value="gn_free_slide_02" <?php if( isset( $wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_02']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/3.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">General Theme Three</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gn_free_slide_03" value="gn_free_slide_03" <?php if( isset( $wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_03']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/4.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">General Theme Four</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gn_free_slide_04" value="gn_free_slide_04" <?php if( isset( $wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_04']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/5.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">General Theme Five</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gn_free_slide_05" value="gn_free_slide_05" <?php if( isset( $wp_team_showcase->options['general-themes']['general-mtt']['gn_free_slide_05']) ) {echo 'checked';} ?>>
                                                              </div>
                                                          </div>
                                                          <div style="margin: 20px 0 0 -5px;" class="row">
                                                              <button type="submit" name="general_theme" class="btn btn-success"> Save Settings</button>
                                                          </div>
                                                      </div>
                                                   </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo1"><i class="glyphicon glyphicon-blackboard"></i> <strong>Grouped Team Showcase Gallery</strong></a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <form method="post">
                                                        <div class="tab-pane" id="group_mtt_th-v">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                  <img style="height: 250px" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/1.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">Group Theme One</button>
                                                                  <input type="checkbox" id="left-item" class="hidden" name="gr_free_slide_01" value="gr_free_slide_01" <?php if( isset( $wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_01']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/2.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">Group Theme Two</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gr_free_slide_02" value="gr_free_slide_02" <?php if( isset( $wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_02']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/3.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">Group Theme Three</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gr_free_slide_03" value="gr_free_slide_03" <?php if( isset( $wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_03']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/4.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">Group Theme Four</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gr_free_slide_04" value="gr_free_slide_04" <?php if( isset( $wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_04']) ) {echo 'checked';} ?>>
                                                              </div>
                                                              <div class="col-md-6">
                                                                  <img style="height: 250px;margin: 0 auto;" src="<?php echo $wp_team_showcase->url . 'assets/img/sc/5.png' ?>" class="img-responsive img-radio">
                                                                  <button type="button" class="btn btn-primary btn-radio">Group Theme Five</button>
                                                                  <input type="checkbox" id="right-item" class="hidden" name="gr_free_slide_05" value="gr_free_slide_05" <?php if( isset( $wp_team_showcase->options['general-themes']['group-mtt']['gr_free_slide_05']) ) {echo 'checked';} ?>>
                                                              </div>
                                                            </div>
                                                            <div style="margin: 20px 0 0 -5px;" class="row">
                                                                <button type="submit" name="group_theme" class="btn btn-success"> Save Settings</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="short_code">
                                <h3><strong>Shortcode Detail and Usage</strong></h3>
                                <hr>
                                <h4 style="text-align: left;"><strong>General Team Showcase Shortcode</strong> <code>[gb_mtt]</code></h4>
                                <p style="text-align:justify;font-size:16px;">
                                    This is the general type of Team Showcase shortcode where all the Member Block created will be showd as
                                    single block themes or the themes chosen form from the settings panel. This shortcode will let 
                                    you activate this kind of Team Showcase blocks. Suppose, you have created some Member for your site and 
                                    you want to show all of them in any of your pages, you can use this shortcode.
                                </p>
                                <h4 style="text-align: left;"><strong>Grouped Team Showcase item shortcode</strong> <code>[gb_mtt group_id='36']</code></h4>
                                <p style="text-align: left;font-size:16px;">
                                    This is the grouped type of Team Showcase shortcode where all the Members of a specific group will appear 
                                    on activating this shortcode with the existing group id. To apply this kind of shortcode you need to create 
                                    the groups first from the <b>Groups</b> option in the admin panel. Then assign your desired Members in 
                                    your group. After that you can use this Group Shortcode to show the group showcase.
                                </p>
                            </div>
                            <div class="tab-pane" id="about_plugin">
                                    <h3><strong>About the Plugin</strong></h3>
                                    <hr>
                                    <img class="card-img-top img-responsive" src="<?php echo $wp_team_showcase->url . 'assets/img/team-banner.jpg' ?>" alt="Team Showcase Plugin Banner">
                                    <br>
                                    <div class="card-block">
                                        <p style="text-align: left;" class="card-text">
                                            Team Showcase is the unique and ultimate solution for the WordPress powered web sites.
                                            Nice Admin Panel with some eye catchy Themes let your web site to show off your Team to the World.
                                        </p>
                                        <h4 style="text-align: left;"><strong>Feature List</strong></h4>
                                        <ul style="text-align: left;" class="list-group">
                                            <li class="list-group-item"><i class="glyphicon glyphicon-circle-arrow-right"></i> Nice and furnished Admin Panel design.</li>
                                            <li class="list-group-item"><i class="glyphicon glyphicon-circle-arrow-right"></i> Easy and handy decoration processes.</li>
                                            <li class="list-group-item"><i class="glyphicon glyphicon-circle-arrow-right"></i> Offering some handsome themes with the plugin.</li>
                                            <li class="list-group-item"><i class="glyphicon glyphicon-circle-arrow-right"></i> Two different mode to express your Team. (Ex. General Style and Grouped Style)</li>
                                            <li class="list-group-item"><i class="glyphicon glyphicon-circle-arrow-right"></i> Full custom monitoring panel with easy options.</li>
                                            <li class="list-group-item"><i class="glyphicon glyphicon-circle-arrow-right"></i> Fit for all type of web site.</li>
                                            <li class="list-group-item"><i class="glyphicon glyphicon-circle-arrow-right"></i> Working nice with different page builders.</li>
                                        </ul>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tabs with icons on Card -->
            </div>
            <div class="col-md-4">
                <div style="margin-top: -40px" class='row'><?php include 'partials/sidebar.php' ?></div>
            </div>

        </div>
    </div>
</div>
<!-- End Section Tabs -->