
<?php $Result = $this->Transaction_history_model->get_logs();?>
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="row">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Log Users</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="dataTables">
                                    <thead>
										<th>SR NO.</th>
										<th>TRANSACTION ID</th>
                                    	<th>EMPLOYER ID</th>
                                    	<th>EMPLOYEE ID</th>
                                    	<th>JOB ID</th>
                                    	<th>PAYMENT METHOD</th>
                                    	<th>AMOUNT</th>
                                    	<th>STATUS</th>
                                    	<th>ACTION</th>
                                    	
                                    </thead>
                                    <tbody>
                                        <tr>

											<?php foreach($Result as $users): ?>

											<td><?php echo $users['id']; ?></td>
											<td><?php echo $users['transaction_id']; ?></td>
                                        	<td><?php echo $users['employer_id']; ?></td>
                                        	<td><?php echo $users['employee_id']; ?></td>
                                        	<td><?php echo $users['job_id']; ?></td>
                                        	<td><?php echo $users['payment_method']; ?></td>
                                        	<td><?php echo $users['amount']; ?></td>
                                        	<?php if ($users['status'] == '1')
								                  {
								            ?>
								                    <td><p><?php echo 'Success'; ?></p></td>
								            <?php 
							                      }
							                      else if ($users['status'] == '2')
							                      {
								            ?>							 
							                        <td><p><?php echo 'Failure'; ?></p></td>
								            <?php
							                      }
                                            ?> 
                                            <td>
											<a href="<?php echo base_url('Transaction_history/transaction_detail/' . $users['transaction_id']) ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
											</td>   	
                                         </tr>

                                        <?php endforeach; ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
