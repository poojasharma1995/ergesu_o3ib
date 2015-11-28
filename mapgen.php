<!DOCTYPE html >

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <link href="css/bootstrap.theme.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script src="js/bootstrap.min.js"></script>

   <!-- <script src="http://maps.googleapis.com/maps/api/js?v=3"></script>-->
  
<script>

$( document ).ready(function() {
    console.log( "ready!" );



$( "#generate_code" ).submit(function( event ) {
 // alert( "Handler for .submit() called." );
  event.preventDefault();
  var formData = {date:$('#datepicker').val(),source:$('#source').val(),destination:$('#destination').val()};
		$.ajax({
		url: "staioncodessearcher.php",
		type: "POST",
		data : formData
		//context: document.body
		}).done(function(data) {
		//$( this ).addClass( "done" );
		//alert(data);
		$('#trains').html(data);
		$('#trailListModal').modal('show');
		});
});
	
	
$( "#train_route" ).submit(function( event ) {
 // alert( "Handler for .submit() called." );
  event.preventDefault();
  var formData = {train_no:$('#train_no').val()};
		$.ajax({
		url: "train_route.php",
		type: "POST",
		data : formData
		//context: document.body
		}).done(function(data) {
		//$( this ).addClass( "done" );
		alert(data);
		initMap(data);
		$('#routeModal').modal('show');
		});
});
	

	
function initMap(data) {
var obj = jQuery.parseJSON(data);
var arr = [], len;

for(key in obj) {
    arr.push(key);
}

len = arr.length;

console.log(len) //2
alert( obj[0].city );
alert( obj[len-1].city );
//alert( obj[0].lng );

  var directionsDisplay = new google.maps.DirectionsRenderer;
  var directionsService = new google.maps.DirectionsService;
  var map = new google.maps.Map(document.getElementById('map_canvas'), {
    zoom: 7,
    center: {lat: 28.6100, lng:  77.2300}
  });
  directionsDisplay.setMap(map);
 /* directionsDisplay.setPanel(document.getElementById('right-panel'));

  var control = document.getElementById('floating-panel');
  control.style.display = 'block';
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);*/
  var start = obj[0].city;
  var end = obj[len-1].city;
  directionsService.route({
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });


}



});

function initialize() {
        var myOptions = {
          center: new google.maps.LatLng(28.6100, 77.2300),
          zoom: 6,
          
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
	
	
	   if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    c=value.length;
                    country=value[c-1];
                    state=value[c-2];
                    city=value[c-3];
                    //alert("city name is: " + city);
                }
                else  {
                    alert("address not found");
                }
	   
	   
	   
	   
	   if(count==1){
	   document.getElementById('source').value=city;
	   }
	   if(count==2){
	   document.getElementById('destination').value=city;
	   }
	   //document.getElementById('source').val = city.long_name;
		  console.log(results[1]);
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
 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" style="color:white;" href="#">Railway Enquiries</br><br>SEARCH TRAIN BETWEEN </a>
        </div>
           
        
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
	  </br>
	  </br>

<div id="googleMap" style="width:1024px;height:500px;"></div>


<form action="staioncodessearcher.php" method="post" id="generate_code">
<input type="hidden" id="source" value="" name="source"/>
<input type="hidden" id="destination" value="" name="destination"/>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>


DATE:<input type="text" id="datepicker" name="date">
<a class="btn btn-default" href="mapgen.php">Reset</a>
<input type="submit" class="btn btn-warning" value="Find Trains" />
</form>



</div>




 




<!-- Button trigger modal 
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="routeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">TRAIN LIST</h4>
      </div>
      <div class="modal-body">
        <div id = "map_canvas" style="width: 100%;height: 500px"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<?php include "train_list.php"; ?>
</body>

</html>
