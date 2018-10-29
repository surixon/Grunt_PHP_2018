<?php $Corp = $this->Corp_model->get_details();?>

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
                <label for="usr">Corporation NAME:</label>
                      <?php echo form_input(array('name'=>'corporation_name','id'=>'corporation_name','value'=>$corporation_name,'class'=>'form-control','placeholder'=>'Enter Corp Name' ));?>
                      <?php echo form_error('corporation_name');?>
                </div>
                
                <div class="form-group">
                <label for="pwd">ADDRESS:</label>
                      <?php echo form_input(array('name'=>'address','id'=> 'address','value'=>$address, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Address')); ?>
                      <?php echo form_error('address');?>
                </div>
                
                <div class="form-group">
                <label for="pwd">CITY:</label>
                      <?php echo form_input(array('name'=>'city','id'=> 'city','value'=>$city, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter City')); ?>
                      <?php echo form_error('city');?>
                </div>
                </div>
                
           <div class="col-md-4">
           
           		<div class="form-group">
                <label for="pwd">STATE:</label>
                      <?php echo form_input(array('name'=>'state','id'=> 'state','value'=>$state, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter State')); ?>
                      <?php echo form_error('state');?>
                </div>
                
                <div class="form-group">
                <label for="pwd">ZIP:</label>
                      <?php echo form_input(array('name'=>'zip','id'=> 'zip','value'=>$zip, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Zip')); ?>
                      <?php echo form_error('zip');?>
                </div>
                
                <div class="form-group">
                <label for="usr">TEL:</label>
                      <?php echo form_input(array('name'=>'mobile','id'=> 'mobile','value'=>$mobile, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Telephone Number')); ?>
                      <?php echo form_error('mobile');?>
                </div>
             </div>   
                
              <div class="col-md-4">  
                <div class="form-group">
                <label for="pwd">CONTACT NAME:</label>
                      <?php echo form_input(array('name'=>'contact_name','id'=> 'contact_name','value'=>$contact_name, 'class'=>'form-control','placeholder'=>'Enter Contact Name')); ?>
                      <?php echo form_error('contact_name');?>
                </div>
                
                <div class="form-group">
                <label for="pwd">EMAIL:</label>
                      <?php echo form_input(array('name'=>'email','id'=> 'email','value'=>$email, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Valid Email-Address')); ?>
                      <?php echo form_error('email');?>
                </div>
                <div class="form-group">
                  <label for="pwd">ACCOUNT ID:</label>
                      <?php echo form_input(array('name'=>'account_id','id'=> 'account_id','value'=>$account_id, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Account-Id')); ?>
                      <?php echo form_error('account_id');?>
                </div>
             </div>
             
           <div class="col-md-4">    
              <div class="form-group">
                <label for="pwd">DISCOUNTED %:</label>
                 <?php echo form_input(array('name'=>'discounted%','id'=> 'discounted%','value'=>$account_id, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Discounted%')); ?>
                 <?php echo form_error('discounted%');?>
                  <input type="hidden" value="<?php echo $id; ?>" id="corp_id" name="corp_id">	
              </div>
                
                <div class="form-group">
						<button type="button" class="btn btn-lg btn-primary btn-block" id="updateCorp"  onclick="updateCorps()">UPDATE</button>
						<button type="button" class="btn btn-lg btn-primary btn-block" id="cancelCorp"  onclick="cancelUpdateCorp()">CANCEL</button>
                      <?php echo form_close(); ?>
               </div>
               
          </div>
   </div>	   
   </div>
   </div>
   </div>
   </div>

