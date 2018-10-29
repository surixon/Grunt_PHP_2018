 <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="#">
                                CABSCOUT
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; CABSCOUT
                </div>
            </div>
        </footer>
        </div>
</div>
        

    <!--   Core JS Files   -->
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio.js');?>"></script>

	<!--  Charts Plugin -->
	<script src="<?php echo base_url('assets/js/chartist.min.js');?>"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

    <!--  Google Maps Plugin    -->
<!--
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyB5FoObqg-zvUkmAyPhCw_ehuz3naVgDpw"></script>
     <script src="<?php echo base_url('assets/js/map.js');?>"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="<?php echo base_url('assets/js/paper-dashboard.js');?>"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="<?php echo base_url('assets/js/demo.js');?>"></script> 
     <!-----Date Picker----->
	
	<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>"></script>
	<script src="<?php echo base_url('assets/jquery-ui-1.12.1/jquery-ui.js');?>"></script>
	<script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
     
<script>
	
		function showData(ride_request_id,payment_type,order_type){
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Dispatch/get_order_detail",
				data: 'ride_request_id='+ride_request_id+'&order_type='+order_type,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					$.each(obj, function(key,val){
						//alert("VAL"+val.driver_name);
						var cash=credit=corp="";
						var driver_status=val.driver_status;
						var order_type=val.order_type;
						if(order_type==0)
						{
							order_type="App Booking";
						}else if(order_type==1){
							order_type="Dashoboard Booking";
						}else if(order_type==2){
							order_type="Network App Booking";
						}else{
							order_type="Network Dashboard Booking";
						}
						if(driver_status=="0")
						{
							driver_status="Offline";
						}else if(driver_status=="1"){
							driver_status="Avialable";
						}else if(driver_status=="2"){
							driver_status="In Progress";
						}else{
							driver_status="Busy";
						}
						if(val.payment_type=="0")
						{
							cash="selected=selected";
						}else if(val.payment_type=="1"){
							credit="selected=selected";
						}else{
							corp="selected=selected";
						}
						var dvDistance = document.getElementById("OrderDetailsPopup");
						dvDistance.innerHTML = "";
						dvDistance.innerHTML += "<td>"+val.driver_name+"</td><td>"+order_type+"</td><td>"+val.datetime+"</td><td>"+driver_status+"</td><td>"+val.customer_name+"</td><td>"+val.mobile+"</td><td>"+val.pickup_location+"</td><td>"+val.drop_location+"</td>";
                        dvDistance.innerHTML += '<td><select name="select_payment_method"  class="form-control" id="select_payment_method"><option value="0" '+cash+'>Cash</option><option value="1" '+credit+'>Credit Card</option><option value="2" '+corp+'>Corporate Account</option></select></td>';
						document.getElementById("hidden_ride_request_id").value=val.ride_request_id;
						document.getElementById("hidden_order_type").value=val.order_type;
					});
				}
			});
		}
		
		function updatePaymentMethod()
		{
			var ride_request_id=document.getElementById("hidden_ride_request_id").value;
			var hidden_order_type=document.getElementById("hidden_order_type").value;
			var payment_type=document.getElementById("select_payment_method").value;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Dispatch/updatePaymentMethod",
				data: 'ride_request_id='+ride_request_id+'&payment_type='+payment_type+'&order_type='+hidden_order_type,
				cache: false,
				success: function(response)
				{   
					var obj = JSON.parse(response);
					var ride_id="ride_id_"+ride_request_id;
					var payment_type=obj.payment_type;
					if(payment_type==0)
					{
						document.getElementById(ride_id).innerHTML="Cash";
					}else if(payment_type==1){
						document.getElementById(ride_id).innerHTML="Credit Card";
					}else{
						document.getElementById(ride_id).innerHTML="Coorporation Account";
					}
				}
			});
		}
		
		$('button.cancel_order').on('click', function() {
			var choice = confirm('Do you really want to delete this record?');
			if(choice === true) {
				return true;
			}
			return false;
		});

		$( function() {
			var dateFormat = "mm/dd/yy",
			 from = $( "#from" ).datepicker({
					  defaultDate: "+1w",
					  changeMonth: true,
					  numberOfMonths: 1
					})
					.on( "change", function() {
					  to.datepicker( "option", "minDate", getDate( this ) );
					  $("#to").removeAttr('disabled');
					  alert("Now select to date");
					}),
				
			  to = $( "#to" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 1
				  })
				  .on( "change", function() {
					  from.datepicker( "option", "maxDate", getDate( this ) );
					  filter_drivers_date();
					  
					
				  });
		 
			function getDate( element ) {
			  var date;
			  try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			  } catch( error ) {
				date = null;
			  }
		 
			  return date;
			}
		} );
		  
		function close_popup(){
			document.getElementById( 'trip_popup' ).style.display = 'none';
		}
		
		function clear_datetime(){
			document.getElementById("from").value='';
			document.getElementById("to").value='';
			var driver_status=document.getElementById("driver_status").value;
			var order_type=document.getElementById("order_type").value;
			var order_status=document.getElementById("order_status").value;
			var location_name=document.getElementById("location_name").value;
			var driver=document.getElementById("driver").value;
			var from_date='';
			var to_date='';
			var cust_name=document.getElementById("cust_name").value;
			var datetype;
			if(driver_status==-1 && order_type=="" && order_status=="" && location_name=="" && driver=="" && from_date=="" && to_date=="" && cust_name=="")
			{
				datetype=1;
			}else{
				datetype=2;
			}
			filter_drivers(datetype,driver_status,order_type,location_name,driver,from_date,to_date,cust_name,order_status);
		}
		
		function filter_drivers_date()
		{
			var driver_status=document.getElementById("driver_status").value;
			var order_type=document.getElementById("order_type").value;
			var order_status=document.getElementById("order_status").value;
			var location_name=document.getElementById("location_name").value;
			var driver=document.getElementById("driver").value;
			var from_date=document.getElementById("from").value;
			var to_date=document.getElementById("to").value;
			var cust_name=document.getElementById("cust_name").value;
			var datetype;
			if(driver_status==-1 && order_type=="" && order_status=="" && location_name=="" && driver=="" && from_date=="" && to_date=="" && cust_name=="")
			{
				datetype=1;
			}else{
				datetype=2;
			}
			filter_drivers(datetype,driver_status,order_type,location_name,driver,from_date,to_date,cust_name,order_status);
		}
		  
		function logout(){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Login/logout",
				cache: false,
				success: function(response)
				{     
					//alert(response);
					if( response == "OK" ) {
						window.location.href = "http://35.162.151.221/dashboard";
					}
				}
			});
		}
	
		$(function(){
			$( "#datepicker" ).datepicker();
			$( "#format" ).change(function() {
				$( "#datepicker" ).datepicker( "option", "dateFormat", $(this).val() );
			});
			
		});
		
		$(function(){
			$( "#from_date" ).datepicker();
			$( "#from_date" ).change(function() {
				$( "#from_date" ).datepicker( "option", "dateFormat", $(this).val() );
			});
		});

        var table;
		$(document).ready(function() {
		 	var datetime_type=1;
		 	getTableData(datetime_type);
		});
		
		function ConfirmCancelOrder(ride_request_id){
            if (confirm("Do you want to cancel order?"))
            {
				//alert(ride_request_id);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>Dispatch/cancel_order",
					data: 'ride_request_id='+ride_request_id,
					cache: false,
					success: function(html)
					{     
						
						if(html=="1")
						{
							var driver_status=document.getElementById("driver_status").value;
							var order_type=document.getElementById("order_type").value;
							var order_status=document.getElementById("order_status").value;
							var location_name=document.getElementById("location_name").value;
							var driver=document.getElementById("driver").value;
							var from_date=document.getElementById("from").value;
							var to_date=document.getElementById("to").value;
							var cust_name=document.getElementById("cust_name").value;
							var datetype=2;
							if(driver_status==-1 && order_type=="" && order_status=="" && location_name=="" && driver=="" && from_date=="" && to_date=="" && cust_name=="")
							{
								datetype=1;
							}
							filter_drivers(datetype,driver_status,order_type,location_name,driver,from_date,to_date,cust_name,order_status);
						}else{
							alert("Some server error");
						}
					}
				});
			}
		}
		
		function getTableData(datetime_type)
		{
			$('#table').DataTable({ 
					"bDestroy": true,
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control  server-side processing mode.
					"order": [], //Initial no order.
					"bSort" : false,
					"bPaginate": true,
					"bLengthChange": true,
					"bInfo": false,
					"lengthMenu": [[10, 15, -1], [10, 15, "All"]],
					
					// Load data for the table's content from an Ajax source
					"ajax": {
						"url": "<?php echo base_url();?>Dispatch/order_list",
						"type": "POST",
						"data": {
							"datetime_type": datetime_type
						}
						
					},
			 
					//~ //Set column definition initialisation properties.
					 "columnDefs": [
						{ 
							"targets": [  ], //first column / numbering column
							"orderable": false, //set not orderable
						},
						],
				
			});
			//table.destroy();
		}


    	$('.form-signin').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
			e.preventDefault();
			return false;
		  }
		});
	
		$( ".target" ).change(function() {
			var cid=$('#corp').attr('id');
			alert("cid"+cid);
			var id=$(this).val();
			alert(id);
			var dataString = 'id='+ id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Reports/report",
				data: dataString,
				cache: false,
				success: function(html)
				{     
					
					 <?php echo "hi"; ?>
				}
			});
		});
	
		$('#datepicker').click(function(){
			var id=$('#corp').attr('id');
		});
	 
		
		$(".radio input[type=radio]").click(function () {
			  alert('hi');

		});

	  
		$('#dp').click(function(){
			var id=$('#corp').attr('id');
		});
	
		$('.corp_link').click(function(){
			var id=$('#corp').attr('id');
			alert("Corporation Name:- "+$( ".target" ).val());
			alert("Date:- "+$( "#datepicker" ).val());
			alert("Date:- "+$( "#dp" ).val());
			alert("All Jobs"+id);
		});
	  
		$('.all_job_link').click(function(){
			var id=$('#all_jobs').attr('id');
			alert("Corporation Name:- "+$( ".target" ).val());
			alert("All Jobs"+id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Reports/report",
				data: dataString,
				cache: false,
				success: function(html)
				{     
					
					 <?php echo "hi"; ?>
				}
			});
		});
	  
