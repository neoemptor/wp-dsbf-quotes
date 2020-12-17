<?php
// ---------------------------------------- General Functions ---------------------------------------------------------
function get_all_records_from_table( $table_name ) {
	global $wpdb;
	$query = "select * from `{$table_name}`;";

	return $wpdb->get_results( $query );
}

function get_records_by_field_name( $table_name, $field_name, $where_operator, $filter_content ) {
	global $wpdb;
	$query = "select * from `{$table_name}` where {$field_name} {$where_operator} $filter_content;";
	return $wpdb->get_results( $query );
}

function add_table( $request, $table_name, $field_names ) {
	global $wpdb;

	$sanitised_field_names = array();
	foreach ( $field_names as $field_name ) {
		$sanitised_field_names["{$field_name}"] = sanitize_text_field( $request[ $field_name ] );
	}

	if ( $wpdb->insert( "{$table_name}", $sanitised_field_names ) ) {
		// get new id and return to app
		$return_id = $wpdb->insert_id;

		$result = '{"success": true, "id": ' . $return_id . '}';
	} else {
		$result = '{"success": false, "id": 0}';
	}

	return $result;
}

// todo: finish refactoring
function dsbf_sanitise_fields_content($request, $fields) {
	$sanitised_fields_contents = array();
	foreach ( $fields as $field ) {
		array_push( $sanitised_fields_contents, sanitize_text_field( $request[ $field ] ) );
	}
	return $sanitised_fields_contents;
}

// todo: finish refactoring
function dsbf_sanitise_field_names($fields) {
	$sanitised_fields = array();
	foreach ( $fields as $field ) {
		array_push( $sanitised_fields, sanitize_text_field( $field ) );
	}
	return $sanitised_fields;
}

// todo: finish refactoring
function dsbf_update_table( $request, $table, $types, $fields, $where_types, $where_fields, $where_operators ) {
	global $wpdb;

	$query                     = "UPDATE `{$table}` ";
	$sanitised_fields_contents = dsbf_sanitise_fields_content($request, $fields);
	$sanitised_fields          = dsbf_sanitise_field_names($fields);

	$sanitised_where_fields_contents = dsbf_sanitise_fields_content($request, $where_fields);
	$sanitised_where_fields          = dsbf_sanitise_field_names($where_fields);

	$fieldIndex = 0;
	$fields_len = sizeof( $sanitised_fields_contents );
	$query      .= "SET ";
	foreach ( $sanitised_fields_contents as $field_content ) {
		if ( $types[ $fieldIndex ] === "string" ) {
			$query .= "`{$sanitised_fields[$fieldIndex]}` = '{$field_content}'";
		} else {
			$query .= "`{$sanitised_fields[$fieldIndex]}` = {$field_content}";
		}
		if ( $fieldIndex < ( $fields_len - 1 ) ) {
			$query .= ", ";
		}
		$fieldIndex ++;
	}
	$query .= " ";

	$query .= "WHERE ";

	$fieldIndex       = 0;
	$where_fields_len = sizeof( $sanitised_where_fields_contents );
	foreach ( $sanitised_where_fields_contents as $where_field_content ) {
		if ( $where_types[ $fieldIndex ] === "string" ) {
			$query .= "`{$sanitised_where_fields[$fieldIndex]}` = '{$where_field_content}' ";
		} else {
			$query .= "`{$sanitised_where_fields[$fieldIndex]}` = {$where_field_content} ";
		}
		if ( $fieldIndex < ( $fields_len - 1 ) ) {
			$query .= $where_operators[ $fieldIndex ] . " ";
		}
		$fieldIndex ++;
	}
	$query .= ";";
	$wpdb->query( $query );

	$success = '{"success": "true"}';

	return $success;
}

function delete_records_from_table( $request, $table_name, $where_field ) {
	global $wpdb;
	$where = array(
		"{$where_field}" => sanitize_text_field( $request["{$where_field}"] )
	);

	$wpdb->delete( "{$table_name}", $where, array( "%d" ) );
	$success = '{"success": true}';

	return $success;

}
// ===================================================================================================
