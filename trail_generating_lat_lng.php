<!DOCTYPE html >

<head>
	<script src="http://maps.googleapis.com/maps/api/js?v=3"></script>
<script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 3,
    center: {lat: 30.7333148, lng: 76.7794179},
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });

  var flightPlanCoordinates = [{"lat":30.7333148,"lng":76.7794179},{"lat":30.3781788,"lng":76.7766974},{"lat":29.6856929,"lng":76.9904825
}];
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000', 
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
}
</script>
</head>
<body onload="initMap()">

<div id="map" style="width:1024px;height:500px;"></div>
</body>
</html>
