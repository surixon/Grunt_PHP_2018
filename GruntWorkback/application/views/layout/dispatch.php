<section class="content dispatch_section"> 
  <!-- Main row -->
  <div class="row"> 
    <!-- left column -->
    <div class="col-md-4 first_form_pannel"> 
      <!-- general form elements -->
      <div class="box box-primary"> 
        
        <!-- /.box-header --> 
        <!-- form start -->
        
        <div class="box-body">
          <?php 
			$fattr = array('class' => 'form-signin');
			echo form_open('', $fattr); 
          ?>
          
			<div class="form-group pickup_destination">
				<label for="pwd">From (Pick UP)</label>
				<?php// echo ;?>
				<?php echo form_input(array('name'=>'pickup_address','value'=>(isset($form_details['pickup_address']) && !empty($form_details['pickup_address']))?$form_details['pickup_address']:'','id'=> 'pickup_address', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Pickup'));  ?> <?php echo form_error('pickup_address');?> 
			</div>
			<div class="form-group pickup_destination">
				<label for="pwd">To (Destination)</label>
				<?php echo form_input(array('name'=>'destination','value'=>(isset($form_details['destination']) && !empty($form_details['destination']))?$form_details['destination']:'','id'=> 'destination', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Destination'));  ?> <?php echo form_error('destination');?> 
				<input type="hidden" name="distance" id="distance" value="">
				<input type="hidden" name="duration" id="duration" value="">
			</div>
			</br>
			<div class="radio button_radio" onclick="change_my_driver()"> 
				<?php echo form_radio(array('name'=>'driver_type','id'=> 'driver_type','value'=>'1','type'=>'radio','checked'=>'checked'));  ?>
				<label for="radio1"><span><span></span></span>My Drivers</label>
				<?php echo form_error('driver_type');?> 
            </div>

			<div class="radio button_radio" onclick="change_network_driver()"> 
				<?php echo form_radio(array('name'=>'driver_type','id'=> 'driver_type','value'=>'2','type'=>'radio')); ?>
				<label for="radio1"><span><span></span></span>Networked Drivers</label>
				<?php echo form_error('driver_type');?> </div>
			</div>
			<!-- /.box-body -->
			<div class="col-md-12 box-body">
				<div class="form-group"> <?php //echo form_label('Select Vehicle','select_vehicle',$attributes=array());?>
				<?php 
							 $options = array(
							 ''=>'Choose Vehicle',
							 '0'=>'Any',
							 '1'=>'Regular',
							 '2'=>'Deluxe'
							 );
					echo form_dropdown('select_vehicle',$options,set_value('select_vehicle'),array('class'=>'form-control','id'=>'select_vehicle','name'=>'select_vehicle'));?> 
					<?php echo form_error('select_vehicle');?>
					<input type="hidden" value="" name="latitude" id="latitude"/>
					<input type="hidden" value="" name="longitude"  id="longitude"/>
				</div>
		    </div>
			<div class="box-footer">
				  
				  <button type="button" class="btn btn-info active button" id="getQuote"  onclick="getQuotes()">Get Quote</button>
				  <button type="button" class="btn btn-primary button" onclick="clear_form()" id="clear_all">Clear</button>
			</div> 
			<?php echo form_close(); ?>
		</div>
    </div>
    <!--/.col (left) --> 
    <!-- right column -->
    <div class="col-md-8 second_form_pannel"> 
      <!-- Horizontal Form -->
      <div class="box box-info"> 
        <!-- form start -->
        
        <div class="form-horizontals">
          <div class="second_form_fields">
            <div class="form-group">
				<div class="col-sm-4">
			<?php
				$fattr = array('class' => 'form-signin');
				echo form_open('', $fattr);
				echo form_input(array('name'=>'customer_name','id'=> 'customer_name', 'class'=>'form-control form-group','type'=>'text','placeholder'=>'Enter Customer Name'));
                echo form_error('customer_name');
                  
                echo form_input(array('name'=>'customer_telephone','id'=> 'customer_telephone', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Mobile Number'));
                echo form_error('customer_telephone');
              ?>
                  <input type="hidden" name="lati" id="lati" value="">
				<input type="hidden" name="longi" id="longi" value="">
              <div class="radio"  onclick="change_assign_driver(1)"> 
				  <?php echo form_radio(array('name'=>'assign_driver','id'=> 'assign_driver','value'=>'1','checked'=>'checked'));  ?>
                  <label for="radio1"><span><span></span></span> Manually Assign Driver</label>
                  <?php echo form_error('assign_driver');?> 
              </div>
              <div class="form-group"> 
				  <select name="driver_id" id="driver_id">
					<option value="">Select Driver</option>
					<?php
						foreach($driver_result as $dr){
							echo "<option value=".$dr['id'].">".$dr['name']."</option>";
						}
					?>
				  </select>
			  </div>
		      <div class="radio"   onclick="change_assign_driver(2)"> 
				  <?php echo form_radio(array('name'=>'assign_driver','id'=> 'assign_driver','value'=>'2'));  ?>
                   <label for="radio1"><span><span></span></span> Automatically Assign Driver</label>
                  <?php echo form_error('assign_driver');?> 
             </div>
             
          </div>
       
            <div class="col-sm-4 schedule_fields">
              <div class="schedule_fields">
                <div class="radio" onclick="schedule_type(1)"> 
					
				  <?php echo form_radio(array('name'=>'schedule_type','id'=> 'schedule_type','value'=>'1','type'=>'radio','checked'=>'checked' ));  ?>
                   <label for="radio1"><span><span></span></span>Schedule Now</label>
                  <?php echo form_error('schedule_now');?> 
                  </div>
                  
                <div class="radio form-group" onclick="schedule_type(2)"> 
				  <?php echo form_radio(array('name'=>'schedule_type','id'=> 'schedule_type','value'=>'2','type'=>'radio'));  ?>
				  
                  <label for="radio1"><span><span></span></span>Schedule Later</label>
                  <?php echo form_error('schedule_later');?>

                  </div>
                  
                <div class="form-group time_date">
                  <div class="input-group date">
                    <div class="input-group-addon"> <i class="fa fa-calendar"></i> 
                    </div>
                    <input class="form-control pull-right" id="datepicker" type="text" disabled>
                  </div>
                  <!-- /.input group -->
                  <div class="input-group bootstrap-timepicker">
					<input id="timepicker1" type="text" class="form-control pull-right timepicker" disabled>
					<span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
				</div>
              </div>
            </div>
            </div>
           
            <div class="col-sm-4"> <?php echo form_input(array('name'=>'flat_rate','id'=> 'flat_rate', 'class'=>'form-control form-group','type'=>'text','placeholder'=>'Flat Rate'));  ?> <?php echo form_error('flat_rate');?> <?php echo form_label('Payment Method','payment_method',$attributes=array());?>
              <?php 
                         $options = array(
                         ''=>'Payment Method',
                         '1'=>'Cash',
                         '2'=>'Credit Card',
                         '3'=>'Corporate Account'
                         );
                      ?>
                <?php echo form_dropdown('payment_method',$options,set_value('payment_method'),array('class'=>'form-control','id'=>'payment_method','name'=>'payment_method'));?>
              <div class="box-footer"> 
			    <button type="button" class="btn btn-primary save_button" onclick="order_form()" id="order_btn" disabled="disabled">Order</button>
                <?php echo form_close(); ?> 
             </div>
            </div>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
    <!--/.col (right) --> 
  </div>
	</div>
  <!-- /.row (main row) -->
	<div id="trip_popup"  style="<?php echo (isset($order_id) && !empty($order_id))?'display:block':'display:none'; ?>">
      <div id="content" >
         <div class="container-fluid">
			 
            <div class="col-md-12 form_section get_quote_section">
				
  		       <h3 style="text-align:center">Drivers Available</h3>
				<!--Col-12 Start-->
					<div class="col-lg-12 col-sm-12">
						<div class="col-lg-3 col-sm-3">
							<div id="trip_details">
								<p id="trip_distance"> </p>
								<p  id="trip_duration"></p>
								<p id="est_to_trip"></p>
								<p id="total_est"></p>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6">
							<div class="content">
					   
							<div class="col-lg-12 col-sm-12">
							  <div class="panel panel-default"> 
								<table class="table"> 
									<thead> 
										
										<tr> 
											<th>Driver Name</th> 
											<th>Status</th> 
											<th>Est Time to pickup</th> 
										</tr> 
									  </thead> 
									  <tbody id="driver_list">
										   
										
										</tbody> 
									</table> 
								</div>
						   </div>
							
						
					</div>
						</div>
						<div class="col-lg-3 col-sm-3 note">
							  <p>NOTE:</p>
								  <p>Be Transparent, notify customers should convenience fees apply in fares.</p>
								  <p>Should the estimeted time for pickup exceed 18 minutes you may want to consider passing the job over to another company on our network.</p>
							 
						  </div>
					</div>
				<!--Col-12 End -->
			</div>
		</div>
	  </div>	 
    </div> 
</section>
<!-- /.content -->
<div class="content">
  <ul class="nav nav-tabs ">
    <li class="active"><a data-toggle="tab" href="#home">MAP</a></li>
    <li><a data-toggle="tab" href="#menu1">ORDERS</a></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active"> </br>
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card card-map">
            <div class="header">
              <h4 class="title">Google Maps</h4>
            </div>
            <div class="map">
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="menu1" class="tab-pane fade"> </br>
      <div class="container-fluid">
        <div class="row-fluid">
          <div class="orders_dispatch">
            <div class="col-lg-2 col-sm-2">
              <div class="radios">
                <input id="radio1" type="radio" name="radio" value="1" checked="checked">
                <label for="radio1"><span><span></span></span>This Week</label>
              </div>
              <div class="radios">
                <input id="radio2" type="radio" name="radio" value="2">
                <label for="radio2"><span><span></span></span>By Week</label>
              </div>
              <div class="radios">
                <input id="radio3" type="radio" name="radio" value="3">
                <label for="radio3"><span><span></span></span>This Month</label>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <label class="col-lg-1 col-sm-1">By Date</label>
              <div class="col-lg-4 col-sm-4">
                <input class="form-control"  type="text" id="date" >
              </div>
              <label class="col-lg-1 col-sm-1">To </label>
              <div class="col-lg-4 col-sm-4">
                <input class="form-control" type="text" id="dp">
              </div>
            </div>
            <div class="col-lg-4 col-sm-4">
              <button type="button" class="btn btn-primary">Email Details to All Drivers on list </button>
            </div>
          </div>
        </div>
		<table id="table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Driver</th>
					<th>Order Type</th>
					<th>Order Date</th>
					<th>Driver Status</th>
					<th>Customer</th>
					<th>Cust. Tel</th>
					<th>Pickup</th>
<!--
					<th>ETA to pickup</th>
-->
					<th>Dest.</th>
<!--
					<th>ETA to Dest.</th>
-->
					<th>Payment Method</th>
<!--
					<th>Action</th>
-->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
  </div>
</div>