</script>

<script type="text/javascript">
	var source, destination;
	var directionsDisplay;
	var directionsService = new google.maps.DirectionsService();
	google.maps.event.addDomListener(window, 'load', function () {
		new google.maps.places.SearchBox(document.getElementById('pickup_address'));
		new google.maps.places.SearchBox(document.getElementById('destination'));
		directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
	});
			
	function change_network_driver(){
		document.getElementById("driver_type").value=2;
	}
	
	function change_assign_driver(id){
		if(id==1)
		{
			document.getElementById("assign_driver").value=1;
			document.getElementById("driver_id").disabled=false;
		}else{
			document.getElementById("assign_driver").value=2;
			document.getElementById("driver_id").disabled=true;
		}
	}
	
	

	function schedule_type(id){
		if(id==1)
		{
			document.getElementById("schedule_type").value=1;
			document.getElementById("timepicker1").disabled=true;
			document.getElementById("datepicker").disabled=true;
		}else{
			document.getElementById("schedule_type").value=2;
			document.getElementById("timepicker1").disabled=false;
			document.getElementById("datepicker").disabled=false;
		}	
	}
	
	function change_my_driver(){
		document.getElementById("driver_type").value=1;
	}
	
	
	function getQuotes(){
		var pickup_address = document.getElementById("pickup_address").value;
		if(pickup_address==""){
			alert("Enter Pickup Address");
			return;
		}
		var destination_address = document.getElementById("destination").value;
		if(destination_address==""){
			alert("Enter Destination Address");
			return;
		}
		source = document.getElementById("pickup_address").value;
		destination = document.getElementById("destination").value;
		var request = {
			origin: source,
			destination: destination,
			travelMode: google.maps.TravelMode.DRIVING
		};
		directionsService.route(request, function (response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
		});
	 
		//*********DISTANCE AND DURATION**********************//
		var service = new google.maps.DistanceMatrixService();
		var check_trip;
		service.getDistanceMatrix({origins: [source],destinations: [destination],travelMode: google.maps.TravelMode.DRIVING,unitSystem: google.maps.UnitSystem.METRIC,avoidHighways: false,avoidTolls: false},
				function (response, status) 
				{
					if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") 
					{
						var distance = response.rows[0].elements[0].distance.text;
						var duration = response.rows[0].elements[0].duration.text;
						var distance_km=distance.split(" ");
						distance="";
						if(distance_km[1]=="m"){
							distance+=Math.round(distance_km[0]*0.000621371);
						}else{
							distance+=Math.round(distance_km[0]*0.621371);
						}
						distance+=" mi";
						
						document.getElementById("distance").value=distance;
						document.getElementById("duration").value=duration;
						$('#getQuote').removeAttr('disabled');
						$('#trip_distance').val(distance);
						$('#trip_duration').val(duration);
						var dvDistance = document.getElementById("trip_distance");
						dvDistance.innerHTML = "";
						dvDistance.innerHTML += "Trip Distance: "+distance;
						var dvDuration = document.getElementById("trip_duration");
						dvDuration.innerHTML = "";
						dvDuration.innerHTML += "Trip Duration: "+duration;
						
					} 
				   else 
					{
						//alert("Invalid Lat/Long");
					}
				}
							
		);
		setTimeout(function(){
			var pickup_address = document.getElementById("pickup_address").value;
			var destination = document.getElementById("destination").value;
			var select_vehicle = document.getElementById("select_vehicle").value;
			var driver_type = document.getElementById("driver_type").value;
			var distance = document.getElementById("distance").value;
			var duration = document.getElementById("duration").value;
			var latitude = document.getElementById("latitude").value;
			var longitude = document.getElementById("longitude").value;
			var destination_longitude = document.getElementById("destination_longitude").value;
			var destination_latitude = document.getElementById("destination_latitude").value;
			var dataString = 'driver_type='+ driver_type+'&select_vehicle='+select_vehicle+'&distance='+distance+'&duration='+duration+'&pickup_address='+pickup_address+
			'&destination='+destination+'&latitude='+latitude+'&longitude='+longitude+'&destination_latitude='+destination_latitude+'&destination_longitude='+destination_longitude;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Dispatch/dispatch_order",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					document.getElementById('trip_popup').style.display = "block";
					$("#order_btn").removeAttr('disabled');
					var driver_lists = document.getElementById("driver_list");
					driver_lists.innerHTML = "";
					var est_to_trip = document.getElementById("est_to_trip");
					est_to_trip.innerHTML = "";
					var total_est = document.getElementById("total_est");
					total_est.innerHTML = "";
					var obj = JSON.parse(response);
					$.each(obj, function(key,val){
						if(key=="no_data")
						{
							//document.getElementById('trip_popup').style.display = "none";
							$("#order_btn").attr('disabled','disabled');
							
						}
						else if(key=="Driver")
						{
							$('#lati').val(latitude);
							$('#longi').val(longitude);
							$("#order_btn").removeAttr('disabled');
							$.each(val, function(k,v){
								$( "#driver_list" ).append("<tr><td>"+v.name+"</td><td>"+v.company_name+"</td><td>"+v.location_name+"</td><td>"+v.status+"</td><td>"+v.distance+"</td></tr>"); 
							});
							
						}
						else if(key=="est_to_pickup")
						{
							$( "#est_to_trip" ).append("Est Time To Pickup: "+val); 
						}
						else if(key=="basefare")
						{
							var max_basefare=val.bse_fare;
							$( "#total_est" ).append("Total Estimated fare: "+max_basefare); 
						}
					});
				}
			});
		}, 1000);
		
	} 

	function ClearDestinationPickup()
	{
		 $('#check_route_btn').attr('disabled',"disabled");
		 $('#getQuote').attr('disabled','disabled');
		 $('#pickup_address').removeAttr("disabled");
		 $('#destination').attr("disabled","disabled");
		 $('#pickup_address').val("");
		 $('#destination').val("");
	}
	
	function clear_form(){
		 $('#pickup_address').val("");
		 $('#destination').val("");
		 document.getElementById('trip_popup').style.display = "none";
		 $("#order_btn").attr('disabled','disabled');
	}
	
	function order_form(){
		var driver_id = document.getElementById("driver_id").value;
		var customer_name = document.getElementById("customer_name").value;
		var customer_telephone = document.getElementById("customer_telephone").value;
		var assign_driver = document.getElementById("assign_driver").value;
		var schedule_type = document.getElementById("schedule_type").value;
		var datepicker = document.getElementById("datepicker").value;
		var timepicker1 = document.getElementById("timepicker1").value;
		var flat_rate = document.getElementById("flat_rate").value;
		var payment_method = document.getElementById("payment_method").value;
		var lati = document.getElementById("lati").value;
		var longi = document.getElementById("longi").value;
		if(customer_name=="")
		{
			alert("Please enter customer name");
			return;
		}
		if(customer_telephone=="")
		{
			alert("Please enter customer telephone");
			return;
		}
		var data="";
		if(assign_driver==1){
			if(driver_id=="")
			{
				alert("Please select driver");
				return;
			}
			data='driver_id='+ driver_id+'&';
		}
		if(schedule_type==1){
			//~ var today = new Date();
			//~ var date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();
			//~ var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
			//~ var datetime = date+' '+time;
			var datetime = new Date().toLocaleString();
			//alert(datetime);
		}
		else{
			if(datepicker=="")
			{
				alert("Please select date");
				return;
			}
			if(timepicker1=="")
			{
				alert("Please select time");
				return;
			}
			var datetime = datepicker+" "+timepicker1;
		}
		if(flat_rate=="")
		{
			alert("Please enter falt rate");
			return;
		}
		if(payment_method=="")
		{
			alert("Please select payment method");
			return;
		}
		var dataString = data+'customer_name='+ customer_name+'&customer_telephone='+customer_telephone+'&assign_driver='+assign_driver+'&schedule_type='+schedule_type+
		'&pickup_time='+datetime+'&flat_rate='+flat_rate+'&payment_method='+payment_method+'&latitude='+lati+'&longitude='+longi+'&order_creation_date='+datetime;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Dispatch/book_dispatch_order",
			data: dataString,
			cache: false,
			success: function(html)
			{     
				document.getElementById('trip_popup').style.display = "block";
				//~ $("#order_btn").removeAttr('disabled');
				alert("Booking Done");
				location.reload(); 
			}
		});
	}
