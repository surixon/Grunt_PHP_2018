<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/favicon.png');?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>GRUNTWORK ADMIN PANEL</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link href="<?php echo base_url('assets/jquery-ui-1.12.1/jquery-ui.css');?>" rel="stylesheet" />
    
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url('assets/css/animate.min.css');?>
    " rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url('assets/css/paper-dashboard.css');?>
    " rel="stylesheet"/>
    
<!--
   <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
   <script src="js/bootstrap-datetimepicker.min.js"></script>
-->

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url('assets/css/demo.css');?>
    " rel="stylesheet" />
    
    <link href="<?php echo base_url('assets/css/custom.css');?>" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url('assets/css/themify-icons.css');?>" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
</head>

<body>
	<script>
		//~ var path = location.pathname;
		//~ // filter menu items to find one that has anchor tag with matching href:
		//~ $('.side-menu li').filter(function(){
			//~ return '/' + $('a', this).attr('href') === path;
			//~ // add class active to the item:
		//~ }).addClass('active');
	</script>
<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->
		
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?php echo site_url('/');?>" class="simple-text">
                    Gruntwork
                </a>
            </div>

            <ul class="nav side-menu">
                <li class="<?php if($this->uri->segment(1)=="Dashboard"){echo "active";}?>">
                    <a href="<?php echo site_url('/Dashboard');?>">
                        <i class="fa fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php if($this->uri->segment(1)=="Users"){echo "active";}?>">
                    <a href="<?php echo site_url('/Users');?>">
                        <i class="fa fa-user-circle-o"></i>
                        <p>Registered Users</p>
                    </a>
                </li>
                 <li class="<?php if($this->uri->segment(1)=="Job_details"){echo "active";}?>">
                    <a href="<?php echo site_url('/Job_details');?>">
                        <i class="fa fa-info-circle"></i>
                        <p>Job Details</p>
                    </a>
                </li>
                <li class="<?php if($this->uri->segment(1)=="OngoingJobs"){echo "active";}?>">
                    <a href="<?php echo site_url('/OngoingJobs');?>">
                        <i class="fa fa-spinner"></i>
                        <p>Ongoing Jobs</p>
                    </a>
                </li>
                 <li class="<?php if($this->uri->segment(1)=="CompletedJobs"){echo "active";}?>">
                    <a href="<?php echo site_url('/CompletedJobs');?>">
                        <i class="fa fa-list"></i>
                        <p>Completed Jobs</p>
                    </a>
                </li>
<!--
                <li class="<?php if($this->uri->segment(1)=="History"){echo "active";}?>">
                    <a href="<?php echo site_url('/History');?>">
                        <i class="fa fa-history"></i>
                        <p>History</p>
                    </a>
                </li>
-->
<!--
                 <li class="<?php if($this->uri->segment(1)=="Transaction_history"){echo "active";}?>">
                    <a href="<?php echo site_url('/Transaction_history');?>">
                        <i class="fa fa-history"></i>
                        <p>Job History</p>
                    </a>
                </li>
-->

               <li class="<?php if($this->uri->segment(1)=="Ticket"){echo "active";}?>">
                    <a href="<?php echo site_url('/Ticket');?>">
                        <i class="fa fa-ticket"></i>
                        <p>Tickets</p>
                    </a>
               </li>

            </ul>
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

                   
                    <a class="navbar-brand" href="<?php echo base_url() ?>Dashboard">Dashboard</a>
                    
        </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                    
                    	
                        
                        
                                <li>
                                    

                                    <a href="<?php echo base_url()?>Login/logout">Logout</a>

                                    
      
                                </li>
                             
                       
                    </ul>

                </div>
            </div>
        </nav>
