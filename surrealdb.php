<?php

/*
Start SurrealDB server in the terminal
surreal start --log debug --user root --pass root memory
Start SurrealDB server - save data in a folder called "data"
surreal start --log debug --user admin --pass password file:database.db
SurrealDB client
surreal sql --conn http://localhost:8000 --user admin --pass password --ns phpexam --db phpexam --pretty
*/

function surrealdb($query, $lets = [], $host = 'http://127.0.0.1', $port = 8000)
{
  try {
    // Create secure lets
    $variables = '';
    foreach ($lets as $key => $value) {
      $variables .= 'LET $' . $key . '="' . $value . '";';
    }
    // echo $variables;
    // replace variables with place holders
    $query = str_replace(':', '$', $query);
    $query = $variables . $query;

    $headers = [
      'Accept: application/json',
      'ns: phpexam',
      'db: phpexam'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/sql");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Do not output the response automatically on exec
    curl_setopt($ch, CURLOPT_TIMEOUT, 1); //timeout in seconds
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'admin:password');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    if (!$response) {
      throw new Exception('Cannot connect to SurrealDB');
    }
    curl_close($ch);
    // $http_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE) ?? "500"; // MAC maybe comment this out
    // if ($http_code != 200) {
    //   throw new Exception($response);
    // } // MAC maybe comment this out

    return $response;
    exit();
  } catch (Exception $ex) {
    throw new Exception($ex->getMessage());
  }
}
