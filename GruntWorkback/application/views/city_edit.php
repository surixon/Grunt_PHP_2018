<?php $Result = $this->City_model->get_city();?>

<div class="container-fluid">
        	<div class="col-md-12 form_section">
               <div class="row">
			   <div class="content">
			   <div class="col-md-6">
			   <div class="col-md-6">
	<?php 
    $fattr = array('class' => 'form-signin');
    echo form_open('', $fattr); ?>
    <div class="form-group">
    <label for="usr">CITY NAME:</label>
          <?php echo form_input(array('name'=>'city_name','id'=> 'city_name','value'=>$city_name, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter City Name')); ?>
		  <?php echo form_error('city_name');?>
    </div>
	
    <div class="form-group">
    <label for="pwd">LOCATION NAME:</label>
          <?php echo form_input(array('name'=>'location_name','id'=> 'discounted','value'=>$location_name, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Location Name')); ?>
		  <?php echo form_error('location_name');?>
    </div>
	<div class="form-group">
    <label for="pwd">PIN CODE:</label>
          <?php echo form_input(array('name'=>'pin_code','id'=> 'pin_code','value'=>$pin_code, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Pin Code')); ?>
          <?php echo form_error('pin_code');?>
          <?php echo form_input(array('name'=>'id','id'=> 'id','value'=>$id, 'class'=>'form-control','type'=>'hidden')); ?>
    </div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
    <label for="pwd">COMMISSION%:</label>
          <?php echo form_input(array('name'=>'commission','id'=> 'commission','value'=>$commission, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Commission%')); ?>
		  <?php echo form_error('commission');?>
    </div>
    <div class="form-group">
	<button type="button" class="btn btn-lg btn-primary btn-block" id="updateLocation"  onclick="updateLocation()">UPDATE</button>
	<button type="button" class="btn btn-lg btn-primary btn-block" id="cancelLocation"  onclick="cancelLocation()">CANCEL</button>
    <?php echo form_close(); ?>
   </div>
   </div>
   </div>	   
   </div>
   </div>
   </div>
   </div>
  
