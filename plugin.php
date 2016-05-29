<?php
/*
Plugin Name: REST API GET CORS
Description: Adds CORS headers to allow cross-origin GET requests to WordPress REST API
Version: 0.0.1
Plugin URI:  http://joshpress.net/access-control-headers-for-the-wordpress-rest-api/
Description: A/B testing made easy for WordPress
Author:    Josh Pollock
Author URI:  http://JoshPress.ney
 */
/**
 * Copyright 2016 Josh Pollock
 *
 * Licensed under the terms of the GNU General Public License version 2 or later
 */
/**
 * Only allow GET requests
 */
add_action( 'rest_api_init', function() {
    
	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
	add_filter( 'rest_pre_serve_request', function( $value ) {
		$origin = get_http_origin();
		if ( $origin ) {
			header( 'Access-Control-Allow-Origin: ' . esc_url_raw( $origin ) );
		}
		header( 'Access-Control-Allow-Origin: ' . esc_url_raw( site_url() ) );
		header( 'Access-Control-Allow-Methods: GET' );

		return $value;
		
	});
}, 15 );
