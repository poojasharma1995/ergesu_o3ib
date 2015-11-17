<!DOCTYPE html >



  <head>

	<script src="http://maps.googleapis.com/maps/api/js?v=3"></script>
<script>

/*
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
*/








function initialize() {
        var myOptions = {
          center: new google.maps.LatLng(28.6100, 77.2300),
          zoom: 6,
          //disableDefaultUI: true,
          //disableDoubleClickZoom: true,
          //draggable: false,
          //scrollwheel: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP   
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),
            myOptions);
			
			/*var marker = new google.maps.Marker({
              position: new google.maps.LatLng(28.6100, 77.2300),
              map: map,
			  
          });*/
		  
	//marker.setMap(map);
var count=0;
 google.maps.event.addListener(map, 'click', function(event) {
 //alert("hello");
 count++;
 if(count<=2){
var geocoder= new google.maps.Geocoder();
geocoder.geocode({'latLng': event.latLng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
	  
	  //alert(event.latLng.lat());
        if (results[1]) {
         // map.setZoom(11);
		  
         var marker = new google.maps.Marker({
              position: event.latLng,
              map: map,
			  
          });
		  
	marker.setMap(map);
		  var infowindow = new google.maps.InfoWindow();
          infowindow.setContent(results[1].formatted_address);
		         
				  for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }
				}}
				//city data
       // alert(city.short_name + " " + city.long_name)
	   if(count==1){
	   document.getElementById('source').value=city.long_name;
	   }
	   if(count==2){
	   document.getElementById('destination').value = city.long_name;
	   }
	   //document.getElementById('source').val = city.long_name;
		  //console.log(results);
          infowindow.open(map, marker);
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  
  }else{
  alert("Select only two place");
  }//count
  
  
  });
}


google.maps.event.addDomListener(window, 'load', initialize);






</script>
</head>

<body>
 <h1>WELCOME TO INDAIN TRAIN ENQUIRY<h1>
<div id="googleMap" style="width:900px;height:500px;"></div>
</body>
<?php
echo"sa";
if($_POST){
echo"asd";
$source=$_POST["source"];
$res=explode($source," ");

$url = 'http://api.railwayapi.com/name_to_code/station/'.$res[0].'/apikey/pgalz1016/';
$content = file_get_contents($url);
$json = json_decode($content, true);
echo "<pre>";
print_r($json);
echo"</pre>";

}
?>
<form action="index.php" method="post">
<!--<a href="pnrstatus.php">pnrstatus</a>-->
<input type="hidden" id="source" value=""/>
<input type="hidden" id="destination" value=""/>
click on search to get train information
<input type="submit" value="search" />
</form>
  </body>

</html>
