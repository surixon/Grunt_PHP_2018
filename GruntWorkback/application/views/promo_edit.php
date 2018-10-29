<?php $Result = $this->Promo_model->get_details();?>
<div class="container-fluid">
        	<div class="col-md-12 form_section">
               <div class="row">
			   <div class="content">
			   <div class="col-md-6">
			   <div class="col-md-6">
	<?php 
    $fattr = array('class' => 'form-signin');
    echo form_open('', $fattr); ?>
    <div class="form-group">
    <label for="usr">PROMOTION NAME:</label>
          <?php echo form_input(array('name'=>'promotion_name','id'=> 'promotion_name','value'=>$promotion_name, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Promotion Name')); ?>
		  <?php echo form_error('promotion_name');?>
    </div>
	
    <div class="form-group">
    <label for="pwd">DISCOUNT %:</label>
          <?php echo form_input(array('name'=>'discounted','id'=> 'discounted','value'=>$discounted, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Discount%')); ?>
		  <?php echo form_error('discounted%');?>
    </div>
	<div class="form-group">
    <label for="pwd">EXP DATE:</label>
          <?php echo form_input(array('name'=>'expiration','id'=> 'expiration','value'=>$expiration, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Exp Date')); ?>
          <?php echo form_error('expiration');?>
          <?php echo form_input(array('name'=>'promo_id','id'=> 'promo_id','value'=>$id, 'class'=>'form-control','type'=>'hidden')); ?>
    </div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
    <label for="pwd">PROMOTION CODE:</label>
          <?php echo form_input(array('name'=>'promotion_code','id'=> 'promotion_code','value'=>$promotion_code, 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Promotion Code')); ?>
		  <?php echo form_error('promotion_code');?>
    </div>
    <div class="form-group">
	<button type="button" class="btn btn-lg btn-primary btn-block" id="updatePromo"  onclick="updatePromos()">UPDATE</button>
	<button type="button" class="btn btn-lg btn-primary btn-block" id="cancelPromo"  onclick="cancelPromos()">CANCEL</button>
    <?php echo form_close(); ?>
   </div>
   </div>
   </div>	   
   </div>
   </div>
   </div>
   </div>
  
