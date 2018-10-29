

<?php
  $job_id = $this->uri->segment(3);
  $result = $this->CompletedJobs_model->job_detail($job_id);
 //print_r($result);exit;
?>

<div class="content-wrapper" style="min-height: 760px;">
   
    <section class="content-header">
		<div class="col-md-6">
			<div class="content-header">                         
				<h2>Completed Job Detail</h2>
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
                          <b>Employer Name</b>
                        </td>
                        <td>
                          <?php echo $result[0]['employer_name'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Job Title</b>
                        </td>
                        <td>
                          <?php echo $result[0]['job_title'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Description</b>
                        </td>
                        <td>
                          <?php echo $result[0]['description'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Job Type</b>
                        </td>
                        <td>
                          <?php echo $result[0]['job_type'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Job Duration</b>
                        </td>
                        <td>
                          <?php echo $result[0]['duration'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Est Amount</b>
                        </td>
                        <td>
                          <?php echo $result[0]['est_amount'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Datetime</b>
                        </td>
                        <td>
                          <?php echo $result[0]['datetime'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Location</b>
                        </td>
                        <td>
                          <?php echo $result[0]['location'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>Success Rate</b>
                        </td>
                        <td>
                          <?php echo $result[0]['success_rate'];?>  
                        </td>
                      </tr>  
                     
                      <tr>
                        <td>
                          <b>Rating</b>
                        </td>
                        <td>
                          <?php echo $result[0]['rating'];?>  
                        </td>
                      </tr>  
                     <tr>
                        <td>
                          <b>Status</b>
                        </td>
                        <td>
                          <?php 
                          if ($result[0]['status']=='3')
                          {
							  echo 'Completed';
							  
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
