 <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="#">
                               GRUNTWORK
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
                    &copy; GRUNTWORK
                </div>
            </div>
        </footer>
        </div>
</div>
        

    <!--   Core JS Files   -->
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/validation.js');?>" type="text/javascript"></script>
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
     
   
   <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
   <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
 
     
     
    <script>
		 $(document).ready(function() 
		{
		  $('#dataTables').DataTable();
		});
     </script> 
     
    <script>
		 $(document).ready(function() 
		{
		  $('#dataTables1').DataTable();
		});
     </script> 
    <script>
		 $(document).ready(function() 
		 {
		    $('#dataTables2').DataTable();
		});
     </script> 
     
     
<!--------------refresh cancel orders on dashboard -------------------->  
    <script>
    function refresh_blog()
    {
          $("#reload").click(function(){
            $.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Dashboard/cancel_orders_update",
			cache: false,
			success: function(response)
			{
				$('#cancel_orders').html(response);
				 
			}
       });
        
            
            $.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Dashboard/get_transaction_update",
			cache: false,
			success: function(response)
			{
				$('#total_transactions').html(response);
				 
			}
      });  
            
	 	    
            $.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Dashboard/get_users_update",
			cache: false,
			success: function(response)
			{
				$('#users').html(response);
				 
			}
       });
      });   
      
    }
    </script>
<!----------------------------END-------------------------------------->    
<script>

function refresh_main()
{
                    $("#reload_div").click(function(){
						$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>Dashboard/get_users_update",
						cache: false,
						success: function(response)
						{
							$('#users_content').html(response);
							 
						}
				   });
				  }); 
				        $("#reload_div1").click(function(){
							//~ alert('hi');
				        $.ajax({
						type: "POST",
						url: "<?php echo base_url();?>Dashboard/get_transaction_update",
						cache: false,
						success: function(response)
						{
							$('#total_transactions_content').html(response);
							 
						}
				   });       
		        }); 
}
</script>  
    
<!---END-->    
<script>
	
	function addUsers()
	{
	
		var fullname=document.getElementById("fullname").value;
		if(fullname=="")
		{
			document.getElementById("fullname").focus();
			alert("Please enter fullname");
			return;
		}
		
		
		var email=document.getElementById("email").value;
		if(email=="")
		{
			document.getElementById("email").focus();
			alert("Please enter email");
			return;
		}
		
		var password=document.getElementById("password").value;
		if(password=="")
		{
			document.getElementById("password").focus();
			alert("Please enter password");
			return;
		}
		
		//~ var profile_pic=document.getElementById("profile_pic").value;
		//~ if(profile_pic=="")
		//~ {
			//~ document.getElementById("profile_pic").focus();
			//~ alert("Please upload profile pic");
			//~ return;
		//~ }
		
		
		
		var dob=document.getElementById("dob").value;
		if(dob=="")
		{
			document.getElementById("dob").focus();
			alert("Please enter dob");
			return;
		}
		
		var country=document.getElementById("country").value;
		if(country=="")
		{
			document.getElementById("country").focus();
			alert("Please enter country");
			return;
		}
		
		var user_type=document.getElementById("user_type").value;
		if(user_type=="")
		{
			document.getElementById("user_type").focus();
			alert("Please enter user type");
			return;
		}
		
	    var dataString = 'fullname='+fullname+'&email='+email+'&password='+password+'&dob='+dob+'&country='+country+'&user_type='+user_type;
		
	}
</script>
 
<script>	
	
	function addjob()
	{
		var employer_name=document.getElementById("employer_name").value;
		if(employer_name=="")
		{
			document.getElementById("employer_name").focus();
			alert("Please enter employer name");
			return;
		}
		
		
		var job_title=document.getElementById("job_title").value;
		if(job_title=="")
		{
			document.getElementById("job_title").focus();
			alert("Please enter job title");
			return;
		}
		
		
		var description=document.getElementById("description").value;
		if(description=="")
		{
			document.getElementById("description").focus();
			alert("Please enter description");
			return;
		}
		
		var job_type=document.getElementById("job_type").value;
		if(job_type=="")
		{
			document.getElementById("job_type").focus();
			alert("Please enter job type");
			return;
		}
		
		var duration=document.getElementById("duration").value;
		if(duration=="")
		{
			document.getElementById("duration").focus();
			alert("Please enter duration");
			return;
		}
		
		var est_amount=document.getElementById("est_amount").value;
		if(est_amount=="")
		{
			document.getElementById("est_amount").focus();
			alert("Please enter est amount");
			return;
		}
		
		var datetime=document.getElementById("datetime").value;
		if(datetime=="")
		{
			document.getElementById("datetime").focus();
			alert("Please enter datetime");
			return;
		}
		var location=document.getElementById("location").value;
		if(location=="")
		{
			document.getElementById("location").focus();
			alert("Please enter location");
			return;
		}
		var success_rate=document.getElementById("success_rate").value;
		if(success_rate=="")
		{
			document.getElementById("success_rate").focus();
			alert("Please enter success rate");
			return;
		}
		var bonus=document.getElementById("bonus").value;
		if(bonus=="")
		{
			document.getElementById("bonus").focus();
			alert("Please enter datetime");
			return;
		}
		var rating=document.getElementById("rating").value;
		if(rating=="")
		{
			document.getElementById("rating").focus();
			alert("Please enter rating");
			return;
		}
		
		
		
	    var dataString = 'employer_name='+employer_name+'&job_title='+ job_title+'&description='+description+'&job_type='+job_type+'&duration='+duration+'&est_amount='+est_amount+'&datetime='+datetime+'&location='+location+'&success_rate='+success_rate+'&bonus='+bonus+'&rating='+rating;
		//alert(dataString);
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Job_details/job_register",
			data: dataString,
			cache: false,
			success: function(response)
			{
				    //alert(response);
					window.location.reload();
				 
			}
		});
	}
	//~ 
	
	
	
