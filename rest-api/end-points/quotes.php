<?php
// https://unitedtrophiesandbadges.local/wp-json/utb/v1/quotes
function register_quotes_routes() {
	register_rest_route( 'utb/v1', '/quotes', array(
			'methods'      => 'GET',
			'callback'     => 'get_all_quotes',
//			'permission_callback' => function ( $request ) {
//				return current_user_can( 'read' );
//			},
			'show_in_rest' => WP_REST_Server::READABLE
		)
	);
}

add_action( 'rest_api_init', 'register_quotes_routes' );

// https://unitedtrophiesandbadges.local/wp-json/utb/v1/quotes?clientId=1
function register_quotes_by_client_routes() {
	register_rest_route( 'utb/v1', '/quotes/clientId', array(
			'methods'      => 'GET',
			'callback'     => 'get_quotes_by_client',
//			'permission_callback' => function ( $request ) {
//				return current_user_can( 'read' );
//			},
			'show_in_rest' => WP_REST_Server::READABLE
		)
	);
}

add_action( 'rest_api_init', 'register_quotes_by_client_routes' );
