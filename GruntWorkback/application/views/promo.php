<?php $Result = $this->Rating_model->get_borrower_rating();?>

   <div class="row">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
										<th>ID</th>
                                    	<th>Borrower ID</th>
                                    	<th>Rating</th>
                                    </thead>
                                    <tbody>
                                        <tr>
											<?php foreach($Result as $rating): ?>
											<td><?php echo $rating['id']; ?></td>
                                        	<td><?php echo $rating['borrower_id']; ?></td>
                                        	<td><?php echo $rating['rating']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

            </div></div>
        </div>
        </div>
