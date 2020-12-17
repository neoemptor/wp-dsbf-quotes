<?php
// example: https://unitedtrophiesandbadges.local/wp-json/utb/v1/clients
function get_all_clients( $request ) {
//	global $wpdb;
	return get_all_records_from_table('utb_clients');
}

function get_unviewed_clients( $request ) {
//	$query = "select * from `utb_clients` where `isViewed` = 0;";

// todo:
}

function get_viewed_clients( $request ) {
// todo:
}

function add_client( $request ) {
// todo:
}
