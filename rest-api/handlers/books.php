<?php
// example: https://unitedtrophiesandbadges.local/wp-json/utb/v1/clients
function get_all_books( $request ) {
//	global $wpdb;
	return get_all_records_from_table('utb_books');
}
