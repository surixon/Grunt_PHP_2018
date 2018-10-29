<html>
<body>
<form name="update_form" action="<?php base_url(); ?>update" method="POST">
		<fieldset style="width:232px;" >
			<legend>Promotion Details</legend>
			<table border="1" cellpadding="2" cellspacing="1" >
				<tr>
					<td>ID:</td>
					<td><input style="background-color:#eee;" type="text" name="id" value="<?php echo $id; ?>" readonly /></td>
				</tr>
				<tr>
					<td>Promotion Name:</td>
					<td><input type="text" name="promotion_name" value="<?php echo $promotion_name; ?>" /></td>
				</tr>
<!--
				<tr>				
					<td>Discount:</td>
					<td><input type="text" name="discount" value="<?php echo $discount; ?>" /></td>
				</tr>	
-->
<!--
				<tr>	
					<td>Expiration:</td>
					<td><input type="text" name="expiration" value="<?php echo $expiration; ?>" /></td>
				</tr>
-->
				<tr>
					<td>Promotion Code:</td>
					<td><input type="text" name="promotion_code" value="<?php echo $promotion_code; ?>" /></td>
				</tr>	
				<tr>
					<td colspan="2" ><a href="<?php base_url(); ?>promotion_register"><button style="width:50%;" type="button">Cancel</button></a><input style="width:50%;" type="submit" value="submit" /></td>
				</tr>	
			</table>
		</fieldset>
	</form>
</body>
</html>	