</script>


<script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('pickup_address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat()
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                 $("#latitude").val(latitude);
                $("#longitude").val(longitude);
                $('#destination').removeAttr("disabled");
            });
        });
    </script>
    
  
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('destination'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat()
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                $("#destination_latitude").val(latitude);
                $("#destination_longitude").val(longitude);
                $('#check_route_btn').removeAttr('disabled');
            });
        });
    </script>
        <script type="text/javascript">

  $(document).ready(function()
  {
	$("#driver_status").show();
	$("#order_type").show();
	$(".assign_driver input[type=radio]").click(function () {
		
		var id=$(this).val();
		
		var dataString = 'id='+ id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Dispatch/get_driver_status",
			data: dataString,
			cache: false,
			success: function(html)
			{     
				
				 $("#driver_status").show();
				 $("#driver_status").html(html);
			}
		});
	 });
  });	
</script>

<!-- Company Functions -->
<script>
	function addCompany(){
		
		var location_name = document.getElementById("location_name").value;
		var address = document.getElementById("address").value;
		var city = document.getElementById("city").value;
		var state = document.getElementById("state").value;
		var zip = document.getElementById("zip").value;
		var telephone = document.getElementById("telephone").value;
		var manager_name = document.getElementById("manager_name").value;
		var email = document.getElementById("email").value;
		var cab_alias = document.getElementById("cab_alias").value;
		var company_id = document.getElementById("company_id").value;
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		
		if(location_name=="")
		{
			alert("Please enter location name");
			return;
		}else if(address=="")
		{
			alert("Please enter address");
			return;
		}else if(city=="")
		{
			alert("Please enter city");
			return;
		}else if(state=="")
		{
			alert("Please enter state");
			return;
		}else if(zip=="")
		{
			alert("Please enter zip");
			return;
		}else if(telephone=="")
		{
			alert("Please enter telephone");
			return;
		}else if(manager_name=="")
		{
			alert("Please enter manager name");
			return;
		}
		else if(email=="")
		{
			alert("Please enter email");
			return;
		}
		else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			alert("Not a valid e-mail address");
			return;
		}
		else if(cab_alias=="")
		{
			alert("Please enter cab alias");
			return;
		}
		
		var dataString = 'company_id='+ company_id+'&location_name='+ location_name+'&location_address='+address+'&location_city='+city+'&location_state='+state+'&location_zip='+zip+
		'&location_telephone='+telephone+'&manager_name='+manager_name+'&location_email='+email+'&location_cab_alias='+cab_alias;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Company/company",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Company";
				}else{
					alert(msg);
				} 
			}
		});
	}
</script>

