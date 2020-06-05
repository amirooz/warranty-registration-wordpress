<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/amirphp7
 * @since      1.0.0
 *
 * @package    Proregistration
 * @subpackage Proregistration/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

get_header();

echo do_shortcode('[helix_support_shortcode]');

get_footer();
