<?php $Transaction = $this->Dashboard_model->get_transaction();?>
<?php $Users = $this->Dashboard_model->get_users();?>
<?php $Orders = $this->Dashboard_model->cancel_orders();?>
<?php $Commission = $this->Dashboard_model->get_adminCommission();?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card dashboard-stat2 red">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Total No. Of Users</p>
                                            <i class="fa fa-user"></i>
                                            <div id="users_content" class="users_content"><?php echo $Users[0]['id']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats text-color" id="ref_user">
                                         <i class="fa fa-refresh fa-x" id="reload_div" name="reload_div" onclick="refresh_main()"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card dashboard-stat2 green">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Total Transactions</p>
                                           <i class="fa fa-credit-card"></i> 
                                           <div id="total_transactions_content" class="total_transactions_content"><?php echo $Transaction[0]['id']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats text-color">
                                        <i class="fa fa-refresh fa-x" id="reload_div1" name="reload_div1" onclick="refresh_main()"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card dashboard-stat2 blue">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Admin Commission</p>
                                            $&nbsp;<?php echo $Commission[0]['commission']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats text-color">
                                        <i class="fa fa-refresh fa-x" id="reload_div" name="reload_div" onclick="refresh_main()"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
             <div class="portlet-form">
                <div class="row">
             
					<div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-12">
                                      <div>
                                       Total Users: 
                                       <div id="users" class="users"><?php echo $Users[0]['id']; ?>
                                       </div>
                                       </div>
                                       <div>
									   Total Transactions:
									   <div id="total_transactions" class="total_transactions"><?php echo $Transaction[0]['id']; ?>
                                       </div>
                                       </div>
                                       <div>
                                       Canceled Transactions:
                                       <div id="cancel_orders" class="cancel_orders"><?php echo $Orders[0]['id']; ?>
                                       </div>
                                       </div>
                                    </div>
                                   
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats text-color">
                                        <i class="fa fa-refresh fa-x" id="reload" name="reload" onclick="refresh_blog()"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--
                    <div id="main_content"></div>
-->
<!--
				<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="row">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Summary Table</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
										<th>Sr No.</th>
                                        <th>User Name</th>
                                    	<th>Total Lending Transaction</th>
                                    	<th>Total Borrowing Transaction</th>
                                    	<th>Last Transaction</th>
                                    	<th>Rating</th>
										
                                    </thead>
                                    <tbody>
                                        <tr>
											<td>1</td>
                                        	<td>Gourav</td>
                                        	<td>2</td>
                                        	<td>2</td>
                                        	<td>12-jan-2017</td>
                                        	<td>4.5</td>
											
                                        </tr>
                                        <tr>
											<td>2</td>
                                        	<td>Neeraj</td>
                                        	<td>3</td>
                                        	<td>2</td>
                                        	<td>12-June-2017</td>
                                        	<td>4</td>
                                        </tr>
								
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
-->
</div>

   

	
