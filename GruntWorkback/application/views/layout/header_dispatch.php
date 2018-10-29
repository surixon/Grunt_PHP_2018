<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/favicon.png');?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>CABSCOUT</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
   <link href="<?php echo base_url('assets/jquery-ui-1.12.1/jquery-ui.css');?>" rel="stylesheet" />
    <!-- login CSS     -->
    <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" />

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url('assets/css/animate.min.css');?>
    " rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url('assets/css/paper-dashboard.css');?>
    " rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url('assets/css/demo.css');?>
    " rel="stylesheet" />
    
    <link href="<?php echo base_url('assets/css/custom.css');?>" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href='//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url('assets/css/themify-icons.css');?>" rel="stylesheet">

</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.html" class="simple-text">
                    CABSCOUT
                </a>
            </div>
            <?php 
				$fattr = array('class' => 'form-signin');
				echo form_open('', $fattr); 
			  ?>
              
          <div class="collapse_panel" id="myGroup">
          	<button type="button" style="margin:15px 0px 21px;" class="btn btn-info save_button"  data-parent="#myGroup" data-toggle="collapse" data-target="#demo">Filters</button>
            <div id="demo" class="collapse">
            <ul class="nav sidebar_dropdown">
                <li>
					<?php echo form_label('Driver Status','driver_status',$attributes=array());?>
					<?php 
                         $options = array(
                         '-1'=>'All',
                         '0'=>'Offline',
                         '1'=>'Available',
                         '2'=>'In Progress',
                         '3'=>'Busy'
                         );
                      ?>
					<?php echo form_dropdown('driver_status',$options,set_value('driver_status'),array('class'=>'form-control filter_data','id'=>'driver_status','name'=>'driver_status'));?>
                  </br>
                </li>
			    <li>
					<label for="usr">LOCATION NAME:</label>

					 <select name="location_name" id="location_name" class='form-control filter_data'>
						<option value="">All</option>
						<?php
							for($i=0;$i<count($Drivers);$i++){
								echo "<option value=".$Drivers[$i]['location_id'].">".$Drivers[$i]['location_cab_alias']."</option>";
							}
						?>
					  </select>
                </li>
                <li >
					<label for="usr"></label>
					<input type="text" class="form-control" placeholder="Driver" id="driver" name="driver">
				</li>
				
                <li >
					<label for="usr"></label>
					<input type="text" class="form-control" placeholder="Customer name/tel" id="cust_name_tel" name="cust_name_tel">
				</li>
				<li>
					<button type="button" style="margin:15px 0px 21px;" class="btn btn-primary save_button" onclick="clear_drivers()" id="order_btn">Clear</button>
				</li>
			</ul>
          </div>  
            <div  id="drivers_data" style="display:none"></div>
            <?php echo form_close(); ?>
            </div>
    	</div>
    </div>





    <div class="main-panel">
        <nav class="navbar navbar-default page-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="dispatch.html">Dispatch</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                    
                    	<li>
                            <a href="http://35.162.151.221/dashboard/dispatch">
                                <i class="fa fa-truck" aria-hidden="true"></i>
								<p>Dispatch</p>
                            </a>
                        </li>
                        
                        <li>
                            <a href="http://35.162.151.221/dashboard/dashboard">
                                <i class="fa fa-fw" aria-hidden="true" title="Admin"></i>
								<p>Admin</p>
                            </a>
                        </li>
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="ti-settings"></i>
								<p>Settings</p>
								<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a onclick="logout()">Logout</a></li>
                              </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
