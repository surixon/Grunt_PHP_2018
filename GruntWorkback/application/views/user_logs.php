<?php $Result = $this->UserLog_model->get_logs();?>
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="row">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">User Logs</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
                                    	<th>SR.NO.</th>
                                    	<th>TRANSACTION ID</th>
                                    	<th>TRANSACTION AMOUNT</th>
                                    	<th>TRANSACTION DATE</th>
                                    	<th>TOTAL LENDING</th>
                                    	<th>TOTAL BORROWING</th>
                                    </thead>
                                    <tbody>
                                        <tr>
											<?php foreach($Result as $logs): ?>
                                        	<td><?php echo $logs['id']; ?></td>
                                        	<td><?php echo $logs['transaction_id']; ?></td>
                                        	<td><?php echo $logs['transaction_amount']; ?></td>
                                        	<td><?php echo $logs['transaction_date']; ?></td>
                                        	<td><?php echo $logs['total_lending']; ?></td>
                                        	<td><?php echo $logs['total_borrowing']; ?></td>
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
