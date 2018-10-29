
<?php
  $transaction_id = $this->uri->segment(3);
  $result = $this->Transaction_history_model->transaction_detail($transaction_id);
 //print_r($result);exit;
?>

<div class="content-wrapper" style="min-height: 760px;">
   
    <section class="content-header">
		<div class="col-md-6">
			<div class="content-header">                         
				<h2>Transaction Details</h2>
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
                  <table class="table no-margin table-bordered" id="dataTables">
                    <tbody>
                    
                      <tr>
                        <td>
                          <b>TRANSACTION ID</b>
                        </td>
                        <td>
                          <?php echo $result[0]['transaction_id'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>EMPLOYER ID</b>
                        </td>
                        <td>
                          <?php echo $result[0]['employer_id'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>EMPLOYEE ID</b>
                        </td>
                        <td>
                          <?php echo $result[0]['employee_id'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>JOB ID</b>
                        </td>
                        <td>
                          <?php echo $result[0]['job_id'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>PAYMENT METHOD</b>
                        </td>
                        <td>
                          <?php echo $result[0]['payment_method'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>AMOUNT</b>
                        </td>
                        <td>
                          <?php echo $result[0]['amount'];?>  
                        </td>
                      </tr>  
                      <tr>
                        <td>
                          <b>STATUS</b>
                        </td>
                        <td>
                          <?php echo $result[0]['status'];?>  
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
