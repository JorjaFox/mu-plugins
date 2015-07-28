<?php
/*
Plugin Name: JFO Functions
Plugin URI:
Description: Instead of putting it all in my functions.php, I've made a functional plugin.
Version: 1.0
Author: Mika Epstein
Author URI: http://www.ipstenu.org/
*/

// Media
if ( ! isset( $content_width ) ) $content_width = 600;

add_filter('upload_mimes', 'add_custom_upload_mimes');
function add_custom_upload_mimes($existing_mimes){
    $existing_mimes['epub'] = 'application/epub+zip'; //allow epub files
    $existing_mimes['webm'] = 'video/webm'; //allow webm file
    return $existing_mimes;
}

// Prevent self-pings
function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	  if ( 0 === strpos( $link, $home ) )
        unset($links[$l]);
	}
add_action( 'pre_ping', 'no_self_ping' );

// No comments on attachment pages
function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

// RSS feeds get extra info for UTM tracking
function jfo_rsslinktagger( $guid ) {
	global $post;
	if ( is_feed() ) {
		$delimiter = '?';
		if ( strpos( $guid, $delimiter ) > 0 )
			$delimiter = '&amp;';
		return $guid . $delimiter . 'utm_source=rss&amp;utm_medium=rss&amp;utm_campaign=jforss';
	}
	return $guid;
}
add_filter( 'the_permalink_rss', 'jfo_rsslinktagger', 99 );