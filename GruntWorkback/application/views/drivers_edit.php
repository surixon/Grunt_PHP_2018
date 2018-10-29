<?php $id = $this->uri->segment(3);
$result = $this->Driver_model->get_driver($id);
//print_r($result); exit;?>

<div class="container-fluid">
  <div class="col-md-12 form_section">   
   <div class="row">
	<div class="content">
	  <div class="col-md-6">
		<div class="col-md-6">
				   
	
    
    <form  action= "<?php echo base_url('Driver/update_driver/')?>" method="post" id="driver_form" name="driver_form"  enctype="multipart/form-data">
     <div class="form-group">
     <label for="usr">LOCATION NAME:</label>
		  <?php echo form_input(array('name'=>'location_name','id'=> 'location_name','value'=>$result[0]['location_id'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter location Name')); ?>
		  <?php echo form_error('location_name');?>
    </div>
	<div class="form-group">
    <label for="usr">DRIVER NAME:</label>
		  <?php echo form_input(array('name'=>'name','id'=> 'name', 'class'=>'form-control','value'=>$result[0]['name'],'type'=>'text','placeholder'=>'Enter Driver Name'));  ?>
		  <?php echo form_error('name');?>
    </div>
    <div class="form-group">
    <label for="pwd">ADDRESS:</label>
		  <?php echo form_input(array('name'=>'address','id'=> 'address','value'=>$result[0]['address'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Address'));  ?>
		  <?php echo form_error('address');?>
    </div>
	<div class="form-group">
    <label for="pwd">COUNTRY:</label>
		  <?php echo form_input(array('name'=>'country','id'=> 'country','value'=>$result[0]['country'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Country'));  ?>
		  <?php echo form_error('country');?>
    </div>
	<div class="form-group">
    <label for="pwd">CITY:</label>
		  <?php echo form_input(array('name'=>'city','id'=> 'city','value'=>$result[0]['city'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter City'));  ?>
		  <?php echo form_error('city');?>
    </div>
	<div class="form-group">
    <label for="pwd">STATE:</label>
		  <?php echo form_input(array('name'=>'state','id'=> 'state','value'=>$result[0]['state'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter State'));  ?>
		  <?php echo form_error('state');?>
    </div>
	<div class="form-group">
    <label for="pwd">ZIP:</label>
		  <?php echo form_input(array('name'=>'zip','id'=> 'zip','value'=>$result[0]['zip'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Zip'));  ?>
		  <?php echo form_error('zip');?>
    </div>
    </div>
	<div class="col-md-6">
	<div class="form-group">
    <label for="usr">TEL:</label>
		  <?php echo form_input(array('name'=>'mobile','id'=> 'mobile','value'=>$result[0]['mobile'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Telephone Number'));  ?>
		  <?php echo form_error('mobile');?>
    </div>
    <div class="form-group">
    <label for="pwd">LICENS # :</label>
		  <?php echo form_input(array('name'=>'driver_license','id'=> 'driver_license','value'=>$result[0]['driver_license'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter License'));  ?>
		  <?php echo form_error('driver_license');?>
    </div>
	<div class="form-group">
    <label for="pwd">EMAIL:</label>
		  <?php echo form_input(array('name'=>'email','id'=> 'email','value'=>$result[0]['email'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Valid Email-Address'));  ?>
		  <?php echo form_error('email');?>
    </div>
	</div>
	</div>
	<div class="col-md-6">
	<div class="col-md-6">
	<div class="form-group">
    <label for="usr">MAKE:</label>
		  <?php echo form_input(array('name'=>'make','id'=> 'make','value'=>$result[0]['make'], 'class'=>'form-control','type'=>'text','placeholder'=>'Make'));  ?>
		  <?php echo form_error('make');?>
    </div>
    <div class="form-group">
    <label for="pwd">MODEL:</label>
		  <?php echo form_input(array('name'=>'model','id'=> 'model','value'=>$result[0]['model'], 'class'=>'form-control','type'=>'text','placeholder'=>'Model'));  ?>
		  <?php echo form_error('model');?>
    </div>
	<div class="form-group">
    <label for="pwd">YEAR:</label>
		  <?php echo form_input(array('name'=>'year','id'=> 'year','value'=>$result[0]['year'], 'class'=>'form-control','type'=>'text','placeholder'=>'Year'));  ?>
		  <?php echo form_error('year');?>
    </div>
	<div class="form-group">
    <label for="pwd">COLOR:</label>
		  <?php echo form_input(array('name'=>'color','id'=> 'color','value'=>$result[0]['color'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Color'));  ?>
		  <?php echo form_error('color');?>
    </div>
	<div class="form-group">
    <label for="pwd">Lic.PLATE:</label>
          <?php echo form_input(array('name'=>'lic_plate','id'=> 'lic_plate','value'=>$result[0]['lic_plate'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter License Plate'));  ?>
          <?php echo form_error('lic_plate');?>
    </div>
    </div>
	<div class="col-md-6">

	<div class="form-group">
    <label for="pwd">DRIVER % :</label>
		  <?php echo form_input(array('name'=>'driver%','id'=> 'driver%','value'=>$result[0]['driver%'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Driver%'));  ?>
		  <?php echo form_error('driver%');?>
    </div>
	<div class="form-group">
    <label for="pwd">COMPANY %:</label>
	      <?php echo form_input(array('name'=>'company%','id'=> 'company%','value'=>$result[0]['company%'], 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Company%'));  ?>
		  <?php echo form_error('company%');?>
    </div>

	<div class="form-group">
    <label for="usr">TEMP PASSWORD:</label>
          <?php echo form_input(array('name'=>'password','id'=> 'password','value'=>$result[0]['password'], 'class'=>'form-control','type'=>'password','placeholder'=>'Enter Temporary Password'));  ?>
          <?php echo form_error('password');?>
    </div> 
    <div class="form-group">
			<input type="hidden" value="<?php echo $result[0]['id']; ?>" id="driver_id" name="driver_id">
		  <input type="submit" class="btn btn-primary btn-block" name="submit" value="Save" >UPDATE
		  <button type="button" class="btn btn-primary btn-block" onclick="window.location='<?php echo site_url("Driver");?>'">back</button>
		
   </div>
   </div>
   
   </form>
   </div>	   
   </div>
   </div>
   </div>
   </div>
