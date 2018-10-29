 
<div class="container-fluid">
      <div class="col-md-12 form_section"> 
  <i class="sedan fa fa-car fa-5x" aria-hidden="true"></i><h2 class="show_title">Regular</h2>
<!-- Sedan -->
 
  <div class="form-inline">
	  <?php 
    $fattr = array('class' => 'form-signin');
    echo form_open('/Price/price', $fattr); ?>
	  
    <div class="form-group">
		<label for="base_fare">Enter Base Fare</label> </br>
      <?php echo form_input(array('name'=>'basefare','id'=> 'basefare','value'=>((!empty($sedan_pricing['basefare']) && isset($sedan_pricing['basefare']))?$sedan_pricing['basefare']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Base Fare')); ?>
      <?php echo form_error('basefare');?>
    </div>
    
    <div class="form-group">
    <label for="mile">$0.00 per Mile</label> </br>
      <?php echo form_input(array('name'=>'permile','id'=> 'permile','value'=>((!empty($sedan_pricing['permile']) && isset($sedan_pricing['permile']))?$sedan_pricing['permile']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Mile*')); ?>
      <?php echo form_error('permile');?>
    </div>
    
   <div class="form-group">
   	<label for="minute">$0.00 per Minute</label> </br>
      <?php echo form_input(array('name'=>'permin','id'=> 'permin','value'=>((!empty($sedan_pricing['permin']) && isset($sedan_pricing['permin']))?$sedan_pricing['permin']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Minute*')); ?>
      <?php echo form_error('permin');?>
      
    </div>
    
    <div class="form-group">
    <label for="set_minimum">Set minimum</label> </br>
    <?php echo form_input(array('name'=>'set_minimum','id'=> 'set_minimum','value'=>((!empty($sedan_pricing['set_minimum']) && isset($sedan_pricing['set_minimum']))?$sedan_pricing['set_minimum']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Set minimum')); ?>
      <?php echo form_error('permin');?>
	 </div> 
	  
	 <div class="form-group">
     <label for="stop">$0.00 per Stop*</label> </br>
      <?php echo form_input(array('name'=>'per_stop_fee','id'=> 'per_stop_fee','value'=>((!empty($sedan_pricing['per_stop_fee']) && isset($sedan_pricing['per_stop_fee']))?$sedan_pricing['per_stop_fee']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Stop*')); ?>
      <?php echo form_error('per_stop_fee');?>
      
    </div>
    
    <div class="form-group">
    	<label for="stop_minute">$0.00 per Stop minute*</label> </br>
      <?php echo form_input(array('name'=>'per_stop_min','id'=> 'per_stop_min','value'=>((!empty($sedan_pricing['per_stop_min']) && isset($sedan_pricing['per_stop_min']))?$sedan_pricing['per_stop_min']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Stop minute*')); ?>
      <?php echo form_error('per_stop_min');?>
      
    </div>
    
    <div class="form-group">
     <label for="fuel_surcharged">Fuel Surcharged%</label> </br>
      <?php echo form_input(array('name'=>'fuel_surcharged%','id'=> 'fuel_surcharged%','value'=>((!empty($sedan_pricing['fuel_surcharged%']) && isset($sedan_pricing['fuel_surcharged%']))?$sedan_pricing['fuel_surcharged%']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Fuel Surcharged%')); ?>
      <?php echo form_error('fuel_surcharged%');?>
      
    </div>
    
	<div class="form-group">
    <label for="salestax">Sales Tax %</label> </br>
      <?php echo form_input(array('name'=>'salestax','id'=> 'salestax','value'=>((!empty($sedan_pricing['salestax']) && isset($sedan_pricing['salestax']))?$sedan_pricing['salestax']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Sales Tax %')); ?>
      <?php echo form_error('salestax');?>
      
    </div>
    
	<div class="form-group">
    <label for="surcharged">CC Surcharged %</label> </br>
      <?php echo form_input(array('name'=>'cc_surcharged%','id'=> 'cc_surcharged%','value'=>((!empty($sedan_pricing['cc_surcharged%']) && isset($sedan_pricing['cc_surcharged%']))?$sedan_pricing['cc_surcharged%']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'CC Surcharged %')); ?>
      <?php echo form_error('cc_surcharged%');?>
      
    </div>
    
	<div class="form-group">
    <label for="backfund">backfund%</label> </br>
      <?php echo form_input(array('name'=>'backfund%','id'=> 'backfund%','value'=>((!empty($sedan_pricing['backfund%']) && isset($sedan_pricing['backfund%']))?$sedan_pricing['backfund%']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Back Fund %')); ?>
      <?php echo form_error('backfund%');?>
      
    </div>
    
	<div class="form-group">
    <label for="cancellation">$0.00 Cancellation Fee</label> </br>
      <?php echo form_input(array('name'=>'cancellation_fee','id'=> 'cancellation_fee','value'=>((!empty($sedan_pricing['cancellation_fee']) && isset($sedan_pricing['cancellation_fee']))?$sedan_pricing['cancellation_fee']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 Cancellation Fee ')); ?>
      <?php echo form_error('cancellation_fee');?>
      
    </div>
    
	<div class="checkbox">
    <input id="checkbox1" type="checkbox" name="checkbox" value="1" checked="checked"><label for="checkbox1"><span></span>Add the cabscout fee as a convenience fee to the customer</label>
    </div>
    
   <div class="col-md-3 pull-right"> 
	    <?php if(!empty($sedan_pricing['cancellation_fee']) && isset($sedan_pricing['cancellation_fee'])){ ?>
			<button type="button" class="btn btn-primary btn-block" id="updateSedanData"  onclick="addSedanPricing(2)">UPDATE</button>
		<?php }else{ ?>
			<button type="button" class="btn btn-primary btn-block" id="addSedanData"  onclick="addSedanPricing(1)">SAVE</button>
			
		<?php } ?>
      <?php echo form_close(); ?>
   </div>
  </div> 
 </div>
</div>
<!----------------*************************************************************------------------>

<div class="container-fluid">
   <div class="col-md-12 form_section"> 
	  <i class="suv fa fa-car fa-5x" aria-hidden="true"></i><h2 class="show_title">Deluxe</h2>
	 <!-- suv -->
		  <div class="form-inline">
				<?php 
				$fattr = array('class' => 'form-signin');
				echo form_open('', $fattr); ?>
				  
				<div class="form-group">
					<label for="base_fare">Enter Base Fare</label> </br>
				  <?php echo form_input(array('name'=>'basefare_suv','id'=> 'basefare_suv','value'=>((!empty($suv_pricing['basefare']) && isset($suv_pricing['basefare']))?$suv_pricing['basefare']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Enter Base Fare')); ?>
				  <?php echo form_error('basefare');?>
				</div>
				
				<div class="form-group">
                 <label for="mile">$0.00 per Mile</label> </br>
				  <?php echo form_input(array('name'=>'permile_suv','id'=> 'permile_suv','value'=>((!empty($suv_pricing['permile']) && isset($suv_pricing['permile']))?$suv_pricing['permile']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Mile*')); ?>
				  <?php echo form_error('permile');?>
				</div>
				
			   <div class="form-group">
               <label for="minute">$0.00 per Minute*</label> </br>
				  <?php echo form_input(array('name'=>'permin_suv','id'=> 'permin_suv','value'=>((!empty($suv_pricing['permin']) && isset($suv_pricing['permin']))?$suv_pricing['permin']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Minute*')); ?>
				  <?php echo form_error('permin');?>
				  
				</div>
                <div class="form-group">
				<label for="set_minimum">Set minimum</label> </br>
				<?php echo form_input(array('name'=>'set_minimum_suv','id'=> 'set_minimum_suv','value'=>((!empty($suv_pricing['set_minimum']) && isset($suv_pricing['set_minimum']))?$suv_pricing['set_minimum']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Set minimum')); ?>
				  <?php echo form_error('permin');?>
				  </div>
				  
				 <div class="form-group">
                 <label for="stop">$0.00 per Stop</label> </br>
				  <?php echo form_input(array('name'=>'per_stop_fee_suv','id'=> 'per_stop_fee_suv','value'=>((!empty($suv_pricing['per_stop_fee']) && isset($suv_pricing['per_stop_fee']))?$suv_pricing['per_stop_fee']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Stop*')); ?>
				  <?php echo form_error('per_stop_fee');?>
				  
				</div>
				
				<div class="form-group">
                 <label for="stop">$0.00 per Stop minute*</label> </br>
				  <?php echo form_input(array('name'=>'per_stop_min_suv','id'=> 'per_stop_min_suv','value'=>((!empty($suv_pricing['per_stop_min']) && isset($suv_pricing['per_stop_min']))?$suv_pricing['per_stop_min']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 per Stop minute*')); ?>
				  <?php echo form_error('per_stop_min');?>
				  
				</div>
				
				<div class="form-group">
                 <label for="surcharged">Fuel Surcharged%</label> </br>
				  <?php echo form_input(array('name'=>'fuel_surcharged%_suv','id'=> 'fuel_surcharged%_suv','value'=>((!empty($suv_pricing['fuel_surcharged%']) && isset($suv_pricing['fuel_surcharged%']))?$suv_pricing['fuel_surcharged%']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Fuel Surcharged%')); ?>
				  <?php echo form_error('fuel_surcharged%');?>
				  
				</div>
				
				<div class="form-group">
                <label for="salestax">Sales Tax %</label> </br>
				  <?php echo form_input(array('name'=>'salestax_suv','id'=> 'salestax_suv','value'=>((!empty($suv_pricing['salestax']) && isset($suv_pricing['salestax']))?$suv_pricing['salestax']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Sales Tax %')); ?>
				  <?php echo form_error('salestax');?>
				  
				</div>
				
				<div class="form-group">
                 <label for="surcharged">CC Surcharged %</label> </br>
				  <?php echo form_input(array('name'=>'cc_surcharged%_suv','id'=> 'cc_surcharged%_suv','value'=>((!empty($suv_pricing['cc_surcharged%']) && isset($suv_pricing['cc_surcharged%']))?$suv_pricing['cc_surcharged%']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'CC Surcharged %')); ?>
				  <?php echo form_error('cc_surcharged%');?>
				  
				</div>
				
				<div class="form-group">
                 <label for="back_fund">Back Fund %</label> </br>
				  <?php echo form_input(array('name'=>'backfund%_suv','id'=> 'backfund%_suv','value'=>((!empty($suv_pricing['backfund%']) && isset($suv_pricing['backfund%']))?$suv_pricing['backfund%']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'Back Fund %')); ?>
				  <?php echo form_error('backfund%');?>
				  
				</div>
				
				<div class="form-group">
                <label for="cancellation_fee">$0.00 Cancellation Fee</label> </br>
				  <?php echo form_input(array('name'=>'cancellation_fee_suv','id'=> 'cancellation_fee_suv','value'=>((!empty($suv_pricing['cancellation_fee']) && isset($suv_pricing['cancellation_fee']))?$suv_pricing['cancellation_fee']:''), 'class'=>'form-control','type'=>'text','placeholder'=>'$0.00 Cancellation Fee ')); ?>
				  <?php echo form_error('cancellation_fee');?>
				  
				</div>
				
				<div class="checkbox">
				<input id="checkbox1" type="checkbox" name="checkbox" value="1" checked="checked"><label for="checkbox1"><span></span>Add the cabscout fee as a convenience fee to the customer</label>
				</div>
				
			   <div class="col-md-3 pull-right"> 
					<?php if(!empty($suv_pricing['cancellation_fee']) && isset($suv_pricing['cancellation_fee'])){ ?>
						<button type="button" class="btn btn-primary btn-block" id="updateSUVData"  onclick="addSuvPricing(2)">UPDATE</button>
					<?php }else{ ?>
						<button type="button" class="btn btn-primary btn-block" id="addSUVData"  onclick="addSuvPricing(1)">SAVE</button>
						
					<?php } ?>
				  <?php echo form_close(); ?>
			   </div>
		</div> 
   </div>
</div>
