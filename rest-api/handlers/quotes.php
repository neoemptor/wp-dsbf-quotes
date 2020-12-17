<?php
function get_all_quotes( $request ) {
	get_all_records_from_table('utb_quotes');
}

function get_quotes_by_client($request) {
	get_records_by_field_name(
		'utb_quotes',
		'clientId',
		'=',
		$request['clientId']
	);
}

function add_quote( $request ) {
	global $wpdb;

	$query = "INSERT INTO `utb_quotes` VALUES (DEFAULT, DEFAULT);";

	return $wpdb->get_results( $query );
}
