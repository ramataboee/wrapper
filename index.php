<?php
require_once 'APIPro.php';

//Get API request parameters
$results = array();

if( !isset($_POST['functionName']) ) { $results['error'] = 'No function name!'; }

if( !isset($_POST['apiParams']) ) { $results['error'] = 'No function arguments!'; }

if( !isset($results['error']) ) {

        $params = json_decode($_POST['apiParams']);
        switch($_POST['functionName']) {
            case 'get_data':
               if( !is_array($params) || (count($params) < 2) ) {

                   $results['error'] = 'Error in api parameters! '.$params;
               }
               else {
                  $method = $params[0];
                  $url = $params[1];

                  $results['result'] = callAPI($method, $url, false);
               }
               break;
            case 'post_data':
                if( !is_array($params) || (count($params) < 3) ) {

                    $results['error'] = 'Error in api parameters! '.$params;
                }
                else {
                   $method = $params[0];
                   $url = $params[1];
                   $data = $params[2];

                   $results['result'] = callAPI($method, $url, $data);
                }
                break;

            default:
               $results['error'] = 'Not found function '.$_POST['functionName'].'!';
               break;
        }

    }

echo json_encode($results);
