<?php $Result = $this->Transaction_history_model->get_history();?>
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="row">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Borrower Rating</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
										<th>SR.NO.</th>
                                    	<th>LENDER ID</th>
                                    	<th>BORROWER ID</th>
                                    	<th>TRANSACTION AMOUNT</th>
                                    	<th>TRANSACTION TYPE</th>
                                    	<th>TRANSACTION DATE</th>
                                    	<th>TRANSACTION TIME</th>
                                    	<th>PAYMENT METHOD</th>
                                    </thead>
                                    <tbody>
                                        <tr>
											<?php foreach($Result as $history): ?>
											<?php if($history['transaction_type']=='0')
											      {
													  $status='Debit';
												  }
												  else
												  {
													  $status='Credit';
												  }
												   
												  if($history['payment_method']=='0')
											      {
													  $status1='Cash';
												  }
												  else
												  {
													  $status1='Wallet Transfer';
												  } 
												  ?>   
													  
											<td><?php echo $history['id']; ?></td>
                                        	<td><?php echo $history['borrower_id']; ?></td>
                                        	<td><?php echo $history['lender_id']; ?></td>
                                        	<td><?php echo $history['transaction_amount']; ?></td>
                                        	<td><?php echo $status; ?></td>
                                        	<td><?php echo $history['transaction_date']; ?></td>
                                        	<td><?php echo $history['transaction_time']; ?></td>
                                        	<td><?php echo $status1; ?></td>
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
