<?php $result = $this->Job_details_model->get_jobs();
$id = $this->uri->segment(3);
//print_r($result); exit;
?>
<div class="container-fluid">
  <div class="col-md-12 form_section">
    <div class="row">
      <div class="content">
        <div class="col-md-12">
          <div class="col-md-4">
            <?php 
            $fattr = array('class' => 'form-signin');
            echo form_open('', $fattr); ?>
            
              <div class="form-group">
    <label for="pwd">Employer Name:</label>
          <?php echo form_input(array('name'=>'employer_name','id'=> 'employer_name','value'=>$employer_name, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter employer name')); ?>
		  <?php echo form_error('employer_name');?>
    </div>
	
    <div class="form-group">
    <label for="pwd">Job Title</label>
          <?php echo form_input(array('name'=>'job_title','id'=> 'job_title', 'value'=>$job_title, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter job title')); ?>
		  <?php echo form_error('job_title');?>
    </div>
    
    <div class="form-group">
    <label for="pwd">Description</label>
          <?php echo form_input(array('name'=>'description','id'=> 'description','value'=>$description, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter description')); ?>
		  <?php echo form_error('description');?>
    </div>
    
    <div class="form-group">
    <label for="pwd">Job Type</label>
          <?php echo form_input(array('name'=>'job_type','id'=> 'job_type', 'value'=>$job_type, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter job type')); ?>
		  <?php echo form_error('job_posted');?>
    </div>
    
    <div class="form-group">
    <label for="pwd">Job Duration</label>
          <?php echo form_input(array('name'=>'duration','id'=> 'duration', 'value'=>$duration, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter duration')); ?>
		  <?php echo form_error('duration');?>
    </div>
    
    <div class="form-group">
    <label for="pwd">Est Amount</label>
          <?php echo form_input(array('name'=>'est_amount','id'=> 'est_amount','value'=>$est_amount, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter est amount')); ?>
		  <?php echo form_error('est_amount');?>
    </div>
    
    <div class="form-group">
    <label for="pwd">Datetime</label>
          <?php echo form_input(array('name'=>'datetime','id'=> 'datetime','value'=>$datetime, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter datetime')); ?>
		  <?php echo form_error('datetime');?>
    </div>
    
    <div class="form-group">
    <label for="pwd">Location</label>
          <?php echo form_input(array('name'=>'location','id'=> 'location','value'=>$location, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter location')); ?>
		  <?php echo form_error('location');?>
    </div>
    <div class="form-group">
    <label for="pwd">Success Rate</label>
          <?php echo form_input(array('name'=>'success_rate','id'=> 'success_rate','value'=>$success_rate, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter success rate')); ?>
		  <?php echo form_error('success_rate');?>
    </div>
    <div class="form-group">
    <label for="pwd">Bonus</label>
          <?php echo form_input(array('name'=>'bonus','id'=> 'bonus','value'=>$bonus, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter bonus')); ?>
		  <?php echo form_error('bonus');?>
    </div>
    <div class="form-group">
    <label for="pwd">Rating</label>
          <?php echo form_input(array('name'=>'rating','id'=> 'rating','value'=>$rating, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter rating')); ?>
		  <?php echo form_error('rating');?>
    </div>
              <?php echo form_input(array('name'=>'job_id','id'=> 'job_id','value'=>$id, 'class'=>'form-control','type'=>'hidden','placeholder'=>'Enter rating')); ?>

			
        
            <div class="form-group"> 
				<?php //echo form_submit(array('value'=>'ADD', 'class'=>'btn btn-primary btn-block', 'onclick'=>'addCompany()'));?>  
				<button type="button" class="btn btn-primary btn-block" name="submit" value="submit" onclick="updateJob()">UPDATE</button>
				<a id="back" class="btn btn-lg btn-primary btn-block" href="javascript:window.history.go(-1);">CANCEL</a> </div>
				<?php echo form_close(); ?>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



  

