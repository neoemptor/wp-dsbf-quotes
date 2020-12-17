<?php
// https://unitedtrophiesandbadges.local/wp-json/utb/v1/clients
function register_clients_routes() {
	register_rest_route( 'utb/v1', '/clients', array(
			'methods'      => 'GET',
			'callback'     => 'get_all_clients',
//			'permission_callback' => function ( $request ) {
//				return current_user_can( 'read' );
//			},
			'show_in_rest' => WP_REST_Server::READABLE
		)
	);
}

add_action( 'rest_api_init', 'register_clients_routes' );
