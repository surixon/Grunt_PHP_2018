<?php $Result = $this->Payment_model->get_payment();?>
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="row">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Payment Method</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
                                    	<th>SR.NO.</th>
                                    	<th>PAYMENT TYPE</th>
                           
                                    </thead>
                                    <tbody>
                                        <tr>
											<?php foreach($Result as $payment): ?>
                                        	<td><?php echo $payment['id']; ?></td>
                                        	<td><?php echo $payment['payment_type']; ?></td>
                                 
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
