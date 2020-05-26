<?php
/**
 * Template Name: test123 template
 *
 *
 * Override this template by copying it to yourtheme/archive-event.php
 *
 * @author 	Digital Factory
 * @package Events Maker/Templates
 * @since 	1.1.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit; // exit if accessed directly

get_header();

get_template_part( 'content', 'event' );

get_footer();

?>