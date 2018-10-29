 <!--   Core JS Files   -->
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>
<script>
	$('.form-signin').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  if (keyCode === 13) { 
		e.preventDefault();
		return false;
	  }
	});  
	
	
	
	function login()
	{
		var username = document.getElementById("username").value;
		if(username==""){
			alert("Enter username");
			return;
		}
		var password = document.getElementById("password").value;
		if(password==""){
			alert("Enter password");
			return;
		}
		
		var dataString = 'username='+username+'&password='+password;
		$.ajax({
			type: "POST",
			url: "http://traala.com/GruntWorkback/Login/user_login",
			data: dataString,
			cache: false,
			success: function(response)
			{     
				//alert(response);
				if( response == "[]" ) 
				{
					alert("Invalid Username/Password");
				}
				else
				{
					window.location.href = "http://traala.com/GruntWorkback/dashboard";
					
				}
				
			}
		});
	} 
</script> 
</body>
</html>
