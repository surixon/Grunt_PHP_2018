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
              <label for="usr">LOCATION NAME:</label>
              <?php echo form_input(array('name'=>'location_name','id'=> 'location_name','value'=>$location_name, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Location'));  ?>
					
             </div>
            <div class="form-group">
              <label for="pwd">ADDRESS:</label>
              <?php echo form_input(array('name'=>'location_address','id'=> 'location_address','value'=>$location_address, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Address'));  ?> <?php echo form_error('address');?> </div>
            <div class="form-group">
              <label for="pwd">CITY:</label>
              <?php echo form_input(array('name'=>'location_city','id'=> 'location_city','value'=>$location_city, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter City'));  ?> <?php echo form_error('city');?> </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pwd">STATE:</label>
              <?php echo form_input(array('name'=>'location_state','id'=> 'location_state','value'=>$location_state, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter State'));  ?> <?php echo form_error('state');?> </div>
            <div class="form-group">
              <label for="pwd">ZIP:</label>
              <?php echo form_input(array('name'=>'location_zip','id'=> 'location_zip','value'=>$location_zip, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Zip'));  ?> <?php echo form_error('zip');?> </div>
            <div class="form-group">
              <label for="usr">TEL:</label>
              <?php echo form_input(array('name'=>'location_telephone','id'=> 'location_telephone','value'=>$location_telephone, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Telephone Number'));  ?> <?php echo form_error('telephone');?> </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pwd">MANAGER NAME:</label>
              <?php echo form_input(array('name'=>'manager_name','id'=> 'manager_name','value'=>$manager_name, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Manager Name'));  ?> <?php echo form_error('manager_name');?> </div>
            <div class="form-group">
              <label for="pwd">EMAIL:</label>
              <?php echo form_input(array('name'=>'location_email','id'=> 'location_email','value'=>$location_email, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Valid Email Address'));  ?> <?php echo form_error('email');?> </div>
            <div class="form-group">
              <label for="pwd">Cab Alias:</label>
              <?php echo form_input(array('name'=>'location_cab_alias','id'=> 'location_cab_alias','value'=>$location_cab_alias, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Cab-Alias'));  ?> <?php echo form_error('cab_alias');?> 
			  <input type="hidden" value="<?php echo $location_id; ?>" id="location_id" name="location_id">		
            </div>
            <div class="form-group"> 
				<?php //echo form_submit(array('value'=>'ADD', 'class'=>'btn btn-primary btn-block', 'onclick'=>'addCompany()'));?>  
				<button type="button" class="btn btn-primary btn-block" id="updateComapny"  onclick="updateCompany()">UPDATE</button>
				<button type="button" class="btn btn-primary btn-block" id="cancelComapny"  onclick="cancelUpdateCompany()">CANCEL</button>
				<?php echo form_close(); ?>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">