<!-- Company Functions -->
<script>
	function updateCompany(){
		
		var location_name = document.getElementById("location_name").value;
		var address = document.getElementById("location_address").value;
		var city = document.getElementById("location_city").value;
		var state = document.getElementById("location_state").value;
		var zip = document.getElementById("location_zip").value;
		var telephone = document.getElementById("location_telephone").value;
		var manager_name = document.getElementById("manager_name").value;
		var email = document.getElementById("location_email").value;
		var cab_alias = document.getElementById("location_cab_alias").value;
		var location_id = document.getElementById("location_id").value;
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if(location_name=="")
		{
			alert("Please enter location name");
			return;
		}else if(address=="")
		{
			alert("Please enter address");
			return;
		}else if(city=="")
		{
			alert("Please enter city");
			return;
		}else if(state=="")
		{
			alert("Please enter state");
			return;
		}else if(zip=="")
		{
			alert("Please enter zip");
			return;
		}else if(telephone=="")
		{
			alert("Please enter telephone");
			return;
		}else if(manager_name=="")
		{
			alert("Please enter manager name");
			return;
		}else if(email=="")
		{
			alert("Please enter email");
			return;
		}else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			alert("Not a valid e-mail address");
			return;
		}
		else if(cab_alias=="")
		{
			alert("Please enter cab alias");
			return;
		}
		
		var dataString = 'location_name='+ location_name+'&location_address='+address+'&location_city='+city+'&location_state='+state+'&location_zip='+zip+
		'&location_telephone='+telephone+'&manager_name='+manager_name+'&location_email='+email+'&location_cab_alias='+cab_alias+'&location_id='+location_id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Company/updateCompany",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Company";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function locationDelete(location_id){
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'location_id='+ location_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Company/locationDelete",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Company";
					}else{
						alert(msg);
					} 
				}
			});
		    return true;
		}
	    else{
			return false;
		}
		
	}
	
	function promoDelete(promo_id){
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'id='+ promo_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Promo/promoDelete",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Promo";
					}else{
						alert(msg);
					} 
				}
			});
		    return true;
		}
	    else{
			return false;
		}
		
	}
	
	function driverDelete(driver_id){
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'id='+ driver_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Driver/driverDelete",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Driver";
					}else{
						alert(msg);
					} 
				}
			});
		    return true;
		}
	    else{
			return false;
		}
		
	}
	
	function corpDelete(corp_id){
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'id='+ corp_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Corp/corpDelete",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Corp";
					}else{
						alert(msg);
					} 
				}
			});
		    return true;
		}
	    else{
			return false;
		}
		
	}
	
	function add_minutes(add_update){
		
		var network_jobs_to_other_companies=document.getElementById("network_jobs_to_other_companies").value;
		if(network_jobs_to_other_companies=="")
		{
			alert("Network job required");
			return;
		}
		var dataString = 'network_jobs_to_other_companies='+ network_jobs_to_other_companies;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Company/add_network_jobs_to_other_companies",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					if(add_update == "1")
					{
						alert("Comapny network jobs to other companies are added");
					}else{
						alert("Comapny network jobs to other companies are updated");
					}
					window.location.href = "<?php echo base_url();?>Company";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function cancelUpdateCompany(){
		window.location.href = "<?php echo base_url();?>Company";
	}
</script>
<!--Pricing Section-->
<script>
	function addSedanPricing(add_update){
		var basefare=document.getElementById("basefare").value;
		if(basefare=="")
		{
			alert("Sedan basefare required");
			return;
		}
		var permile=document.getElementById("permile").value;
		if(permile=="")
		{
			alert("Sedan permile required");
			return;
		}
		var permin=document.getElementById("permin").value;
		if(permin=="")
		{
			alert("Sedan permin required");
			return;
		}
		var set_minimum=document.getElementById("set_minimum").value;
		if(set_minimum=="")
		{
			alert("Sedan set minimum price required");
			return;
		}
		var per_stop_fee=document.getElementById("per_stop_fee").value;
		if(per_stop_fee=="")
		{
			alert("Sedan per_stop_fee required");
			return;
		}
		var per_stop_min=document.getElementById("per_stop_min").value;
		if(per_stop_min=="")
		{
			alert("Sedan per_stop_min required");
			return;
		}
		var fuel_surcharged=document.getElementById("fuel_surcharged%").value;
		if(fuel_surcharged=="")
		{
			alert("Sedan fuel_surcharged% required");
			return;
		}
		var salestax=document.getElementById("salestax").value;
		if(salestax=="")
		{
			alert("Sedan salestax required");
			return;
		}
		var cc_surcharged=document.getElementById("cc_surcharged%").value;
		if(cc_surcharged=="")
		{
			alert("Sedan cc_surcharged% required");
			return;
		}
		var backfund=document.getElementById("backfund%").value;
		if(backfund=="")
		{
			alert("Sedan backfund% required");
			return;
		}
		var cancellation_fee=document.getElementById("cancellation_fee").value;
		if(cancellation_fee=="")
		{
			alert("Sedan cancellation fee required");
			return;
		}
		var car_type="1";
		var dataString = 'basefare='+ basefare+'&permile='+permile+'&permin='+permin+'&set_minimum='+set_minimum+'&per_stop_fee='+per_stop_fee+
						'&per_stop_min='+per_stop_min+'&fuel_surcharged%='+fuel_surcharged+'&salestax='+salestax+'&cc_surcharged%='+cc_surcharged+
						'&cancellation_fee='+cancellation_fee+'&car_type='+car_type+'&backfund%='+backfund;
		var base_url;
		if(add_update=="1"){
			base_url="<?php echo base_url();?>Price/addSedanPricing";
		}else{
			base_url="<?php echo base_url();?>Price/updateSedanPricing";
		}
		$.ajax({
			type: "POST",
			url: base_url,
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					if(add_update == "1")
					{
						alert("Pricing added for sedan");
					}else{
						alert("Pricing updated for sedan");
					}
					window.location.href = "<?php echo base_url();?>Price";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function addSuvPricing(add_update){
		var basefare=document.getElementById("basefare_suv").value;
		if(basefare=="")
		{
			alert("SUV basefare required");
			return;
		}
		var permile=document.getElementById("permile_suv").value;
		if(permile=="")
		{
			alert("SUV permile required");
			return;
		}
		var permin=document.getElementById("permin_suv").value;
		if(permin=="")
		{
			alert("SUV permin required");
			return;
		}
		var set_minimum=document.getElementById("set_minimum_suv").value;
		if(set_minimum=="")
		{
			alert("SUV set minimum price required");
			return;
		}
		var per_stop_fee=document.getElementById("per_stop_fee_suv").value;
		if(per_stop_fee=="")
		{
			alert("SUV per_stop_fee required");
			return;
		}
		var per_stop_min=document.getElementById("per_stop_min_suv").value;
		if(per_stop_min=="")
		{
			alert("SUV per_stop_min required");
			return;
		}
		var fuel_surcharged=document.getElementById("fuel_surcharged%_suv").value;
		if(fuel_surcharged=="")
		{
			alert("SUV fuel_surcharged% required");
			return;
		}
		var salestax=document.getElementById("salestax_suv").value;
		if(salestax=="")
		{
			alert("SUV salestax required");
			return;
		}
		var cc_surcharged=document.getElementById("cc_surcharged%_suv").value;
		if(cc_surcharged=="")
		{
			alert("SUV cc_surcharged% required");
			return;
		}
		var backfund=document.getElementById("backfund%_suv").value;
		if(backfund=="")
		{
			alert("SUV backfund% required");
			return;
		}
		var cancellation_fee=document.getElementById("cancellation_fee_suv").value;
		if(cancellation_fee=="")
		{
			alert("SUV cancellation fee required");
			return;
		}
		var car_type="2";
		var dataString = 'basefare='+ basefare+'&permile='+permile+'&permin='+permin+'&set_minimum='+set_minimum+'&per_stop_fee='+per_stop_fee+
						'&per_stop_min='+per_stop_min+'&fuel_surcharged%='+fuel_surcharged+'&salestax='+salestax+'&cc_surcharged%='+cc_surcharged+
						'&cancellation_fee='+cancellation_fee+'&car_type='+car_type+'&backfund%='+backfund;
		var base_url;
		if(add_update=="1"){
			base_url="<?php echo base_url();?>Price/addSuvPricing";
		}else{
			base_url="<?php echo base_url();?>Price/updateSuvPricing";
		}
		$.ajax({
			type: "POST",
			url: base_url,
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					if(add_update == "1")
					{
						alert("Pricing added for suv");
					}else{
						alert("Pricing updated for suv");
					}
					window.location.href = "<?php echo base_url();?>Price";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function add_driver(){
		var location_name=document.getElementById("location_name").value;
		if(location_name=="")
		{
			document.getElementById("location_name").focus();
			alert("Please select location name");
			return;
		}
		var name=document.getElementById("name").value;
		if(name=="")
		{
			document.getElementById("name").focus();
			alert("Please enter name required");
			return;
		}
		var address=document.getElementById("address").value;
		if(address=="")
		{
			document.getElementById("address").focus();
			alert("Please enter address required");
			return;
		}
		var city=document.getElementById("city").value;
		if(city=="")
		{
			document.getElementById("city").focus();
			alert("Please enter city required");
			return;
		}
		var state=document.getElementById("state").value;
		if(state=="")
		{
			document.getElementById("state").focus();
			alert("Please enter state required");
			return;
		}
		var zip=document.getElementById("zip").value;
		if(zip=="")
		{
			document.getElementById("zip").focus();
			alert("Please enter zip required");
			return;
		}
		var mobile=document.getElementById("mobile").value;
		if(mobile=="")
		{
			document.getElementById("mobile").focus();
			alert("Please enter mobile required");
			return;
		}
		var driver_license=document.getElementById("driver_license").value;
		if(driver_license=="")
		{
			document.getElementById("driver_license").focus();
			alert("Please enter driver license required");
			return;
		}
		var email=document.getElementById("email").value;
		if(email=="")
		{
			document.getElementById("email").focus();
			alert("Please enter email required");
			return;
		}
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			alert("Not a valid e-mail address");
			return;
		}
		var make=document.getElementById("make").value;
		if(make=="")
		{
			document.getElementById("make").focus();
			alert("Please enter make required");
			return;
		}
		var model=document.getElementById("model").value;
		if(model=="")
		{
			document.getElementById("model").focus();
			alert("Please enter model required");
			return;
		}
		var year=document.getElementById("year").value;
		if(year=="")
		{
			document.getElementById("year").focus();
			alert("Please enter year required");
			return;
		}
		var color=document.getElementById("color").value;
		if(color=="")
		{
			document.getElementById("color").focus();
			alert("Please enter color required");
			return;
		}
		var lic_plate=document.getElementById("lic_plate").value;
		if(lic_plate=="")
		{
			document.getElementById("lic_plate").focus();
			alert("Please enter lic plate required");
			return;
		}
		var driver=document.getElementById("driver%").value;
		if(driver=="")
		{
			document.getElementById("driver%").focus();
			alert("Please enter driver% required");
			return;
		}
		var company=document.getElementById("company%").value;
		if(company=="")
		{
			document.getElementById("company%").focus();
			alert("Please enter company% required");
			return;
		}
		var password=document.getElementById("password").value;
		if(password=="")
		{
			document.getElementById("password").focus();
			alert("Please enter password required");
			return;
		}
		var dataString = 'location_name='+ location_name+'&name='+name+'&address='+address+'&city='+city+'&state='+state+
						'&zip='+zip+'&mobile='+mobile+'&driver_license='+driver_license+'&email='+email+
						'&make='+make+'&model='+model+'&year='+year+'&color='+color+'&lic_plate='+lic_plate+'&driver%='+driver
						+'&company%='+company+'&password='+password;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Driver/driver_register",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Driver";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function update_driver(){
		var location_name=document.getElementById("location_name").value;
		if(location_name=="")
		{
			document.getElementById("location_name").focus();
			alert("Please enter location name required");
			return;
		}
		var name=document.getElementById("name").value;
		if(name=="")
		{
			document.getElementById("name").focus();
			alert("Please enter name required");
			return;
		}
		var address=document.getElementById("address").value;
		if(address=="")
		{
			document.getElementById("address").focus();
			alert("Please enter address required");
			return;
		}
		var city=document.getElementById("city").value;
		if(city=="")
		{
			document.getElementById("city").focus();
			alert("Please enter city required");
			return;
		}
		var state=document.getElementById("state").value;
		if(state=="")
		{
			document.getElementById("state").focus();
			alert("Please enter state required");
			return;
		}
		var zip=document.getElementById("zip").value;
		if(zip=="")
		{
			document.getElementById("zip").focus();
			alert("Please enter zip required");
			return;
		}
		var mobile=document.getElementById("mobile").value;
		if(mobile=="")
		{
			document.getElementById("mobile").focus();
			alert("Please enter mobile required");
			return;
		}
		var driver_license=document.getElementById("driver_license").value;
		if(driver_license=="")
		{
			document.getElementById("driver_license").focus();
			alert("Please enter driver license required");
			return;
		}
		var email=document.getElementById("email").value;
		if(email=="")
		{
			document.getElementById("email").focus();
			alert("Please enter email required");
			return;
		}
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			alert("Not a valid e-mail address");
			return;
		}
		var make=document.getElementById("make").value;
		if(make=="")
		{
			document.getElementById("make").focus();
			alert("Please enter make required");
			return;
		}
		var model=document.getElementById("model").value;
		if(model=="")
		{
			document.getElementById("model").focus();
			alert("Please enter model required");
			return;
		}
		var year=document.getElementById("year").value;
		if(year=="")
		{
			document.getElementById("year").focus();
			alert("Please enter year required");
			return;
		}
		var color=document.getElementById("color").value;
		if(color=="")
		{
			document.getElementById("color").focus();
			alert("Please enter color required");
			return;
		}
		var lic_plate=document.getElementById("lic_plate").value;
		if(lic_plate=="")
		{
			document.getElementById("lic_plate").focus();
			alert("Please enter lic plate required");
			return;
		}
		var driver=document.getElementById("driver%").value;
		if(driver=="")
		{
			document.getElementById("driver%").focus();
			alert("Please enter driver% required");
			return;
		}
		var company=document.getElementById("company%").value;
		if(company=="")
		{
			document.getElementById("company%").focus();
			alert("Please enter company% required");
			return;
		}
		var password=document.getElementById("password").value;
		var driver_id=document.getElementById("driver_id").value;
		if(password=="")
		{
			document.getElementById("password").focus();
			alert("Please enter password required");
			return;
		}
		var dataString = 'location_name='+ location_name+'&name='+name+'&address='+address+'&city='+city+'&state='+state+
						'&zip='+zip+'&mobile='+mobile+'&driver_license='+driver_license+'&email='+email+
						'&make='+make+'&model='+model+'&year='+year+'&color='+color+'&lic_plate='+lic_plate+'&driver%='+driver
						+'&company%='+company+'&password='+password+'&driver_id='+driver_id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Driver/updateCompany",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Driver";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function addCorps(){
		var company_id=document.getElementById("company_id").value;
		var corporation_name=document.getElementById("corporation_name").value;
		if(corporation_name=="")
		{
			document.getElementById("corporation_name").focus();
			alert("Please enter corporation name required");
			return;
		}
		var address=document.getElementById("address").value;
		if(address=="")
		{
			document.getElementById("address").focus();
			alert("Please enter address required");
			return;
		}
		var city=document.getElementById("city").value;
		if(city=="")
		{
			document.getElementById("city").focus();
			alert("Please enter city required");
			return;
		}
		var state=document.getElementById("state").value;
		if(state=="")
		{
			document.getElementById("state").focus();
			alert("Please enter state required");
			return;
		}
		var zip=document.getElementById("zip").value;
		if(zip=="")
		{
			document.getElementById("zip").focus();
			alert("Please enter zip required");
			return;
		}
		var mobile=document.getElementById("mobile").value;
		if(mobile=="")
		{
			document.getElementById("mobile").focus();
			alert("Please enter mobile required");
			return;
		}
		var contact_name=document.getElementById("contact_name").value;
		if(contact_name=="")
		{
			document.getElementById("contact_name").focus();
			alert("Please enter contact name required");
			return;
		}
		var email=document.getElementById("email").value;
		if(email=="")
		{
			document.getElementById("email").focus();
			alert("Please enter email required");
			return;
		}
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			document.getElementById("email").focus();
			alert("Not a valid e-mail address");
			return;
		}
		var account_id=document.getElementById("account_id").value;
		if(account_id=="")
		{
			document.getElementById("account_id").focus();
			alert("Please enter account id required");
			return;
		}
		var discounted=document.getElementById("discounted%").value;
		if(discounted=="")
		{
			document.getElementById("discounted%").focus();
			alert("Please enter discounted% required");
			return;
		}
		var dataString = 'corporation_name='+ corporation_name+'&address='+address+'&company_id='+company_id+'&mobile='+mobile+'&city='+city+'&state='+state+
						'&zip='+zip+'&contact_name='+contact_name+'&email='+email+'&account_id='+account_id+'&discounted%='+discounted;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Corp/corp_register",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Corp";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function updateCorps(){
		var corp_id=document.getElementById("corp_id").value;
		var corporation_name=document.getElementById("corporation_name").value;
		if(corporation_name=="")
		{
			document.getElementById("corporation_name").focus();
			alert("Please enter corporation name required");
			return;
		}
		var address=document.getElementById("address").value;
		if(address=="")
		{
			document.getElementById("address").focus();
			alert("Please enter address required");
			return;
		}
		var city=document.getElementById("city").value;
		if(city=="")
		{
			document.getElementById("city").focus();
			alert("Please enter city required");
			return;
		}
		var state=document.getElementById("state").value;
		if(state=="")
		{
			document.getElementById("state").focus();
			alert("Please enter state required");
			return;
		}
		var zip=document.getElementById("zip").value;
		if(zip=="")
		{
			document.getElementById("zip").focus();
			alert("Please enter zip required");
			return;
		}
		var mobile=document.getElementById("mobile").value;
		if(mobile=="")
		{
			document.getElementById("mobile").focus();
			alert("Please enter mobile required");
			return;
		}
		var contact_name=document.getElementById("contact_name").value;
		if(contact_name=="")
		{
			document.getElementById("contact_name").focus();
			alert("Please enter contact name required");
			return;
		}
		var email=document.getElementById("email").value;
		if(email=="")
		{
			document.getElementById("email").focus();
			alert("Please enter email required");
			return;
		}
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			document.getElementById("email").focus();
			alert("Not a valid e-mail address");
			return;
		}
		var account_id=document.getElementById("account_id").value;
		if(account_id=="")
		{
			document.getElementById("account_id").focus();
			alert("Please enter account id required");
			return;
		}
		var discounted=document.getElementById("discounted%").value;
		if(discounted=="")
		{
			document.getElementById("discounted%").focus();
			alert("Please enter discounted% required");
			return;
		}
		var dataString = 'corporation_name='+ corporation_name+'&address='+address+'&mobile='+mobile+'&city='+city+'&state='+state+
						'&zip='+zip+'&contact_name='+contact_name+'&email='+email+'&account_id='+account_id+'&discounted='+discounted+'&corp_id='+corp_id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Corp/updateCorps",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Corp";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function addPromos(){
		var promotion_name=document.getElementById("promotion_name").value;
		if(promotion_name=="")
		{
			document.getElementById("promotion_name").focus();
			alert("Please enter promotion name required");
			return;
		}
		var discounted=document.getElementById("discounted").value;
		if(discounted=="")
		{
			document.getElementById("discounted").focus();
			alert("Please enter discounted% required");
			return;
		}
		var expiration=document.getElementById("expiration").value;
		if(expiration=="")
		{
			document.getElementById("expiration").focus();
			alert("Please enter expiration required");
			return;
		}
		var promotion_code=document.getElementById("promotion_code").value;
		
		if(promotion_code=="")
		{
			document.getElementById("promotion_code").focus();
			alert("Please enter promotion code required");
			return;
		}
		var company_id=document.getElementById("company_id").value;
		var dataString = 'promotion_name='+ promotion_name+'&discounted='+discounted+'&expiration='+expiration+'&promotion_code='+promotion_code+'&company_id='+company_id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Promo/promotion_register",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Promo";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	function updatePromos(){
		var promotion_name=document.getElementById("promotion_name").value;
		if(promotion_name=="")
		{
			document.getElementById("promotion_name").focus();
			alert("Please enter promotion name required");
			return;
		}
		var discounted=document.getElementById("discounted").value;
		if(discounted=="")
		{
			document.getElementById("discounted").focus();
			alert("Please enter discounted% required");
			return;
		}
		var expiration=document.getElementById("expiration").value;
		if(expiration=="")
		{
			document.getElementById("expiration").focus();
			alert("Please enter expiration% required");
			return;
		}
		var promotion_code=document.getElementById("promotion_code").value;
		if(promotion_code=="")
		{
			document.getElementById("promotion_code").focus();
			alert("Please enter promotion code required");
			return;
		}
		var promo_id=document.getElementById("promo_id").value;
		var dataString = 'promotion_name='+ promotion_name+'&discounted='+discounted+'&expiration='+expiration+'&promotion_code='+promotion_code+'&promo_id='+promo_id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Promo/updatePromo",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				var obj = JSON.parse(response);
				var id = obj.id;
				var msg = obj.message;
				if(id == "1"){
					alert(msg);
					window.location.href = "<?php echo base_url();?>Promo";
				}else{
					alert(msg);
				} 
			}
		});
	}
	
	$(document).ready(function()
	{
		var data_type1="all";
		filter_driver_cards('','','','',data_type1);
	});
	
	function divExpand(id)
	{
		var expandCollapseId = "collapseExample"+id;
		var down_angle = "down_angle_"+id;
		document.getElementById(expandCollapseId).style.display = 'block'; 
		document.getElementById(down_angle).style.display = 'none'; 
	}
	
	function divCollapse(id)
	{
		var expandCollapseId = "collapseExample"+id;
		var down_angle = "down_angle_"+id;
		document.getElementById(expandCollapseId).style.display = 'none'; 
		document.getElementById(down_angle).style.display = 'block'; 
	}
	
	function displayAvialablePath(driver_pic,driver_name,driver_lat,driver_lng) {
		demo.initGoogleMaps();
		// Create a map and center it on Manhattan.
		var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: parseFloat(driver_lat), lng: parseFloat(driver_lng)}
        });
        
		var car = 'http://35.162.151.221/dashboard/assets/img/car.png';
		var pickupContentString = '<div id="content">'+
								'<div id="siteNotice">'+
								'</div>'+
								'<div id="bodyContent">'+
								'<p><img src="http://35.162.151.221/profile_pics/'+driver_pic+'" height="22" width="22" style="border-radius:50%"> <b>'+decodeURIComponent(driver_name)+'</b></p>'+
								'</div>'+
								'</div>';
		var infowindow = new google.maps.InfoWindow({
		  content: pickupContentString
		});
		
		var marker = new google.maps.Marker({
				  //~ position: {lat:parseFloat(lat),lng: parseFloat(lng)},
				  position: {lat: parseFloat(driver_lat), lng: parseFloat(driver_lng)},
				  map: map,
				  icon: car
			});
		marker.addListener('click', function() {
				  infowindow.open(map, marker);
				});
				
      }
      
    function displayPath(order_status,driver_pic,mobile,driver_name,customer_name,driver_lat,driver_lng, pickup_location,drop_location) {
		//alert(pickup_location);
        var markerArray = [];
        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        // Create a map and center it on Manhattan.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: driver_lat, lng: driver_lng}
        });
		
		var rendererOptions = {
		  map: map,
		  suppressMarkers : true
		}
		if(order_status=='Busy')
		{
			var lat_lng = decodeURIComponent(driver_lat)+','+decodeURIComponent(driver_lng);
			$.ajax({
				type: "POST",
				url: "http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat_lng+"&sensor=true",
				cache: false,
				success: function(response)
				{     
					//alert(response.results[0].formatted_address); 
					getDistance(response.results[0].formatted_address,decodeURIComponent(drop_location));
					
				}
			});
		}else if(decodeURIComponent(order_status)=='In Progress'){
			var lat_lng = decodeURIComponent(driver_lat)+','+decodeURIComponent(driver_lng);
			$.ajax({
				type: "POST",
				url: "http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat_lng+"&sensor=true",
				cache: false,
				success: function(response)
				{     
					//alert(response.results[0].formatted_address); 
					getDistance(response.results[0].formatted_address,decodeURIComponent(pickup_location));
					
				}
			});
		}
			
        // Create a renderer for directions and bind it to the map.
        var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

        // Instantiate an info window to hold step text.
        var stepDisplay = new google.maps.InfoWindow;

        // Display the route between the initial start and end selections.
        directionsService.route({
			  origin: decodeURIComponent(pickup_location),
			  destination: decodeURIComponent(drop_location),
			  travelMode: 'WALKING'
			}, function(response, status) {
				  // Route the directions and pass the response to a function to create
				  // markers for each step.
				   if (status === 'OK') {
						directionsDisplay.setDirections(response);
						var car = 'http://35.162.151.221/dashboard/assets/img/car.png';
						if(order_status=='Busy')
						{
							var men = 'http://35.162.151.221/dashboard/assets/img/flag.png';
							var pickupContentString = '<div id="content">'+
											'<div id="siteNotice">'+
											'</div>'+
											'<div id="bodyContent">'+
											'<p>Driver Name <b>'+decodeURIComponent(driver_name)+'</b></p>'+
											'<p>Customer Name <b>'+decodeURIComponent(customer_name)+'</b></p>'+
											'</div>'+
											'</div>';
							var dropContentString = '<div id="content">'+
												'<div id="siteNotice">'+
												'</div>'+
												'<div id="bodyContent">'+
												'<p>Location <b>'+decodeURIComponent(drop_location)+'</b></p>'+
												'<p>Arrival Time <b>'+document.getElementById("find_distance").value+'</b></p>'+
												'</div>'+
												'</div>';
						}
						else  if(decodeURIComponent(order_status)=='In Progress'){
							var men = 'http://35.162.151.221/dashboard/assets/img/men.png';
							var dropContentString = '<div id="content">'+
											'<div id="siteNotice">'+
											'</div>'+
											'<div id="bodyContent">'+
											'<p>Customer Name <b>'+decodeURIComponent(customer_name)+'</b></p>'+
											'<p>Customer Tel <b>'+mobile+'</b></p>'+
											'<p>ETA <b>'+document.getElementById("find_distance").value+'</b></p>'+
											'</div>'+
											'</div>';
							var pickupContentString = '<div id="content">'+
												'<div id="siteNotice">'+
												'</div>'+
												'<div id="bodyContent">'+
												'<p><img src="http://35.162.151.221/profile_pics/'+driver_pic+'" height="22" width="22" style="border-radius:50%"> <b>'+decodeURIComponent(driver_name)+'</b></p>'+
												'</div>'+
												'</div>';
						}
						var infowindow = new google.maps.InfoWindow({
						  content: pickupContentString
						});
						var infowindow1 = new google.maps.InfoWindow({
						  content: dropContentString
						});
						
						var marker = new google.maps.Marker({
								  //~ position: {lat:parseFloat(lat),lng: parseFloat(lng)},
								  position: response.routes[0].legs[0].start_location,
								  map: map,
								  icon: car
							});
						var marker1 = new google.maps.Marker({
								  //~ position: {lat:parseFloat(lat),lng: parseFloat(lng)},
								  position: response.routes[0].legs[0].end_location,
								  map: map,
								  icon: men
							});
						marker.addListener('click', function() {
								  infowindow.open(map, marker);
								});
						marker1.addListener('click', function() {
								  infowindow1.open(map, marker1);
								});
				  } else {
					//window.alert('Directions request failed due to ' + status);
				  }
			});
      }
	
	  function getDistance(source,destination){
		var request = {
			origin: source,
			destination: destination,
			travelMode: google.maps.TravelMode.DRIVING
		};
		directionsService.route(request, function (response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
		});
	 
		//*********DISTANCE AND DURATION**********************//
		var service = new google.maps.DistanceMatrixService();
		service.getDistanceMatrix({origins: [source],destinations: [destination],travelMode: google.maps.TravelMode.DRIVING,unitSystem: google.maps.UnitSystem.METRIC,avoidHighways: false,avoidTolls: false},
				function (response, status) 
				{
					if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") 
					{
						var duration = response.rows[0].elements[0].duration.text;
						//alert(duration);
						document.getElementById("find_distance").value=duration;
					} 
				   else 
					{
						//alert("Invalid Lat/Long");
					}
				}			
		);
	}
	
      $(function() {
		    //Filter left side panel
			$('.filter_data').on('change', function(event) {
				var driver_status=document.getElementById("driver_status").value;
				var location_name=document.getElementById("location_name").value;
				var driver=document.getElementById("driver").value;
				var cust_name_tel=document.getElementById("cust_name_tel").value;
				var data_type="no_filter";
				if(driver_status==-1 && location_name=="" && driver=="")
				{
					data_type="all";
				}
				filter_driver_cards(driver_status,location_name,driver,cust_name_tel,data_type);

			});
			
			$('#cust_name_tel').on('keyup', function(event) {
				var driver_status=document.getElementById("driver_status").value;
				var location_name=document.getElementById("location_name").value;
				var driver=document.getElementById("driver").value;
				var cust_name_tel=document.getElementById("cust_name_tel").value;
				var data_type="no_filter";
				if(driver_status==-1 && location_name=="" && driver=="" && cust_name_tel=="")
				{
					data_type="all";
				}
				filter_driver_cards(driver_status,location_name,driver,cust_name_tel,data_type);
			});
			
			$('#driver').on('keyup', function(event) {
				var driver_status=document.getElementById("driver_status").value;
				var location_name=document.getElementById("location_name").value;
				var driver=document.getElementById("driver").value;
				var cust_name_tel=document.getElementById("cust_name_tel").value;
				var data_type="no_filter";
				if(driver_status==-1 && location_name=="" && driver=="")
				{
					data_type="all";
				}
				filter_driver_cards(driver_status,location_name,driver,cust_name_tel,data_type);

			});
			
			//Filter for order table
			$('.filter_data_order').on('change', function(event) {
				var order_type=document.getElementById("order_type").value;
				var order_status=document.getElementById("order_status").value;
				var from_date=document.getElementById("from").value;
				var to_date=document.getElementById("to").value;
				var cust_name=document.getElementById("cust_name").value;
				var datetype=2;
				if(order_type=="" && order_status=="" && from_date=="" && to_date=="" && cust_name=="")
				{
					datetype=1;
				}
				filter_drivers(datetype,order_type,from_date,to_date,cust_name,order_status);
			});
			
			$('#cust_name').on('keyup', function(event) {
				//var driver_status=document.getElementById("driver_status").value;
				var order_type=document.getElementById("order_type").value;
				var order_status=document.getElementById("order_status").value;
				//var location_name=document.getElementById("location_name").value;
				//var driver=document.getElementById("driver").value;
				var from_date=document.getElementById("from").value;
				var to_date=document.getElementById("to").value;
				var cust_name=document.getElementById("cust_name").value;
				var datetype=2;
				if(order_type=="" && order_status=="" && from_date=="" && to_date=="" && cust_name=="")
				{
					datetype=1;
				}
				filter_drivers(datetype,order_type,from_date,to_date,cust_name,order_status);

			});
	  });
	  
	   
	  function filter_driver_cards(driver_status,location_name,driver,cust_name_tel,data_type){
		var dataString = 'driver_status='+ driver_status+'&location_name='+location_name+'&driver='+driver+'&cust_name_tel='+cust_name_tel+'&data_type='+data_type;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Dispatch/filter_driver",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				demo.initGoogleMaps();
				var markers1 = [{lat: 30.7046, lng: 76.7179},{lat: 30.7333, lng: 76.7794}];

				var map = new google.maps.Map(document.getElementById('map'), {
				  zoom: 8,
				  center: markers1[0]
				});
				var drivers_data = document.getElementById("drivers_data");
				drivers_data.innerHTML = "";
				
				var obj = JSON.parse(response);
				$.each(obj, function(key,val){
					if(key=="driver_listing")
					{
						document.getElementById('drivers_data').style.display = "block";
						var drivers;
						$.each(val, function(k,v){
							var contentString = '<div id="content">'+
									'<div id="siteNotice">'+
									'</div>'+
									'<div id="bodyContent">'+
									'<p><img src="http://35.162.151.221/profile_pics/'+v.profile_pic+'" height="22" width="22" style="border-radius:50%"> <b>'+decodeURIComponent(v.name)+'</b></p>'+
									'</div>'+
									'</div>';

							var infowindow = new google.maps.InfoWindow({
							  content: contentString
							});
							if(v.driver_status==0){
								drivers="Offline";
								var image = 'http://35.162.151.221/dashboard/assets/img/gray.png';
							}
							if(v.driver_status==1){
								drivers="Available";
								var image = 'http://35.162.151.221/dashboard/assets/img/green.png';
							}
							if(v.driver_status==2){
								drivers="In Progress";
								var image = 'http://35.162.151.221/dashboard/assets/img/blue.png';
							}
							if(v.driver_status==3){
								drivers="Busy";
								var image = 'http://35.162.151.221/dashboard/assets/img/red.png';
							}
							var marker = new google.maps.Marker({
								  position: {lat:parseFloat(v.lat),lng: parseFloat(v.lng)},
								  map: map,
								  icon: image
							});
							marker.addListener('click', function() {
							  infowindow.open(map, marker);
							});
							if(v.order_status=="avialable")
							{
								drivers_data.innerHTML+='<div class="card" onclick=displayAvialablePath(\"'+encodeURIComponent(v.profile_pic)+'\",\"'+encodeURIComponent(v.name)+'\",\"'+v.lat+'\",\"'+v.lng+'\")><div class="content"><div class="row"><div class="col-xs-5"><div class="icon-danger text-center"><img src="http://35.162.151.221/profile_pics/'+v.profile_pic+'" height="42" width="42" style="border-radius:50%"></div></div><div class="col-xs-7"><div class="numbers"><p>'+drivers+'</p><p>'+v.name+'</p><p>'+v.driver_phone+'</p></div></div></div></div></div>'; 
							}else if(v.order_status=="offline")	{
								drivers_data.innerHTML+='<div class="card"><div class="content"><div class="row"><div class="col-xs-5"><div class="icon-danger text-center"><img src="http://35.162.151.221/profile_pics/'+v.profile_pic+'" height="42" width="42" style="border-radius:50%"></div></div><div class="col-xs-7"><div class="numbers"><p>'+drivers+'</p><p>'+v.name+'</p><p>'+v.driver_phone+'</p></div></div></div></div></div>';  
							}else if(v.order_status=="progress")	{
								drivers_data.innerHTML+='<div class="card" onclick=displayPath(\"'+encodeURIComponent(drivers)+'\",\"'+encodeURIComponent(v.profile_pic)+'\",\"'+encodeURIComponent(v.mobile)+'\",\"'+encodeURIComponent(v.name)+'\",\"'+encodeURIComponent(v.customer_name)+'\",\"'+v.lat+'\",\"'+v.lng+'\",\"'+encodeURIComponent(v.pickup_location)+'\",\"'+encodeURIComponent(v.drop_location)+'\")><div class="content"><div class="row"><div class="col-xs-5"><div class="icon-danger text-center"><img src="http://35.162.151.221/profile_pics/'+v.profile_pic+'" height="42" width="42" style="border-radius:50%"></div></div><div class="col-xs-7"><div class="numbers"><p>'+drivers+'</p><p>'+v.name+'</p><p>'+v.driver_phone+'</p></div></div></div><div class="footer"><hr /><div class="stats text-color strong-font arrow-align"><p>'+v.customer_name+'</p><i class="fa fa-angle-double-down" id="down_angle_'+v.id+'" onclick="divExpand('+v.id+')"></i><p id="duration_'+v.id+'" class="align-right"></p><div id="collapseExample'+v.id+'" style="display:none"><p>'+v.mobile+'</p><p>Pickup Location - '+v.pickup_location+'</p><p>Drop Location - '+v.drop_location+'</p><div class="align-center"><i class="fa fa-angle-double-up" onclick="divCollapse('+v.id+')"></i></div> </div></div></div></div></div>'; 
								//~ setTimeout(function(){
									var lat_lng = decodeURIComponent(v.lat)+','+decodeURIComponent(v.lng);
									$.ajax({
										type: "POST",
										url: "http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat_lng+"&sensor=true",
										cache: false,
										success: function(response)
										{     
											var source=response.results[0].formatted_address;
											var destination=decodeURIComponent(v.pickup_location);
											var service = new google.maps.DistanceMatrixService();
											service.getDistanceMatrix({origins: [source],destinations: [destination],travelMode: google.maps.TravelMode.DRIVING,unitSystem: google.maps.UnitSystem.METRIC,avoidHighways: false,avoidTolls: false},
													function (response, status) 
													{
														if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") 
														{
															var duration = response.rows[0].elements[0].duration.text;
															//alert(duration);
															var distance_id="duration_"+v.id;
															document.getElementById(distance_id).innerHTML=duration;
														} 
													   else 
														{
															//alert("Invalid Lat/Long");
														}
													}			
											);
											
										}
									});
								//~ },2000);
								
							}else if(v.order_status=="busy")	{
								//calculateDistance("\"'+v.lat+'\",\"'+v.lng+'\",\"'+encodeURIComponent(v.pickup_location)+'\",\"'+encodeURIComponent(v.drop_location)+'\");
								drivers_data.innerHTML+='<div class="card" onclick=displayPath(\"'+encodeURIComponent(drivers)+'\",\"'+encodeURIComponent(v.profile_pic)+'\",\"'+encodeURIComponent(v.mobile)+'\",\"'+encodeURIComponent(v.name)+'\",\"'+encodeURIComponent(v.customer_name)+'\",\"'+v.lat+'\",\"'+v.lng+'\",\"'+encodeURIComponent(v.pickup_location)+'\",\"'+encodeURIComponent(v.drop_location)+'\")><div class="content"><div class="row"><div class="col-xs-5"><div class="icon-danger text-center"><img src="http://35.162.151.221/profile_pics/'+v.profile_pic+'" height="42" width="42" style="border-radius:50%"></div></div><div class="col-xs-7"><div class="numbers"><p>'+drivers+'</p><p>'+v.name+'</p><p>'+v.driver_phone+'</p></div></div></div><div class="footer"><hr /><div class="stats text-color strong-font"><p>'+v.customer_name+'</p><i class="fa fa-angle-double-down" id="down_angle_'+v.id+'" onclick="divExpand('+v.id+')"></i><div id="collapseExample'+v.id+'" style="display:none"><p>'+v.mobile+'</p><p>Pickup Location - '+v.pickup_location+'</p><p>Drop Location - '+v.drop_location+'</p><div class="align-center"><i class="fa fa-angle-double-up" onclick="divCollapse('+v.id+')"></i></div> </div></div></div></div></div>'; 
							}
							
						});
					}
				}); 
			}
		});
	  }
			
	  function calculateDistance(lat,lng,pickup_location){
				alert(lat);
				alert(lng);
				alert(pickup_location);
	  }
	  
	  function clear_drivers()
	  {
			document.getElementById('driver_status').value='-1';
			document.getElementById('location_name').value='';
			document.getElementById('driver').value='';
			document.getElementById('cust_name_tel').value='';
			var data_type="all";
			filter_driver_cards('','','','',data_type);
	  }
		
		//~ filter_drivers(datetype,order_type,from_date,to_date,cust_name,order_status);
	  function filter_drivers(datetime_type,order_type,from_date,to_date,cust_name,order_status){
		var dataString = 'order_type='+order_type+'&from_date='+from_date+'&to_date='+to_date+'&cust_name='+cust_name+'&order_status='+order_status;
		$('#table').DataTable({ 
				"bDestroy": true,
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control server-side processing mode.
				"order": [], //Initial no order.
				"bSort" : false,
				"bPaginate": true,
				"bLengthChange": true,
				"bInfo": false,
				"lengthMenu": [[10, 15, -1], [10, 15, "All"]],
				
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo base_url();?>Dispatch/order_list",
					"type": "POST",
					"data": {
						"datetime_type": datetime_type,
						"order_type": order_type,
						"order_status": order_status,
						"from_date": from_date,
						"to_date": to_date,
						"cust_name": cust_name,
					}
					
				},
		 
				//Set column definition initialisation properties.
				"columnDefs": [
					{ 
						"targets": [  ], //first column / numbering column
						"orderable": false, //set not orderable
					},
					],
			
		});
	}
	
	function cancelUpdateCorp(){
		window.location.href = "<?php echo base_url();?>Corp";
	}
	
	function cancel_driver(){
		window.location.href = "<?php echo base_url();?>Driver";
	}
	
	function cancelPromos(){
		window.location.href = "<?php echo base_url();?>Promo";
	}
	
</script>
</body>
</html>
