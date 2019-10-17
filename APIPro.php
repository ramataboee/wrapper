<?php

function callAPI($method, $url, $data){
   $curl = curl_init();

   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   $certificate = getcwd()."/nitssol1_cert.pem";//;
   $key = getcwd()."/nitssol1_key.pem";

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($curl, CURLOPT_SSLCERT, $certificate);
   curl_setopt($curl, CURLOPT_SSLCERTTYPE, "PEM");
   curl_setopt($curl, CURLOPT_SSLKEY, $key);
   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){
     die('Curl Error : ' . curl_error($curl));
   }
   curl_close($curl);
   return $result;

}

?>
