<div class="container-fluid">
  <div class="col-md-12 form_section">
    <div class="row">
      <div class="content">
        <div class="col-md-12">
          <div class="col-md-4">
            <?php 
            $fattr = array('class' => 'form-signin');
            echo form_open('', $fattr); ?>
            <div class="form-group">
              <label for="usr">CITY NAME:</label>
              <?php echo form_input(array('name'=>'location_name','id'=> 'location_name','value'=>$location_name, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Location'));  ?>
					
             </div>
            <div class="form-group">
              <label for="pwd">LOCATION NAME:</label>
              <?php echo form_input(array('name'=>'location_address','id'=> 'location_address','value'=>$location_address, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Address'));  ?> <?php echo form_error('address');?> </div>
            <div class="form-group">
              <label for="pwd">PIN CODE:</label>
              <?php echo form_input(array('name'=>'location_city','id'=> 'location_city','value'=>$location_city, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter City'));  ?> <?php echo form_error('city');?> </div>
          </div>
            <div class="form-group">
              <label for="pwd">COMMISSION:</label>
              <?php echo form_input(array('name'=>'location_state','id'=> 'location_state','value'=>$location_state, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter State'));  ?> <?php echo form_error('state');?> </div>
            </div>
			  <input type="hidden" value="<?php echo $id; ?>" id="location_id" name="id">		
            </div>
            <div class="form-group"> 
				<?php //echo form_submit(array('value'=>'ADD', 'class'=>'btn btn-primary btn-block', 'onclick'=>'addCompany()'));?>  
				<button type="button" class="btn btn-primary btn-block" id="updateComapny"  onclick="updateLocation()">UPDATE</button>
				<button type="button" class="btn btn-primary btn-block" id="cancelComapny"  onclick="cancelLocation()">CANCEL</button>
				<?php echo form_close(); ?>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



  
