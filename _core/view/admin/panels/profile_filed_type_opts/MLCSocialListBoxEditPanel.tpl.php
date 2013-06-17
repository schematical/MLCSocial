<div style='border:thin solid black; margin-top:10Px; margin-bottom:10Px;'>
    <div class="control-group">
        <label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtName->ControlId; ?>">Opt Name</label>
        <div class='controls'>
            <?php $_CONTROL->txtName->Render(); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" class="control-label" for="<?php echo $_CONTROL->txtValue->ControlId; ?>">Opt Value</label>
        <div class='controls'>
            <?php $_CONTROL->txtValue->Render(); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" class="control-label" for="<?php echo $_CONTROL->btnAddNew->ControlId; ?>"></label>
        <div class='controls'>
            <?php $_CONTROL->btnAddNew->Render(); ?>
        </div>
    </div>


</div>