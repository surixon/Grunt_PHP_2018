<html>
<body>
<form name="update_form" action="<?php base_url(); ?>update" method="POST">
<input style="background-color:#eee;" type="hidden" name="company_id" value="<?php echo $company_id; ?>" />
		<fieldset style="width:232px;" >
			<legend>Update Company Details:</legend>
			<table border="1" cellpadding="2" cellspacing="1" >
				
				<tr>
					<td>Location Name:</td>
					<td><input type="text" name="location_name" value="<?php echo $location_name; ?>" /></td>
				</tr>

				<tr>				
					<td>Address:</td>
					<td><input type="text" name="address" value="<?php echo $address; ?>" /></td>
				</tr>	


				<tr>	
					<td>City:</td>
					<td><input type="city" name="city" value="<?php echo $city; ?>" /></td>
				</tr>

				<tr>
					<td>State:</td>
					<td><input type="state" name="state" value="<?php echo $state; ?>" /></td>
				</tr>
				<tr>
					<td>Zip:</td>
					<td><input type="zip" name="zip" value="<?php echo $zip; ?>" /></td>
				</tr>	
				
				<tr>
					<td>Tel:</td>
					<td><input type="text" name="telephone" value="<?php echo $telephone; ?>" /></td>
				</tr>
				<tr>
					<td>Manager Name:</td>
					<td><input type="text" name="manager_name" value="<?php echo $manager_name; ?>" /></td>
				</tr>	
				
				<tr>
					<td colspan="2" ><a href="<?php base_url(); ?>company"><button style="width:50%;" type="button">Cancel</button></a><input style="width:50%;" type="submit" value="submit" /></td>
				</tr>	
			</table>
		</fieldset>
	</form>
</body>
</html>	
