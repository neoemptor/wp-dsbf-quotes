<?php
// https://unitedtrophiesandbadges.local/wp-json/utb/v1/books
function register_books_routes() {
	register_rest_route( 'utb/v1', '/books', array(
			'methods'      => 'GET',
			'callback'     => 'get_all_books',
//			'permission_callback' => function ( $request ) {
//				return current_user_can( 'read' );
//			},
			'show_in_rest' => WP_REST_Server::READABLE
		)
	);
}

add_action( 'rest_api_init', 'register_books_routes' );
