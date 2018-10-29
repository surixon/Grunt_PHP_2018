
<?php $Reports = $this->Report_model->get_corporation_name();?>
    <?php $Result = $this->Report_model->get_details();?>
       <?php $Order = $this->Report_model->order_details();?>

  

     
               <div class="container-fluid">
               		<div class="col-md-12 reports_pannel">
                <div class="row">
              <div class="col-lg-6 col-sm-6">
			   
         <div class="col-lg-4 col-sm-4">
             <div class="row"> 
			 <a class="succes_button btn btn-large btn-info corp_link" data-toggle="tab" href="#home" id="corp"> Corp Accounts</a>
	    </div>
			</div>
               
               
		<div class="col-lg-4 col-sm-4">
   			<a class="succes_button btn btn-large btn-info all_job_link" data-toggle="tab" href="#menu2"  id="all_jobs">All Jobs Report</a>
		</div>
						
				<div class="col-lg-6 col-sm-6">
                	<div class="row" >
						<h4 class="show_title">Show</h4>
                        <div class="radios">
							<input id="radio1" type="radio" name="radio" value="1" checked="checked"><label for="radio1"><span><span></span></span>Weekly</label>
						  </div>
						  <div class="radios"> 
							<input id="radio2" type="radio" name="radio" value="2"><label for="radio2"><span><span></span></span>By Week</label>
						  </div>
						  <div class="radios"> 
							<input id="radio3" type="radio" name="radio" value="3"><label for="radio3"><span><span></span></span>Monthly</label>
						  </div>
                        </div>

				
  
				</div>
			  </div>
			  

                    <div class="col-lg-6 col-sm-12">
					<div class="col-lg-6 col-sm-6">
                    
		 
     		 <span class="custom-dropdown">
    		<select>
				<?php foreach($Reports as $r) { ?>
                 
                <option><a href="#"><?php echo $r; ?></a></option>
              <?php } ?>
    		</select> 
    		</span>
  
  
  
    <?php echo form_input(array('name'=>'name','id'=> 'usr', 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Driver Name'));  ?>
      <?php echo form_error('name');?>
					</div>
					
                        <div class="col-lg-6 col-sm-6">
   <span class="custom-dropdown">
    
    <select>
				<?php //foreach($Reports as $r) { ?>
                 <option><a href="#">Payment</a></option>
                <option><a href="#">Paid</a></option>
                <option><a href="#">No</a></option>
              <?php //} ?>
    		</select>
  </span>
  
  </br>
  
  </div>
  <div class="col-lg-6 col-sm-6">
				By Date: 
				<input type="text" name="selected_date" placeholder="By Date" id="datepicker"/>
				
				To: 
				<input type="text" name="selected_date" placeholder="To Date" id="dp"/>
				</div>
  </div>

                </div>
			
				
				
				
				 
				</div>
				
				 

				<div class="content">
				<ul class="nav nav-tabs hidden">
    <li class="active"><a data-toggle="tab" href="#home">Crop Acc Summary</a></li>
    <li><a data-toggle="tab" href="#menu1">Crop Acc Details List</a></li>
    <li><a data-toggle="tab" href="#menu2">ALL Jobs Log Report</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3 class="show_title">Crop Acc Summary</h3>				 <a class="email_button btn btn-large btn-info" data-toggle="tab" href="#menu1">Email Details Bill to All Corporations on list</a></br>
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
                                        <th>Corp Name</th>
                                    	<th>#of Orders</th>
                                    	<th>Order Period Start Date</th>
                                    	<th>Order Period End Date</th>
                                    	<th>Amount Due</th>
										<th>Driver Payment Status</th>
										<th>Payment Date</th>
										<th>ACTION</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<?php foreach($Order as $order): ?>
						<?php foreach($Result as $report): ?>
                                        	<td><?php echo $report['corporation_name']; ?></td>
                                        	<td><?php echo $order['id']; ?></td>
                                        	<td><?php echo $order['start_date']; ?></td>
                                        	<td><?php echo $order['end_date']; ?></td>
                                        	<td><?php echo $order['start_date']; ?></td>
                                        	<td><?php echo $order['end_date']; ?></td>
						<td><?php echo $order['id']; ?></td>

						<td>
						<a href="<?php base_url(); ?>edit?id=<?php echo $order['id']; ?>" >Edit</a>
                                            </td>
                                        </tr>
                                       <?php endforeach; ?>
                                       <?php endforeach; ?>
										
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
	 
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3 class="show_title">Crop Acc Details List</h3>
         <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Crop Acc Details List Table</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Corp Name</th>
										<th>Customer</th>
										<th>Order ID</th>
                                    	<th>Order Date</th>
                                    	<th>Pickup</th>
										<th>Destination</th>
										<th>Amount Due</th>
										<th>Payment Status</th>
										<th>Payment Date</th>
										<th>ACTION</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>Bloomings c0.</td>
                                        	<td>John Stone</td>
                                        	<td>89821</td>
                                        	<td>01/01/2017</td>
                                        	<td>JFK Airport</td>
											<td>1501 Lexington Ave</td>
											<td>43</td>
											<td>Pending</td>
											<td></td>
											<td>Edit Order</td>
                                        </tr>
                                       <tr>
                                        	<td>Bloomings c0.</td>
                                        	<td>Mike Angelo</td>
                                        	<td>40032</td>
                                        	<td>01/01/2017</td>
                                        	<td>25 butch street</td>
											<td>14421 78th Ave</td>
											<td>20</td>
											<td>Pending</td>
											<td></td>
											<td>Edit Order</td>
                                        </tr>
										<tr>
                                       <tr>
                                        	<td>Bloomings c0.</td>
                                        	<td>Leo Faraday</td>
                                        	<td>10004</td>
                                        	<td>01/01/2017</td>
                                        	<td>19 Tool Road</td>
											<td>14421 78th Ave</td>
											<td>18</td>
											<td>Pending</td>
											<td></td>
											<td>Edit Order</td>
                                        </tr>
										
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>ALL Jobs Log Report</h3>
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ALL Jobs Log Report Table</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Corp Name</th>
										<th>Driver Name</th>
										<th>Driver ID</th>
                                    	<th>Customer Name/th>
                                    	<th>order Date</th>
										<th>Pickup date</th>
										<th>Pickup Time</th>
										<th>Destination</th>
										<th>Job Completed Time</th>
										<th>ACTION</th>
                                    </thead>
                                    <tbody>
                                        <tr>
						<?php foreach($Result as $report): ?>
											
                                        	<td><?php echo $report['corporation_name']; ?></td>
                                        	<td><?php echo $report['driver_name']; ?></td>
                                        	<td><?php echo $report['driver_id']; ?></td>
                                        	<td><?php echo $report['customer_name']; ?></td>
                                        	<td><?php echo $report['order_date']; ?></td>
                                        	<td><?php echo $report['pickup_date']; ?></td>
						<td><?php echo $report['pickup_time']; ?></td>
						<td><?php echo $report['destination']; ?></td>
						<td><?php echo $report['job_completed_time']; ?></td>
						<td>
			<a href="<?php base_url(); ?>edit?id=<?php echo $report['id']; ?>" ><button type="button" >Edit</button></a>
                                            </td>
                                        </tr>
                                       <?php endforeach; ?>
										
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
  </div>
				</div>
				 
			</div>
          </div>

