<?php $Result = $this->CompletedJobs_model->get_jobs();?>
 <div class="row">
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="row">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Completed jobs</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="dataTables">
                                    <thead>
										<th>JOB ID</th>
                                    	<th>EMPLOYER NAME</th>
                                    	<th>JOB TITLE</th>
                                    	<th>LOCATION</th>
                                    	<th>BONUS</th>
                                    	<th>RATING</th>
                                    	<th>ACTION</th>
                                    </thead>
                                    <tbody>
                                        

											<?php foreach($Result as $users): ?>
                                           <tr>
											<td><?php echo $users['job_id']; ?></td>
                                        	<td><?php echo $users['employer_name']; ?></td>
                                        	<td><?php echo $users['job_title']; ?></td>
                                        	<td><?php echo $users['location']; ?></td>
                                        	<td><?php echo $users['bonus']; ?></td>
                                        	<td><?php echo $users['rating']; ?></td>
                                        	<td>
<!--
											<a href="<?php echo base_url('Job_details/edit_job/' . $users['job_id']) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
-->
											<a href="<?php echo base_url('CompletedJobs/completedjob_detail/' . $users['job_id']) ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
<!--
											<a onclick="deleteJob(<?php echo $users['job_id']; ?>)" ><i class="fa fa-scissors" aria-hidden="true"></i></a>
-->
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
