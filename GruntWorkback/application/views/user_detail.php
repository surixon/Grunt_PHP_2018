
<?php
  $user_id = $this->uri->segment(3);
  $result = $this->Users_model->user_detail($user_id);
 //print_r($result);exit;
?>

<div class="content-wrapper" style="min-height: 760px;">
   
    <section class="content-header">
		<div class="col-md-6">
			<div class="content-header">                         
				<h2>User Detail</h2>
			</div>
        </div>
		<div class="col-md-6">
			<div class="three_btton_sec">
				
			</div>
		</div>
    </section>
    
 <div class="container-fluid">
  <div class="col-md-12 form_section">
    <section class="content" id="user-view">        
      <div class="row">                                                                                                                                                                                                
        <div class="col-md-12">
          <div class="main-strut">
            <div class="inner clearfix">
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin table-bordered">
                    <tbody>
                    
                      <tr>
                        <td>
                          <b>FullName</b>
                        </td>
                        <td>
                          <?php echo $result[0]['fullname'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Contact</b>
                        </td>
                        <td>
                          <?php echo $result[0]['contact_no'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Email</b>
                        </td>
                        <td>
                          <?php echo $result[0]['email'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Profile Picture</b>
                        </td>
                        <td>
                          <img src ="<?php echo isset($result[0]['profile_pic']) && ($result[0]['profile_pic']) ? base_url() . 'assets/img/image/' . $result[0]['profile_pic']:'';?>"  width="50px" height = "50px">
                        </td>
                      </tr>   
                      <tr>
                        <td>
                          <b>Gender</b>
                        </td>
                        <td>
                          <?php echo $result[0]['gender'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>D.O.B</b>
                        </td>
                        <td>
                          <?php echo $result[0]['dob'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Country</b>
                        </td>
                        <td>
                          <?php echo $result[0]['country'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>User Type</b>
                        </td>
                        <td>
                          <?php  if($result[0]['user_type']=='1')
                                     {
										 echo 'Employer';
										 }
                                     else
                                     {
										 echo 'Employee';
										 }
										 ?>  
                        </td>
                      </tr>      
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
  
   
   <div class="back col-md-2">
    <a id="back" class="btn btn-lg btn-primary btn-block" href="javascript:window.history.go(-1);">Back</a>
   </div>
</div>
</div>
