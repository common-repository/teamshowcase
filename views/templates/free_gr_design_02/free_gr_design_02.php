<?php
/**
 * @file free_gr_design_02.php
 * @description Free MTT Group Design Two
 * 
 * */
// Security Check
if (!defined('ABSPATH'))
    die();

wp_enqueue_style('mtt-free-two-style');

global $wp_team_showcase;
$group_id = $wp_team_showcase->shortcode_data['group_id'];

?>

<div class="container-fluid">

    <div class="starter-template">
        <div class="row">
            <?php
                $args = array(
                    'post_type' => 'meet_the_team',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'mtt_group',
                            'terms' => $group_id
                        ),
                    ),
                );
                $group_query = new WP_Query($args);
                if ($group_query->have_posts()) {
                    while ($group_query->have_posts()) {
                        $group_query->the_post();
                        $postID = $group_query->post->ID;
                        ?>

                    <div style="margin-bottom:15px" class="col-md-4 col-sm-4">
                        <div class="our-team">
                            <div class="pic">
                                <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_fimage'])) echo the_post_thumbnail('medium') ?>
                            </div>
                            <div class="team-prof">
                                <h3 class="post-title">
                                    <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_title'])) the_title() ?>
                                </h3>
                                <span class="post">
                                    <?php
                                    if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_job']))
                                        echo '<i class="fa fa-briefcase"></i> ' . get_post_meta($postID, 'profile_job_desc', true);
                                    if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_company']))
                                        echo ', ' . get_post_meta($postID, 'profile_company', true);
                                    ?> 
                                </span>
                                <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_location'])) echo '<h5 class="post"><i class="fa fa-globe"></i> ' . get_post_meta($postID, 'profile_location', true) . '</h5>'; ?>
                                <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_email'])) echo '<h5 class="post"><i class="fa fa-envelope"></i> ' . get_post_meta($postID, 'profile_email', true) . '</h5>'; ?>
                                <hr>
                                <ul class="team_social">
                                    <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_facebook'])) echo '<li><a href="' . get_post_meta($postID, 'profile_facebook', true) . '"><i class="fa fa-facebook"></i></a></li>'; ?>
                                    <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_gplus'])) echo '<li><a href="' . get_post_meta($postID, 'profile_google_plus', true) . '"><i class="fa fa-google-plus"></i></a></li>'; ?>
                                    <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_twitter'])) echo '<li><a href="' . get_post_meta($postID, 'profile_twitter', true) . '"><i class="fa fa-twitter"></i></a></li>'; ?>
                                    <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_linkedin'])) echo '<li><a href="' . get_post_meta($postID, 'profile_linkedin', true) . '"><i class="fa fa-linkedin"></i></a></li>'; ?>
                                    <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_url'])) echo '<li><a href="' . get_post_meta($postID, 'profile_url', true) . '"><i class="fa fa-rss"></i></a></li>'; ?>
                                </ul>
                                <?php if (isset($wp_team_showcase->options['general-settings']['group-mtt']['gr_mtt_desc'])) echo '<p class="description"> ' . get_the_content() . '</p>'; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                    <div style="max-width: 50%; margin: 0 auto" class="alert alert-warning">
                        <i class="fa fa-info-circle"></i> <strong>Sorry!</strong> No Group with this ID is created or no member is available
                        in this group ! Create Your Groups or Members From The Admin Panel First ! 
                    </div>
                <?php
            }
            wp_reset_query();
            ?>
        </div>
    </div>
</div>


