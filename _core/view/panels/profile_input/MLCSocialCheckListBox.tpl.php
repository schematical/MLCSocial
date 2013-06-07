<?php foreach($_CONTROL->arrCheckBoxs as $strKey => $chkOpt){ ?>

    <?php $chkOpt->Render(); ?>&nbsp;<?php echo $chkOpt->Attr('title'); ?>

    <br/><br/>
<?php } ?>