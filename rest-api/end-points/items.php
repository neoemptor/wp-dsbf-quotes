<?php
// https://unitedtrophiesandbadges.local/wp-json/utb/v1/items?clientId=1
function register_items_by_quote_routes() {
	register_rest_route( 'utb/v1', '/items', array(
			'methods'      => 'GET',
			'callback'     => 'get_items_by_quote',
//			'permission_callback' => function ( $request ) {
//				return current_user_can( 'read' );
//			},
			'show_in_rest' => WP_REST_Server::READABLE
		)
	);
}

add_action( 'rest_api_init', 'register_items_by_quote_routes' );
