<!DOCTYPE html >
<head>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <link href="css/bootstrap.theme.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script src="js/bootstrap.min.js"></script>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
   
	<!--<script src="http://maps.google.com/maps/api/js?sensor=false"></script>-->

<!--<img src="back.jpg" class="img-rounded">-->
<body>


    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" style="color:white;" href="#">Railway Enquiries</a>
        </div>
           
        
        </div><!--/.nav-collapse -->
      </div>
    </nav>
 <br/> 
  <br/> 
   <br/> 
    <br/> 
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
         <br/>  
<div class="row">
<!-- onclick="route()" -->
<a href="mapgen.php" ><div class="col-md-5" style="border: 5px solid white; height:254px; cursor: pointer;"  >
	<span class="label label-default">Search trains between places</span></h1>              
	<img src="img/logo.png"  class=" img-responsive img-circle" alt="Search trains between places." width="300" height="200"></div>
</a>
  <div class="col-md-5 col-md-offset-2" style="border: 5px solid white; height:254px; cursor: pointer;" onclick="path()">
     <span class="label label-default">Searce Routes</span>
     <img src="img/ic.png" class=" img-responsive img-circle" alt="Route" width="300" height="200" style="height: 200px; width: 200px;" /> 
</div>
</div> 
      </div>


	  
	  
    </div> <!-- /container -->

<?php 
include "function.php";
include "modal.php";

 ?>


</body>
</html>
</html>
