<!-- Modal -->
<div class="modal fade" id="routeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">TRAIN ROUTE</h4>
      </div>
      <div class="modal-body">
	   <form class="form-inline" id="train_route">
  <div class="form-group">
    <label for="exampleInputName2">Train No</label>
    <input type="text" class="form-control" id="train_no" name="train_no" placeholder="Train No">
  </div>
  
  <button type="submit" class="btn btn-warning">Search Train Route</button>
<div id="info"></div>
  
</form>
<br />
        <div id = "googleMap" style="width: 100%;height: 500px"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal2 -->

<div class="modal fade" id="trailListModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" >
      
<div  id="googleMap1" style="width:100%;height:500px;"></div>
	   <form class="form-inline" id="generate_code">
	   <input type="hidden" id="source" value="" name="source"/>
<input type="hidden" id="destination" value="" name="destination"/>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  <br/>
  <div class="form-group">
    <label for="exampleInputName2">Date</label>
    <input type="text" class="form-control" id="datepicker" placeholder="Date">
  </div>
  <button class="btn btn-default" onclick="initialize()">Reset</button>
  <button type="submit" class="btn btn-warning">Find Trains</button>
</form>
      <div  id="trains">
	  <!-- 
	  
	  train lists
	  -->
	  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
