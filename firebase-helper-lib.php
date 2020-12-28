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

$project_Id = 'utb-quotes-system';

//add_data(
//	$project_Id,
//	'darren.bailey@dsbaileyfreelancer.com.au',
//	'Darren2',
//	'Bailey2',
//	'Manning Golf Club2',
//	'2020/11/29'
//);


//function add_data(
//	$project_Id,
//	$email,
//	$first_name,
//	$last_name,
//	$sporting_club,
//	$submission_date
//) {
//	// Create the Cloud Firestore client
//	$db = new FirestoreClient(
//		$project_Id,
//		'AIzaSyDmA0H44nEWnod8kSDhg1STWwwJsDkwYfE', [
//			'database' => '(default)'
//		]
//	 );
////	# [START fs_add_data_1]
//	$docRef = $db->collection( 'customers' );
//	if($docRef->add( [
//		'email'          => $email,
//		'firstName'      => $first_name,
//		'lastName'       => $last_name,
//		'sportingClub'   => $sporting_club,
//		'submissionDate' => $submission_date
//	] )) {
//		return '{"success": true}';
//	} else {
//		return '{"success": false}';
//	}
//	/*printf( 'Added data to the lovelace document in the users collection.' . PHP_EOL );
//	# [END fs_add_data_1]*/
//
//}
function add_data(
	$project_Id,
	$email,
	$first_name,
	$last_name,
	$sporting_club,
	$submission_date
) {
	$firestore_data = [
		"email"      => [ "stringValue" => $email ],
		"firstName"         => [ "integerValue" => $first_name ],
		"lastName" => [ "integerValue" => $last_name ],
		"sportingClub"    => [ "integerValue" => $sporting_club ],
		"submissionDate"    => [ "integerValue" => $submission_date ]
	];
	$data           = [ "fields" => (object) $firestore_data ];

//    Possible *value options are:
//    stringValue
//    doubleValue
//    integerValue
//    booleanValue
//    arrayValue
//    bytesValue
//    geoPointValue
//    mapValue
//    nullValue
//    referenceValue
//    timestampValue

	$json = json_encode( $data );
	// Enter your firestore unique key: below is a sample
    $firestore_key = "AIzaSyDmA0H44nEWnod8kSDhg1STWwwJsDkwYfE";
    // #Provide your firestore project ID Here

    $object_unique_id = random_int( 1, 300 );

    $url = "https://firestore.googleapis.com/v1/projects/{$project_Id}/databases/(default)/documents/customers/{$object_unique_id}";

    $curl = curl_init();

    curl_setopt_array( $curl, array(
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_CUSTOMREQUEST  => 'POST',
	    CURLOPT_HTTPHEADER     => array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen( $json ),
		    'X-HTTP-Method-Override: PATCH'
	    ),
	    CURLOPT_URL            => $url . '?key=' . $firestore_key,
	    CURLOPT_USERAGENT      => 'cURL',
	    CURLOPT_POSTFIELDS     => $json
    ) );

    $response = curl_exec( $curl );

    curl_close( $curl );

    // Show result
    echo $response . "\n";
    }
