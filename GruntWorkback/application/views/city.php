<?php $Result = $this->City_model->get_city();?>
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
          <?php echo form_input(array('name'=>'city_name','id'=> 'city_name', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter City Name')); ?>
		  <?php echo form_error('city_name');?>
    </div>
    
    <div class="form-group">
    <label for="pwd">LOCATION NAME:</label>
          <?php echo form_input(array('name'=>'location_name','id'=> 'location_name', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Location Name')); ?>
		  <?php echo form_error('location_name');?>
    </div>
	
    <div class="form-group">
    <label for="pwd">PIN CODE:</label>
          <?php echo form_input(array('name'=>'pin_code','id'=> 'pin_code', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Pin Code')); ?>
		  <?php echo form_error('pin_code');?>
    </div>
	<div class="form-group">
    <label for="pwd">COMMISSION%:</label>
          <?php echo form_input(array('name'=>'commission','id'=> 'commission', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Commission%')); ?>
          <?php echo form_error('commission');?>
    </div>
    <div class="form-group">
	<button type="button" class="btn btn-lg btn-primary btn-block" id="addCity"  onclick="addLocation()">ADD</button>
    <?php echo form_close(); ?>
   </div>
   </div>
   </div>	   
   </div>
   </div>
   </div>
   </div>
   <div class="row">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
										<th>SR NO.</th>
										<th>CITY NAME</th>
										<th>LOCATION NAME</th>
                                    	<th>PIN CODE</th>
                                    	<th>COMMISSION%</th>
										<th>ACTION</th>
                                    </thead>
                                    <tbody>
                                        <tr>
											<?php foreach($Result as $city): ?>
											
											<td><?php echo $city['id']; ?></td>
											<td><?php echo $city['city_name']; ?></td>
											<td><?php echo $city['location_name']; ?></td>
                                        	<td><?php echo $city['pin_code']; ?></td>
                                        	<td><?php echo $city['commission']; ?></td>
                                        											
											<td>
											<a href="<?php base_url();?>City/edit_location?id=<?php echo $city['id']; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a onclick="locationDelete(<?php echo $city['id']; ?>)" ><i class="fa fa-scissors" aria-hidden="true"></i></a>
											</td>
                                        </tr>
                                       
                                        <?php endforeach; ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

            </div></div>
        </div>
        </div>
