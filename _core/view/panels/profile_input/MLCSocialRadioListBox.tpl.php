
<?php foreach($_CONTROL->arrCheckBoxs as $strKey => $chkOpt){ ?>
<div>
            <div class='pull-left'>
                <?php $chkOpt->Render(); ?>
            </div>
            <div class='pull-left'>
                <label>
                    <?php echo $chkOpt->Attr('title'); ?>
                </label>
            </div>
</div>
<div class='clearfix'></div>
<?php } ?>