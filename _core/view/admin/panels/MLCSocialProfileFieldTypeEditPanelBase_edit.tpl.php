<form class="form-horizontal">  
    
    
    
     
    	<legend>
   	 	<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if ($_CONTROL->IsNew()) { ?>
   	 		New
    	<?php
} else { ?>
    		idProfileFieldType: <?php echo $_CONTROL->intIdProfileFieldType; ?><br/>    	
    	<?php
} ?>
    	</legend>
	
	
    
   
	

    
   
	
	 <div class="control-group">
		<label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtNamespace->ControlId; ?>">namespace</label>
		<div class='controls'>	      
	      <?php $_CONTROL->txtNamespace->Render(); ?>
	    </div>
	</div>
    
    
    
	
    
   
	
	 <div class="control-group">
		<label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtShortDesc->ControlId; ?>">shortDesc</label>
		<div class='controls'>	      
	      <?php $_CONTROL->txtShortDesc->Render(); ?>
	    </div>
	</div>
    
    
    
	
    
   
	
	 <div class="control-group">
		<label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtLongDesc->ControlId; ?>">longDesc</label>
		<div class='controls'>	      
	      <?php $_CONTROL->txtLongDesc->Render(); ?>
	    </div>
	</div>





    <div class="control-group">
        <label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtSection->ControlId; ?>">section</label>
        <div class='controls'>
            <?php $_CONTROL->txtSection->Render(); ?>
        </div>
    </div>



    <div class="control-group">
		<label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtRank->ControlId; ?>">rank</label>
		<div class='controls'>	      
	      <?php $_CONTROL->txtRank->Render(); ?>
	    </div>
	</div>


    <div class="control-group">
        <label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtCtlType->ControlId; ?>">ctlType</label>
        <div class='controls'>
            <?php $_CONTROL->txtCtlType->Render(); ?>
        </div>
    </div>





    <div class="control-group">
		<label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtOptData->ControlId; ?>">optData</label>
		<div class='controls'>	      
	      <?php $_CONTROL->txtOptData->Render(); ?>
	    </div>
	</div>



    
    
	
	
	 
	 
	<div class="control-group">
		<div class='controls'>
			 <?php $_CONTROL->btnSave->Render(); ?>
			 <?php $_CONTROL->btnDelete->Render(); ?>
	 	</div>
	</div>

</form>