</script>


<script>	
	/*function updateUsers()
	{
	
		var fullname=document.getElementById("fullname").value;
		if(fullname=="")
		{
			document.getElementById("fullname").focus();
			alert("Please enter fullname");
			return;
		}
		
		var email=document.getElementById("email").value;
		if(email=="")
		{
			document.getElementById("email").focus();
			alert("Please enter email");
			return;
		}
		//~ 
		//~ var profile_pic=document.getElementById("profile_pic").value;
		//~ if(profile_pic=="")
		//~ {
			//~ document.getElementById("profile_pic").focus();
			//~ alert("Please upload profile pic");
			//~ return;
		//~ }
		
		
		var dob=document.getElementById("dob").value;
		if(dob=="")
		{
			document.getElementById("dob").focus();
			alert("Please enter dob");
			return;
		}
		
		var country=document.getElementById("country").value;
		if(country=="")
		{
			document.getElementById("country").focus();
			alert("Please enter country");
			return;
		}
		
		var user_id=document.getElementById("user_id").value;
		
		
	    var dataString = 'fullname='+fullname+'&email='+email+'&dob='+dob+'&country='+country+'&user_id='+user_id;
		/*$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Users/updateUser/",
			data: dataString,
			cache: false,
			success: function(response)
			{
				    //alert(response);
					window.location.href = "<?php echo base_url();?>Users";
				 
			}
		});
	}*/
	
	function userDelete(user_id)
	{
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'user_id='+ user_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Users/userDelete",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Users";
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
	function cancelUsers()
	{
		window.location.href = "<?php echo base_url();?>Users";
	}
	
	
</script>

<script>	
	function updateJob()
	{
		var employer_name=document.getElementById("employer_name").value;
		if(employer_name=="")
		{
			document.getElementById("employer_name").focus();
			alert("Please enter employer name");
			return;
		}
		
		
		var job_title=document.getElementById("job_title").value;
		if(job_title=="")
		{
			document.getElementById("job_title").focus();
			alert("Please enter job title");
			return;
		}
		
		
		var description=document.getElementById("description").value;
		if(description=="")
		{
			document.getElementById("description").focus();
			alert("Please enter description");
			return;
		}
		
		var job_type=document.getElementById("job_type").value;
		if(job_type=="")
		{
			document.getElementById("job_type").focus();
			alert("Please enter job type");
			return;
		}
		
		var duration=document.getElementById("duration").value;
		if(duration=="")
		{
			document.getElementById("duration").focus();
			alert("Please enter duration");
			return;
		}
		
		var est_amount=document.getElementById("est_amount").value;
		if(est_amount=="")
		{
			document.getElementById("est_amount").focus();
			alert("Please enter est amount");
			return;
		}
		
		var datetime=document.getElementById("datetime").value;
		if(datetime=="")
		{
			document.getElementById("datetime").focus();
			alert("Please enter datetime");
			return;
		}
		var location=document.getElementById("location").value;
		if(location=="")
		{
			document.getElementById("location").focus();
			alert("Please enter location");
			return;
		}
		var success_rate=document.getElementById("success_rate").value;
		if(success_rate=="")
		{
			document.getElementById("success_rate").focus();
			alert("Please enter success rate");
			return;
		}
		var bonus=document.getElementById("bonus").value;
		if(bonus=="")
		{
			document.getElementById("bonus").focus();
			alert("Please enter datetime");
			return;
		}
		var rating=document.getElementById("rating").value;
		if(rating=="")
		{
			document.getElementById("rating").focus();
			alert("Please enter rating");
			return;
		}
		var job_id = document.getElementById("job_id").value;
		//alert(job_id);
	    var dataString = 'employer_name='+employer_name+'&job_id='+job_id+'&job_title='+ job_title+'&description='+description+'&job_type='+job_type+'&duration='+duration+'&est_amount='+est_amount+'&datetime='+datetime+'&location='+location+'&success_rate='+success_rate+'&bonus='+bonus+'&rating='+rating;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Job_details/updateJob/",
			data: dataString,
			cache: false,
			success: function(response)
			{
				    //alert(response);
					window.location.href = "<?php echo base_url();?>Job_details";
				 
			}
		});
	}
	
	
	function deleteJob(job_id)
	{
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'job_id='+ job_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Job_details/deleteJob",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Job_details/";
					}else{
						alert(msg);
					} 
				}
			});
		    return true;
		}
	    else
	    {
			return false;
		}
		
	}
	
	
	function cancelJob()
	{
		window.location.href = "<?php echo base_url();?>Job_details";
	}
	
	
