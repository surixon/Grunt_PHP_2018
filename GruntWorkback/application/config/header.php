<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/favicon.png');?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>MONEY LENDING</title>

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
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?php echo site_url('/');?>" class="simple-text">
                    MONEY LENDING
                </a>
            </div>

            <ul class="nav side-menu">
                <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>">
                    <a href="<?php echo site_url('/dashboard');?>">
                        <i class="fa fa-money"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
<!--
                <li  class="<?php if($this->uri->segment(1)=="reports"){echo "active";}?>">
                    <a href="<?php echo site_url('/reports');?>">
                        <i class="fa fa-file-text"></i>
                        <p>Reports</p>
                    </a>
                </li>
-->
                
                <li>
					<li class="<?php if($this->uri->segment(1)=="Users"){echo "active";}?>">
                    <a href="<?php echo site_url('/Users');?>">
                        <i class="fa fa-file-text"></i>
                        <p>Registerd Users</p>
                    </a>
                </li>
                
                <li>
					<li class="<?php if($this->uri->segment(1)=="City"){echo "active";}?>">
                    <a href="<?php echo site_url('/City');?>">
                        <i class="fa fa-building-o"></i>
                        <p>Cities</p>
                    </a>
                </li>
                <li class="<?php if($this->uri->segment(1)=="Transaction_history"){echo "active";}?>">
                    <a href="<?php echo site_url('/Transaction_history');?>">
                        <i class="fa fa-car"></i>
                        <p>Transaction History</p>
                    </a>
                </li>
                <li class="<?php if($this->uri->segment(1)=="Payment"){echo "active";}?>">
                    <a href="<?php echo site_url('/Payment');?>">
                        <i class="fa fa-tags"></i>
                        <p>Payment Methods</p>
                    </a>
                </li>
                <li class="<?php if($this->uri->segment(1)=="UserLog"){echo "active";}?>">
                    <a href="<?php echo site_url('UserLog');?>">
                        <i class="fa fa-male"></i>
                        <p>User Logs</p>
                    </a>
                </li>
                <li>
					 <li class="<?php if($this->uri->segment(1)=="Rating"){echo "active";}?>">
                    <a href="<?php echo site_url('/Rating');?>">
                        <i class="fa fa-gift"></i>
                        <p>Rating</p>
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
                                    
                                    <a href="<?php echo base_url() ?>Login/logout">Logout</a>
                                    
      
                                </li>
                             
                       
                    </ul>

                </div>
            </div>
        </nav>
