<?php
/**
 * Copyright 2018 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/firestore/README.md
 */

//namespace Google\Cloud\Samples\Firestore;
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$projectId = 'utb-quotes-system';

add_data(
	$projectId,
	'darren.bailey@dsbaileyfreelancer.com.au',
	'Darren',
	'Bailey',
	'Manning Golf Club',
	'2020/11/29'
);


function add_data(
	$projectId,
	$email,
	$first_name,
	$last_name,
	$sporting_club,
	$submission_date
) {
	// Create the Cloud Firestore client
	$db = new FirestoreClient( [
		'projectId' => $projectId,
	] );
//	# [START fs_add_data_1]
	$docRef = $db->collection( 'customers' );
	if($docRef->add( [
		'email'          => $email,
		'firstName'      => $first_name,
		'lastName'       => $last_name,
		'sportingClub'   => $sporting_club,
		'submissionDate' => $submission_date
	] )) {
		return '{"success": true}';
	} else {
		return '{"success": false}';
	}
	/*printf( 'Added data to the lovelace document in the users collection.' . PHP_EOL );
	# [END fs_add_data_1]*/

}
add_action("dsbf_add_test","add_data",10);
