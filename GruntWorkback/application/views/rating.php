<?php $Result = $this->Rating_model->get_rating();?>
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
                                    	<th>User ID</th>
                                    	<th>Borrower Rating</th>
                                    	<th>Lender Rating</th>
                                    	<th>Feedback</th>
                                    </thead>
                                    <tbody>
                                        <tr>
											<?php foreach($Result as $rating): ?>
                                        	<td><?php echo $rating['user_id']; ?></td>
                                        	<td><?php echo $rating['borrower_rating']; ?></td>
                                        	<td><?php echo $rating['lender_rating']; ?></td>
                                        	<td><?php echo $rating['feedback']; ?></td>
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
