<script>

function route(){
$('#trailListModal').modal('show');
}
function path(){

$('#routeModal').modal('show');
}
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
		alert(data);
		$('#trains').html(data);
		//$('#trailListModal').modal('show');
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
	//	alert(data);
		initMap(data);
		//$('#routeModal').modal('show');
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
 //obj[0].city ;
//alert( obj[0].schdep );

//alert( obj[len-1].city );
//alert( obj[len-1].scharr );
//alert( obj[0].lng );
$('#info').html(  "<table><tr><td>Source      :</td><td>"+obj[0].city+"</td><td>arr_time   :</td><td>"+obj[0].schdep+"</td></tr><tr><td>Destination  :</td><td>"+obj[len-1].city+"</td><td>dept_time   :</td><td>"+obj[0].schdep+"</td></tr></table>");
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var directionsService = new google.maps.DirectionsService;
  var map = new google.maps.Map(document.getElementById('googleMap'), {
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

function initialize1() {
        var myOptions = {
          center: new google.maps.LatLng(28.6100, 77.2300),
          zoom: 6,
          //disableDefaultUI: true,
          //disableDoubleClickZoom: true,
          //draggable: false,
          //scrollwheel: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP   
        };
        var map = new google.maps.Map(document.getElementById("googleMap1"),
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
		         
				/*  for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }
				}}*/
				//city data
       // alert(city.short_name + " " + city.long_name)
	   
	   if (results[0]) {
                    var add= results[0].formatted_address ;
                    var  value=add.split(",");

                    c=value.length;
                    country=value[c-1];
                    state=value[c-2];
                    city=value[c-3];
                    alert("city name is: " + city);
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
		

}




google.maps.event.addDomListener(window, 'load', initialize1);

google.maps.event.addDomListener(window, 'load', initialize);

</script>
