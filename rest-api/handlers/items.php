<?php
// example: https://unitedtrophiesandbadges.local/wp-json/utb/v1/clients
function get_items_by_quote( $request ) {
//	global $wpdb;
	return get_records_by_field_name('utb_items', 'quoteId','=', $request['quoteId']);
}
