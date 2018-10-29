<?php $Company = $this->Company_model->get_details();?>

<div class="container-fluid">
  <div class="col-md-12 form_section">
    <div class="row">
      <div class="content">
        <div class="col-md-12">
          <div class="col-md-4">
            <?php echo form_open_multipart('Customer/company'); ?>
            <div class="form-group">
              <label for="usr">CUSTOMAR NAME:</label>
              <?php echo form_input(array('name'=>'name','id'=> 'name', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter CUSTOMAR NAME'));  ?>
					
             </div>
            <div class="form-group">
              <label for="pwd">ADDRESS:</label>
              <?php echo form_input(array('name'=>'home_address','id'=> 'home_address', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Home Address'));  ?> <?php echo form_error('address');?> </div>
            <div class="form-group">
              <label for="pwd">CITY:</label>
              <?php echo form_input(array('name'=>'city','id'=> 'city', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter City'));  ?> <?php echo form_error('city');?> </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pwd">STATE:</label>
              <?php echo form_input(array('name'=>'state','id'=> 'state', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter State'));  ?> <?php echo form_error('state');?> </div>
            <div class="form-group">
              <label for="pwd">Device type:</label>
              <?php echo form_input(array('name'=>'device_type','id'=> 'device_type', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter device'));  ?> <?php echo form_error('device_type');?> </div>
            <div class="form-group">
              <label for="usr">TEL:</label>
              <?php echo form_input(array('name'=>'telephone','id'=> 'telephone', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Telephone Number'));  ?> <?php echo form_error('telephone');?> </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="pwd">MANAGER NAME:</label>
              <?php echo form_input(array('name'=>'manager_name','id'=> 'manager_name', 'class'=>'form-control','type'=>'file','placeholder'=>'Enter Manager Name'));  ?> <?php echo form_error('manager_name');?> </div>
            <div class="form-group">
              <label for="pwd">EMAIL:</label>
              <?php echo form_input(array('name'=>'email','id'=> 'email', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Valid Email Address'));  ?> <?php echo form_error('email');?> </div>
            <div class="form-group">
              <label for="pwd">Work Location:</label>
              <?php echo form_input(array('name'=>'work_location','id'=> 'work_location', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter work location'));  ?> <?php echo form_error('cab_alias');?> 
			  <input type="hidden" value="<?php echo $_SESSION['company_id'] ?>" id="company_id" name="company_id">		

            </div>
            <div class="form-group"> 
				<?php //echo form_submit(array('value'=>'ADD', 'class'=>'btn btn-primary btn-block', 'onclick'=>'addCompany()'));?> 
				<button type="submit" class="btn btn-primary btn-block" id="addComapny">ADD</button>
				<?php echo form_close(); ?> 
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid form_section">
	  <div class="col-md-12">
			<div class="form-group">
				<div class="col-md-6">
					<label for="usr">Network Jobs to Other Companies</label>
					<input type="text" class="form-control" placeholder="Minutes" name="network_jobs_to_other_companies" id="network_jobs_to_other_companies" value="<?php echo (!empty($network_detail['network_jobs_to_other_companies']) && isset($network_detail['network_jobs_to_other_companies']))?$network_detail['network_jobs_to_other_companies']:''; ?>">
				</div>
			</div>
	  </div>
	  <br/>
	  <br/>
	  <br/>
	  <div class="col-lg-6 col-sm-6">
		  <?php if(isset($network_detail['network_jobs_to_other_companies']) && empty($network_detail['network_jobs_to_other_companies'])){ ?>
			<input value="ADD MINUTES" class="btn btn-primary btn-block" type="button" onclick="add_minutes(1)">
		  <?php }else{ ?>
			  <input value="UPDATE MINUTES" class="btn btn-primary btn-block" type="button" onclick="add_minutes(2)">
		  <?php } ?>
	   </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="header">
          <h4 class="title">Summary Table</h4>
          <p class="category"></p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped">
            <thead>
              <th>LOCATION NAME</th>
              <th>ADDRESS</th>
              <th>CITY</th>
              <th>STATE</th>
              <th>ZIP</th>
              <th>TEL</th>
              <th>MANAGER NAME</th>
              <th>EMAIL</th>
              <th>CAB ALIAS</th>
              <th>DATE CREATED</th>
              
<!--
              <th># OF DRIVERS</th>
-->
              <th>ACTION</th>
                </thead>
            <tbody>
              <tr>
                <?php foreach($Company as $comp): ?>
                <td><?php echo $comp['location_name']; ?></td>
                <td><?php echo $comp['location_address']; ?></td>
                <td><?php echo $comp['location_city']; ?></td>
                <td><?php echo $comp['location_state']; ?></td>
                <td><?php echo $comp['location_zip']; ?></td>
                <td><?php echo $comp['location_telephone']; ?></td>
                <td><?php echo $comp['manager_name']; ?></td>
                <td><?php echo $comp['location_email']; ?></td>
                <td><?php echo $comp['location_cab_alias']; ?></td>
                <td><?php echo $comp['date_created']; ?></td>
<!--
                <td>5</td>
-->
                <td><a href="<?php base_url();?>Company/location_edit?location_id=<?php echo $comp['location_id']; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a> <a onclick="locationDelete(<?php echo $comp['location_id']; ?>)" data-confirm="Are you sure to delete this item?"><i class="fa fa-scissors" aria-hidden="true"></i></a>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


