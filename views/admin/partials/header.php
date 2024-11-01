<?php
/**
 * 
 * @file header.php
 * @description Header section for the admin page
 * */
// Security Check
if (!defined('ABSPATH')) die();
global $wp_team_showcase;
wp_enqueue_style('mtt-admin-style');
wp_enqueue_style('mtt-font-awsome-style');
wp_enqueue_script('mtt-admin-script');
?>
<div style="margin-top: 10px" class='col-md-12'>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">TEAM SHOWCASE</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo admin_url( 'post-new.php?post_type=meet_the_team' ) ?>"><i class="fa fa-user-plus"></i> Add Team Member</a></li>
                    <li><a href="<?php echo admin_url( 'edit.php?post_type=meet_the_team' ) ?>"><i class="fa fa-user-circle-o"></i> All Member</a></li>
                    <li><a href="<?php echo admin_url( 'edit-tags.php?taxonomy=mtt_group&post_type=meet_the_team' ) ?>"><i class="fa fa-users"></i> Group</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

</div>