</script>

<script>	
	function updateProducts()
	{
		var category_id=document.getElementById("category_id").value;
		if(category_id=="")
		{
			document.getElementById("category_id").focus();
			alert("Please enter category id");
			return;
		}
		
		var product_name=document.getElementById("product_name").value;
		if(product_name=="")
		{
			document.getElementById("product_name").focus();
			alert("Please enter product name");
			return;
		}
		
		var product_cashback=document.getElementById("product_cashback").value;
		if(product_cashback=='')
		{
			document.getElementById("product_cashback").focus();
			alert("Please enter product cashback");
			return;	
		}
		
		var product_description=document.getElementById("product_description").value;
		if(product_description=='')
		{
			document.getElementById("product_description").focus();
			alert("Please enter product description");
			return;	
		}
		
		
		var product_id=document.getElementById("product_id").value;
		
		var dataString = 'category_id='+category_id+'&product_name='+product_name+'&product_cashback='+product_cashback+'&product_description='+product_description+'&product_id='+product_id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Products/updateProduct",
			data: dataString,
			cache: false,
			success: function(data)
			{     
					alert('Product Updated Successfully');
					window.location.href = "<?php echo base_url();?>Products";
			}
		});
	}

	function productDelete(product_id)
	{
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'product_id='+ product_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Products/productDelete",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Products";
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
	function cancelProduct()
	{
		window.location.href = "<?php echo base_url();?>Products";
	}
	
</script>

<script>	
	function updateStores()
	{
		var store_name=document.getElementById("store_name").value;
		if(store_name=="")
		{
			document.getElementById("store_name").focus();
			alert("Please enter store name");
			return;
		}
		
		var store_location=document.getElementById("store_location").value;
		if(store_location=='')
		{
			document.getElementById("store_location").focus();
			alert("Please enter store location");
			return;	
		}
		
		var store_manager=document.getElementById("store_manager").value;
		if(store_manager=='')
		{
			document.getElementById("store_manager").focus();
			alert("Please enter store manager name");
			return;	
		}
		
		
		var store_id=document.getElementById("store_id").value;
		
		var dataString = 'store_name='+store_name+'&store_location='+store_location+'&store_manager='+store_manager+'&store_id='+store_id;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Stores/updateStore",
			data: dataString,
			cache: false,
			success: function(data)
			{     
					alert('Store Updated Successfully');
					window.location.href = "<?php echo base_url();?>Stores";
			}
		});
	}

	function storeDelete(store_id)
	{
		var x = confirm("Are you sure you want to delete?");
	    if (x)
	    {
			var dataString = 'store_id='+ store_id;
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>Stores/storeDelete",
				data: dataString,
				cache: false,
				success: function(response)
				{     
					var obj = JSON.parse(response);
					var id = obj.id;
					var msg = obj.message;
					if(id == "1"){
						alert(msg);
						window.location.href = "<?php echo base_url();?>Stores";
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
	function cancelStore()
	{
		window.location.href = "<?php echo base_url();?>Stores";
	}
	
</script>


<script type="text/javascript">
    $(document).on("click","[id ^='user-']",function(e){   
 	var userId  = $(this).attr('id');
    var blockArr = userId.split('-');  
    var blockArrsss = blockArr[1].split(',');
 
    if(blockArrsss[1] == '1') {
      var type = '0'; 
    }
    else {
      var type = '1';
    }
    
    $.ajax({
      type: "POST",
      async: false,
      url: "<?php echo base_url();?>Users/user_block",
      data: {'type':type,'blockID':blockArrsss[0]},
      dataType: 'json',
      success: function(result) {
              
        if(result.error == 1) {
        	location.reload();
           //window.location.href = "<?php echo base_url();?>Users";
        }
        else if(result.error == 0){
        	location.reload();
          //window.location.href = "<?php echo base_url();?>Users";
        }
        else{
          alert('Sorry, unknown error occurred.');
        }
      }
    });
  }); 

 </script>














</body>
</html>
