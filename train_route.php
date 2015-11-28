<?php
$train_no=$_POST["train_no"];

        // create curl resource
        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, "http://api.railwayapi.com/route/train/".$train_no."/apikey/pgalz1016/");
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
		//echo "<pre>";
//print_r($output);
//echo"</pre>";
//echo $output["response_code"];
//echo $output["route"]["no"];
//$array = json_decode($output, true);
$array = json_decode($output);
//echo $array['route']['no'];
 //echo"<pre>";
$json_location;

if(!empty($array)){
foreach ($array->route as $key => $val) {
//echo "------------";
// print_r($val);

 
  $json_location[$key]['city']=$val->fullname;
  $json_location[$key]['schdep']=$val->schdep;
  $json_location[$key]['scharr']=$val->scharr;
  

  

 //   print_r($val);
}
// print_r($json_location);
 echo json_encode($json_location);
 
}



?> 
