<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csv_db";
 $source=$_POST["source"];
 
 $des=$_POST["destination"];
$date =$_POST["date"];
$r=explode("/",$date);
 $mm=$r[0];
 $dd=$r[1];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$source="a";
 $sql = "SELECT * FROM tbl_name where station_name like '".trim($source)." %'";
$result = $conn->query($sql);
$scc=0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

	$sc[$scc++]=$row["station_code"];
        //echo "station name " . $row["station_name"]. "| STATION CODE " . $row["station_code"]. "<br>";

    }
} else {
   // echo "0 results";
}
 $sql1 = "SELECT * FROM tbl_name where station_name like '".trim($des)." %'";
$result1 = $conn->query($sql1);
$dcc=0;
if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
	//echo"<pre>";
	//print_r($row);
	//echo "CODE";
	 $dc[$dcc++]=$row["station_code"];
        //echo "station name " . $row["station_name"]. "| STATION CODE " . $row["station_code"]. "<br>";
	//echo"</pre>";
    }
} else {
   echo "No Station In Between";
   die;
}



for($i=0;$i< sizeof($sc) ;$i++){

for($j=0;$j< sizeof($dc) ;$j++){

//$row1 = $result1->fetch_assoc();
 $s=$sc[$i];
 $d=$dc[$j];
 $url=  "http://api.railwayapi.com/between/source/".$s."/dest/".$d."/date/".$dd."-".$mm."/apikey/pgalz1016/";

$content = file_get_contents($url);

$json = json_decode($content, true);

 if($j==0){
?>

<table class="table table-hover">   <tr>  <th>Train No</th> <th>Train Name</th> <th>Arival Time</th><th>Departure Time</th>
 </tr>  <tbody> 
 
 <?php 
 
 }
 if(!empty($json)){
foreach ($json['train'] as $key => $val) {

?>
 <tr> <td scope="row"><?php echo $val['number'];?></td> <td><?php echo $val['name'];?></td>
 <td><?php echo $val['dest_arrival_time'];?></td> <td><?php echo $val['src_departure_time'];?></td> </tr>
<?php }
} 


?>


<?php

}
}


$conn->close();

?>
</tbody> </table> 
