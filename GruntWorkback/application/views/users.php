
<?php
 $user_id = $this->uri->segment(3);
 $Result = $this->Users_model->get_users();?>

<div class="container-fluid">
  <div class="col-md-12 form_section">
    <div class="row">
      <div class="card">
        <div class="header">
          <h4 class="title">Register Users</h4>
          <p class="category"></p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped" id="dataTables">
            <thead>
            <th>User ID</th>
              <th>Fullname</th>
              <th>IMAGE</th>
              <th>Email</th>
              <th>DOB</th>
              <th>COUNTRY</th>
              <th>USER TYPE</th>
              <th>User Status</th>
              <th>ACTION</th>
                </thead>
            <tbody>
              <tr>
                <?php if(!empty($Result)){ foreach($Result as $users):
					         $status = $users['user_status'];
                                            if($status==1) 
                                            { 
												$showStatus = 'Block';
											}
                                           else
                                           {
											   $showStatus = 'Unblock';
										   }
					 ?>
                <td><?php echo $users['user_id']; ?></td>
                <td><?php echo $users['fullname']; ?></td>
                 <td><img style="height: 100px;width: 100px;" src ="<?php echo base_url() . '../profile_pics/' . $users['profile_pic']?>"></td>
                
                
                <td><?php echo $users['email']; ?></td>
                <td><?php echo $users['dob']; ?></td>
                <td><?php echo $users['country']; ?></td>
                <td>
                <?php if ($users['user_type'] == '1')
					  {
			    ?>
					<?php echo 'Employer'; ?>
				<?php 
					  }
					  else if ($users['user_type'] == '2')
					  {
				?>							 
					<?php echo 'Employee'; ?>
				<?php
					  }
                ?> 
                </td> 
                <td><?php echo $showStatus; ?>
                                        	<?php  if($users['user_status'] == '0') { ?>
                              <button title="Unblock" class="btn btn-danger" data-toggle="modal" data-target="#blockModal" 
                              id="user-<?php echo $users['user_id']; ?>,<?php echo $users['user_status']; ?>"  
                              value="<?php echo $users['user_status']; ?>" >
                              <i id="block-btn-<?php echo $users['user_id']; ?>">Block</i></button>
                                                            
                              <?php } else { ?>
                              <button title="Block"  data-toggle="modal" data-target="#blockModal" class="btn btn-success" 
                              id="user-<?php echo $users['user_id']; ?>,<?php echo $users['user_status']; ?>" 
                               value="<?php echo $users['user_status']; ?>" >
                               <i id="block-btn-<?php echo $users['user_id']; ?>">Unblock</i></button>
                              <?php } ?>
                              </td>  	
                <td><a href="<?php base_url();?>Users/edit_Users/<?php echo $users['user_id']; ?>" class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="<?php echo base_url('Users/user_detail/' . $users['user_id']) ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                 <a onclick="userDelete(<?php echo $users['user_id']; ?>)" ><i class="fa fa-scissors" aria-hidden="true"></i></a>
                 </td>
              </tr>
              <?php endforeach; }else{  ?>
				  <tr><td colspan="6"> No result found </td></tr>
				 <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
